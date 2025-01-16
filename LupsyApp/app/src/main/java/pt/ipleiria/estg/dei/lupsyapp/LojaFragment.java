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

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasLojaAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasListener;

public class LojaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, CervejasListener {

    private ListView lv_cervejas;
    private SwipeRefreshLayout swipeRefreshLayout;
    private Button btn_add;
    private FloatingActionButton fabAction;

    public LojaFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_loja, container, false);
        setHasOptionsMenu(true);

        //System.out.println("Role na loja: " + Singleton.getInstance(getContext()).getUtilizadorGuardado(getContext()).getRole());
        lv_cervejas = view.findViewById(R.id.lv_cervejas);

        lv_cervejas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getContext(), CervejaDetailsActivity.class);
                intent.putExtra(CervejaDetailsActivity.ID_CERVEJA, (int) id);
                startActivity(intent);
            }
        });

        // Configura o ActionBar (se necessário)
        if (getActivity() != null) {
            ActionBar actionBar = ((AppCompatActivity) getActivity()).getSupportActionBar();
            if (actionBar != null) {
                actionBar.show(); // Exibe a ActionBar
            }
        }

        swipeRefreshLayout = view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);
        Singleton.getInstance(getContext()).setCervejasListener(this);
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());

        btn_add = view.findViewById(R.id.btn_add);
        btn_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getContext(), CervejaDetailsActivityADM.class);
                startActivityForResult(intent, BarraInferior.ADD);
            }
        });

        // Configuração do FloatingActionButton
        fabAction = view.findViewById(R.id.fab_action);
        verificarPermissaoUtilizador();

        fabAction.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Ação do botão
                Intent intent = new Intent(getContext(), CervejaDetailsActivityADM.class);
                startActivity(intent);
            }
        });

        return view;
    }

    /**
     * Método para verificar o papel do utilizador e configurar a visibilidade do FAB.
     */
    private void verificarPermissaoUtilizador() {
        Utilizador utilizadorGuardado = Singleton.getInstance(getContext()).getUtilizadorGuardado(getContext());

        if (utilizadorGuardado != null) {
            String role = utilizadorGuardado.getRole();
            if (role.equalsIgnoreCase("cliente")) {
                fabAction.setVisibility(View.GONE); // Esconde o FAB para clientes
            } else {
                fabAction.setVisibility(View.VISIBLE); // Mostra o FAB para admin/funcionario
            }
        } else {
            fabAction.setVisibility(View.GONE);
        }
    }


    @Override
    public void onRefresh() {
        Singleton.getInstance(getContext()).getAllCervejasAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaCervejas(ArrayList<Cerveja> listaCervejas) {
        if (listaCervejas != null) {
            lv_cervejas.setAdapter(new ListaCervejasLojaAdaptador(getContext(), listaCervejas));
        }
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
