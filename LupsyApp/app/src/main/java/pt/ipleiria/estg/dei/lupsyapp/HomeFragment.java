package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Locale;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasListener;

public class HomeFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, CervejasListener {

    private TextView tvData;
    private ListView lv_cervejas;
    private SwipeRefreshLayout swipeRefreshLayout;
    private TextView tvProdutoDisponivel;
    private Button btnZerarContador;
    private int contadorProdutos = 0; // Contador inicial
    private TextView tvProdutoMaisCaro;

    public HomeFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_home, container, false);
        setHasOptionsMenu(true);

        // Inicializa o TextView
        tvData = view.findViewById(R.id.tvData);

        // Configura a data atual
        Calendar calendar = Calendar.getInstance();
        SimpleDateFormat dateFormat = new SimpleDateFormat("dd 'de' MMMM 'de' yyyy", new Locale("pt", "PT"));
        String dataAtual = dateFormat.format(calendar.getTime());
        tvData.setText(dataAtual);

        // Configura o ActionBar (se necessário)
        if (getActivity() != null) {
            ActionBar actionBar = ((AppCompatActivity) getActivity()).getSupportActionBar();
            if (actionBar != null) {
                actionBar.show(); // Exibe a ActionBar
            }
        }


        lv_cervejas = view.findViewById(R.id.lv_cervejas);

        lv_cervejas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
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
        System.out.println("--> on create view homefragment");
        Singleton.getInstance(getContext()).setCervejasListener(this);
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());

        tvProdutoDisponivel = view.findViewById(R.id.tvProdutoDisponivel);
        btnZerarContador = view.findViewById(R.id.btnZerarContador);
        tvProdutoMaisCaro = view.findViewById(R.id.tvProdutoMaisCaro);



        contadorProdutos = Singleton.getInstance(getContext()).getCervejasCount();
        atualizarContador();

        btnZerarContador.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                contadorProdutos = 0; // Zera o contador
                atualizarContador();
                Toast.makeText(getContext(), "Contador zerado!", Toast.LENGTH_SHORT).show();
            }
        });


        return view;


    }

    @Override
    public void onRefresh() {
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaCervejas(ArrayList<Cerveja> listaCervejas) {
        if (listaCervejas != null) {
            //cerveja da mais cara para a mais barata
            listaCervejas.sort((c1, c2) -> Double.compare(c2.getPreco(), c1.getPreco()));


            lv_cervejas.setAdapter(new ListaCervejasAdaptador(getContext(), listaCervejas));

            //contador de cervejas total
            contadorProdutos = listaCervejas.size();
            atualizarContador();

            //cerveja mais cara em string
            if (!listaCervejas.isEmpty()) {
                Cerveja cervejaMaisCara = listaCervejas.get(0);
                String mensagem = String.format("Produto mais caro: %s - Preço: %.2f €", cervejaMaisCara.getNome(), cervejaMaisCara.getPreco());
                tvProdutoMaisCaro.setText(mensagem);
            } else {
                tvProdutoMaisCaro.setText("Nenhum produto disponível.");
            }
        }
    }


    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        super.onCreateOptionsMenu(menu, inflater);

        inflater.inflate(R.menu.menu_carrinho, menu);
    }

    private void atualizarContador() {
        tvProdutoDisponivel.setText("Produtos disponíveis: " + contadorProdutos);
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