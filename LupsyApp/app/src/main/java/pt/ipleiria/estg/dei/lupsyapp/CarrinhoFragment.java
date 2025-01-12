package pt.ipleiria.estg.dei.lupsyapp;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.ItemFatura;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCarrinhoAdaptador;


public class CarrinhoFragment extends Fragment {
    private ListView lvcarrinho;
    private ListaCarrinhoAdaptador adapter;
    private List<ItemFatura> itensFatura = new ArrayList<>();
    private TextView tvTotal;
    private double total = 0;

    public CarrinhoFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_carrinho, container, false);

        lvcarrinho = view.findViewById(R.id.lv_carrinho);
        adapter = new ListaCarrinhoAdaptador(getContext(), itensFatura);
        lvcarrinho.setAdapter(adapter);
        tvTotal = view.findViewById(R.id.tvTotal);


        getItensFatura();

        return view;
    }

    public void getItensFatura() {
        Singleton.getInstance(getContext()).buscarAllItemFaturaAPI(getContext(),
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        itensFatura.clear();
                        try {
                            for (int i = 0; i < response.length(); i++) {
                                JSONObject itemJson = response.getJSONObject(i);
                                ItemFatura item = new ItemFatura(
                                        itemJson.getInt("id"),
                                        itemJson.getInt("id_fatura"),
                                        itemJson.getInt("id_cerveja"),
                                        itemJson.getInt("quantidade"),
                                        itemJson.getDouble("preco_unitario")
                                );
                                itensFatura.add(item);
                                total += item.getPreco() * item.getQuantidade();
                            }
                            tvTotal.setText(String.format("%.2f€", total));
                            adapter.notifyDataSetChanged();
                        } catch (JSONException e) {
                            e.printStackTrace();
                            // Lidar com a exceção JSONException
                            // ...
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // Lidar com o erro
                        // ...
                    }
                });
    }

    private void atualizarUI(List<ItemFatura> itensFatura) {

    }

}