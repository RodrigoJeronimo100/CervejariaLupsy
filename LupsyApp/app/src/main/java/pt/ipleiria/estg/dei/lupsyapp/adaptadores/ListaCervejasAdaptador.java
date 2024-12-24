package pt.ipleiria.estg.dei.lupsyapp.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.R;

public class ListaCervejasAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Cerveja> cervejas;

    public ListaCervejasAdaptador(Context context, ArrayList<Cerveja> cervejas) {
        this.context = context;
        this.cervejas = cervejas;
    }

    @Override
    public int getCount() {
        return cervejas.size();
    }

    @Override
    public Object getItem(int position) {
        return cervejas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return cervejas.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null){
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if(convertView == null){
            convertView = inflater.inflate(R.layout.item_lista_cerveja,null);
        }
        ViewHolderLista viewHolderLista = (ViewHolderLista) convertView.getTag();
        if(viewHolderLista == null){
            viewHolderLista = new ViewHolderLista(convertView);
            convertView.setTag(viewHolderLista);
        }
        viewHolderLista.update(cervejas.get(position));
        System.out.println("--> passou no getview adaptador");
        return convertView;
    }
    private class ViewHolderLista{
        private TextView tvTitulo,tvDescricao,tvPreco,tvTeorAlcool;
        private ImageView imgCapa;

        public ViewHolderLista(View view){
            tvTitulo = view.findViewById(R.id.tvNomeCev);
            tvDescricao = view.findViewById(R.id.tvDescCev);
            tvPreco = view.findViewById(R.id.tvPreco);
            tvTeorAlcool = view.findViewById(R.id.tvTeorAlcool);
            imgCapa = view.findViewById(R.id.imgCapa);
            System.out.println("--> passou no viewHolderLista");
        }

        public void update(Cerveja cerveja){
            tvTitulo.setText(cerveja.getNome());
            tvPreco.setText(""+cerveja.getPreco());
            tvTeorAlcool.setText(""+cerveja.getTeor_alcoolico());
            tvDescricao.setText(cerveja.getDescricao() );
            imgCapa.setImageResource(R.drawable.beer);
//            Glide.with(context)
//                    .load(cerveja.getCapa())
//                    .placeholder(R.drawable.cerveja)
//                    .diskCacheStrategy(DiskCacheStrategy.ALL)
//                    .into(imgCapa);
            System.out.println("--> passou no update");

        }
    }
}
