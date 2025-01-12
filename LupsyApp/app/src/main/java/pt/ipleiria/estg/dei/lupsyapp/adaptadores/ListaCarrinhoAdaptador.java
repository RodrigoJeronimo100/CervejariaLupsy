package pt.ipleiria.estg.dei.lupsyapp.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.ItemFatura;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.R;

public class ListaCarrinhoAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private List<ItemFatura> itensFatura;

    public ListaCarrinhoAdaptador(Context context, List<ItemFatura> itensFatura) {
        this.context = context;
        this.itensFatura = itensFatura;
    }
    @Override
    public int getCount() {
        return itensFatura.size();
    }

    @Override
    public Object getItem(int position) {
        return itensFatura.get(position);
    }

    @Override
    public long getItemId(int position) {
        return itensFatura.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = LayoutInflater.from(context).inflate(R.layout.item_lista_carrinho, parent, false);
        }

        ItemFatura itemFatura = itensFatura.get(position);

        ImageView imgCapa = convertView.findViewById(R.id.imgCapa);
        TextView tvNomeCev = convertView.findViewById(R.id.tvNomeCev);
        TextView tvQuantidade = convertView.findViewById(R.id.tvQuantidade);
        TextView tvPrecoUnitario = convertView.findViewById(R.id.tvPrecoUnitario);
        ImageButton btnRemoverItem = convertView.findViewById(R.id.btnRemoverItem);

        imgCapa.setImageResource(R.drawable.beer);
        tvNomeCev.setText(getNomeCerveja(itemFatura.getId_cerveja()));
        tvQuantidade.setText("Quantidade: " + itemFatura.getQuantidade());
        tvPrecoUnitario.setText("Preço unitário: " + itemFatura.getPreco());

        // Configurar o listener para o botão Remover Item
        btnRemoverItem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Singleton.getInstance(context).removerItemFaturaAPI(context, itemFatura.getId(),
                        new Response.Listener<JSONObject>() {
                            @Override
                            public void onResponse(JSONObject response) {
                                itensFatura.remove(itemFatura);
                                Toast.makeText(context, "Item removido com sucesso", Toast.LENGTH_SHORT).show();
                                notifyDataSetChanged();
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(context, "Erro ao remover item", Toast.LENGTH_SHORT).show();
                                System.out.println("-->Erro ao remover item: " + error.getMessage());
                            }
                        });
            }
        });

        return convertView;
    }

    // Função para obter o nome da cerveja com base no ID
    private String getNomeCerveja(int idCerveja) {
        Cerveja cerveja = Singleton.getInstance(context).getCervejaDB(idCerveja);
        return cerveja.getNome();
    }
}
