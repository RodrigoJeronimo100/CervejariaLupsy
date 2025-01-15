package pt.ipleiria.estg.dei.lupsyapp.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;
import pt.ipleiria.estg.dei.lupsyapp.R;

public class ListaFaturaHAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Fatura> faturas;

    public ListaFaturaHAdaptador(Context context, ArrayList<Fatura> faturas) {
        this.context = context;
        this.faturas = faturas;
    }

    @Override
    public int getCount() {
        return faturas.size();
    }

    @Override
    public Object getItem(int position) {
        return faturas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return faturas.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.item_lista_fatura, null);
        }
        ViewHolderLista viewHolderLista = (ViewHolderLista) convertView.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(convertView);
            convertView.setTag(viewHolderLista);
        }
        viewHolderLista.update(faturas.get(position));
        return convertView;
    }

    private class ViewHolderLista {
        private TextView tvFaturaNome, tvId, tvPrecoTotal, tvDataEmissao, tvEstadoFatura;
        private ImageView imgCapa;

        public ViewHolderLista(View view) {
            tvFaturaNome = view.findViewById(R.id.tvFaturaNome);
            tvId = view.findViewById(R.id.tvId);
            tvPrecoTotal = view.findViewById(R.id.tvPrecoTotal);
            tvDataEmissao = view.findViewById(R.id.tvDataEmissão);
            tvEstadoFatura = view.findViewById(R.id.tvEstadoFatura);
            imgCapa = view.findViewById(R.id.imgCapa);
        }

        public void update(Fatura fatura) {
            tvFaturaNome.setText("Fatura");
            tvId.setText(String.format("%d", fatura.getId()));
            tvPrecoTotal.setText(String.format("Total: %.2f €", fatura.getTotal()));
            tvDataEmissao.setText(String.format("%s", fatura.getData_fatura()));
            tvEstadoFatura.setText(String.format("Estado: %s", fatura.getEstado()));
            imgCapa.setImageResource(R.drawable.invoice);
        }
    }

    public void clear() {
        faturas.clear();
        notifyDataSetChanged();
    }

    public void addAll(List<Fatura> faturas) {
        this.faturas.addAll(faturas);
        notifyDataSetChanged();
    }
}
