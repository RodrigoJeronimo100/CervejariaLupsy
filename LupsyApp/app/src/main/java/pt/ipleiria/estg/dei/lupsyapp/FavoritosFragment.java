package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import java.util.ArrayList;
import java.util.List;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasFavAdaptador;

public class FavoritosFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener {

    private ListView lvFavoritos;
    private SwipeRefreshLayout swipeRefreshLayout;
    private ListaCervejasFavAdaptador listaCervejasFavAdaptador;

    public FavoritosFragment() {
        // Required empty public constructor
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_favoritos, container, false);


        lvFavoritos = view.findViewById(R.id.lv_favoritos);
        listaCervejasFavAdaptador = new ListaCervejasFavAdaptador(getContext(), new ArrayList<>()); // Inicializa o adaptador com uma lista vazia
        lvFavoritos.setAdapter(listaCervejasFavAdaptador);

        buscarFavoritas();

        // Configuração do listener para o clique em um item da lista
        lvFavoritos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //Toast.makeText(getContext(),livros.get(position).getTitulo(), Toast.LENGTH_SHORT).show();
                // codigo para ir para o detalhes livro
                Intent intent = new Intent(getContext(), CervejaDetailsActivity.class);
                intent.putExtra(CervejaDetailsActivity.ID_CERVEJA, (int) id);
                startActivity(intent);
            }
        });
        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);

        return view;
    }
    @Override
    public void onRefresh() {
        buscarFavoritas();
        swipeRefreshLayout.setRefreshing(false);
    }

    private void buscarFavoritas() {
        Singleton.getInstance(getContext()).buscarFavoritas(
                new Response.Listener<List<Cerveja>>() {
                    @Override
                    public void onResponse(List<Cerveja> cervejasFavoritas) {
                        // Atualiza o adaptador com a lista de cervejas favoritas
                        listaCervejasFavAdaptador.clear(); // Limpa a lista atual do adaptador
                        listaCervejasFavAdaptador.addAll(cervejasFavoritas); // Adiciona as cervejas favoritas
                        listaCervejasFavAdaptador.notifyDataSetChanged();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // Exibe uma mensagem de erro ao usuário
                        Toast.makeText(getContext(), "Erro ao buscar favoritas: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }
        );
    }

    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        super.onCreateOptionsMenu(menu, inflater);

        inflater.inflate(R.menu.menu_carrinho, menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == R.id.action_cart) {

            CarrinhoFragment carrinhoFragment = new CarrinhoFragment();

            getFragmentManager().beginTransaction()
                    .replace(R.id.fragment_container, carrinhoFragment)
                    .addToBackStack(null)
                    .commit();

            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}