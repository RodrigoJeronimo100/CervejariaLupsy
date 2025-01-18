package pt.ipleiria.estg.dei.lupsyapp;

import android.content.DialogInterface;
import android.os.Bundle;

import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
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
    private Button btnPagar;
    private int idFatura;

    public CarrinhoFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_carrinho, container, false);
        setHasOptionsMenu(true);

        lvcarrinho = view.findViewById(R.id.lv_carrinho);
        adapter = new ListaCarrinhoAdaptador(getContext(), itensFatura);
        lvcarrinho.setAdapter(adapter);
        tvTotal = view.findViewById(R.id.tvTotal);
        btnPagar = view.findViewById(R.id.btnPagar);

        getItensFatura();
        btnPagar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onClickPagar(v);
            }
        });
        return view;
    }

    public void onClickPagar(View view) {
        new AlertDialog.Builder(getContext())
                .setTitle("Confirmação")
                .setMessage("Deseja pagar essa fatura?")
                .setPositiveButton("Sim", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        Singleton.getInstance(getContext()).PagarFatura(idFatura);
                        itensFatura.clear();
                        tvTotal.setText("");
                        //getItensFatura();
                        adapter.notifyDataSetChanged();
                    }
                })
                .setNegativeButton("Não", null)
                .show();
    }

    public void getItensFatura() {
        Singleton.getInstance(getContext()).buscarAllItemFaturaAPI(getContext(),
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        itensFatura.clear();
                        tvTotal.setText("");
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
                                idFatura = itemJson.getInt("id_fatura");
                                total += item.getPreco() * item.getQuantidade();
                            }
                            tvTotal.setText(String.format("%.2f€", total));
                            adapter.notifyDataSetChanged();
                        } catch (JSONException e) {
                            itensFatura.clear();
                            tvTotal.setText("");
                            e.printStackTrace();
                            System.out.println("Erro JSONException getItemFatura");
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        System.out.println("Erro: " + error.getMessage());
                    }
                });
    }

    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        super.onCreateOptionsMenu(menu, inflater);

        inflater.inflate(R.menu.menu_historico, menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == R.id.action_history) {

            HistoricoFaturaFragment historicoCevFragment = new HistoricoFaturaFragment();

            getFragmentManager().beginTransaction()
                    .replace(R.id.fragment_container, historicoCevFragment)
                    .addToBackStack(null)
                    .commit();

            return true;
        }
        return super.onOptionsItemSelected(item);
    }

}