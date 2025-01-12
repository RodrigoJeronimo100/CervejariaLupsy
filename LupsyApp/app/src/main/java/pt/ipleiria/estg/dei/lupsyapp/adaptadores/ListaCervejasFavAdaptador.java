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

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.R;

public class ListaCervejasFavAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Cerveja> cervejas;

    public ListaCervejasFavAdaptador(Context context, ArrayList<Cerveja> cervejas) {
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
        private TextView tvTitulo,tvDescricao;
        private ImageView imgCapa;

        public ViewHolderLista(View view){
            tvTitulo = view.findViewById(R.id.tvNomeCev);
            tvDescricao = view.findViewById(R.id.tvQuantidade);
            imgCapa = view.findViewById(R.id.imgCapa);
            System.out.println("--> passou no viewHolderLista");
        }

        public void update(Cerveja cerveja){
            tvTitulo.setText(cerveja.getNome());
            tvDescricao.setText(cerveja.getDescricao() );
            imgCapa.setImageResource(R.drawable.beer_fav);
//            Glide.with(context)
//                    .load(cerveja.getCapa())
//                    .placeholder(R.drawable.cerveja)
//                    .diskCacheStrategy(DiskCacheStrategy.ALL)
//                    .into(imgCapa);
            System.out.println("--> passou no update");

        }
    }
    public void clear() {
        cervejas.clear();
        notifyDataSetChanged(); // Notifica o adaptador sobre a mudança
    }
    public void addAll(List<Cerveja> cervejas) {
        this.cervejas.addAll(cervejas);
        notifyDataSetChanged(); // Notifica o adaptador sobre a mudança
    }
}
