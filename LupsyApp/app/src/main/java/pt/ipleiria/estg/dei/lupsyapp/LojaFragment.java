package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasListener;


public class LojaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, CervejasListener {

    private ListView lv_cervejas;
    private SwipeRefreshLayout swipeRefreshLayout;

    public LojaFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_loja, container, false);

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
        return view;
    }

    @Override
    public void onRefresh() {
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaCervejas(ArrayList<Cerveja> listaCervejas) {
        if(listaCervejas != null) {
            lv_cervejas.setAdapter(new ListaCervejasAdaptador(getContext(), listaCervejas));
        }
    }
}