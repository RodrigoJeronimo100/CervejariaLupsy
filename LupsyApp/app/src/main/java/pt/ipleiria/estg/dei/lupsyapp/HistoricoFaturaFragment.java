package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import java.util.ArrayList;


import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaFaturaHAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.listeners.FaturasListener;


public class HistoricoFaturaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, FaturasListener {

    private ListView lv_faturas;
    private SwipeRefreshLayout swipeRefreshLayout;

    public HistoricoFaturaFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_historico_fatura, container, false);
        setHasOptionsMenu(true);

        lv_faturas = view.findViewById(R.id.lv_faturas);


        if (getActivity() != null) {
            ActionBar actionBar = ((AppCompatActivity) getActivity()).getSupportActionBar();
            if (actionBar != null) {
                actionBar.show(); // Exibe a ActionBar
            }
        }

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);
        System.out.println("--> on create view homefragment");
        Singleton.getInstance(getContext()).setFaturasListener(this);
        Singleton.getInstance(getContext()).getAllFaturasAPI(getContext());

        return view;
    }

    @Override
    public void onRefresh() {
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaFaturas(ArrayList<Fatura> listaFaturas) {
        if(listaFaturas != null) {
            lv_faturas.setAdapter(new ListaFaturaHAdaptador(getContext(), listaFaturas));
        }
    }
}