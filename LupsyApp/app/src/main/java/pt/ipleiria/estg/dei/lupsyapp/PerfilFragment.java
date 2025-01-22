package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
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
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.CervejaHistorico;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.UtilizadorDBHelper;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasPerfilAdaptador;
import pt.ipleiria.estg.dei.lupsyapp.adaptadores.ListaCervejasPerfilTop3Adaptador;


public class PerfilFragment extends Fragment {

    private TextView username, nome, telefone, morada;
    private ListView lvHistorico,lvTop3;
    private ListaCervejasPerfilAdaptador listaCervejasAdaptador;
    private ImageButton botaoLogout;
    private Button buttonPag;

    public PerfilFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view =  inflater.inflate(R.layout.fragment_perfil, container, false);
        setHasOptionsMenu(true);

        if (getActivity() != null) {
            ActionBar actionBar = ((AppCompatActivity) getActivity()).getSupportActionBar();
            if (actionBar != null) {
                actionBar.show(); // Exibe a ActionBar
            }
        }

        UtilizadorDBHelper dbHelper = new UtilizadorDBHelper(getContext());
        Utilizador utilizador = dbHelper.getUtilizador(getContext());
        username = view.findViewById(R.id.tvUsername);
        nome = view.findViewById(R.id.tvNome);
        telefone = view.findViewById(R.id.tvTelefone);
        morada = view.findViewById(R.id.tvMorada);
        botaoLogout = view.findViewById(R.id.botaoLogout);



        username.setText(utilizador.getUsername());
        nome.setText(utilizador.getNome());
        telefone.setText(String.valueOf(utilizador.getTelefone()));
        morada.setText(utilizador.getMorada());

        lvHistorico = view.findViewById(R.id.lvHistorico);
        listaCervejasAdaptador = new ListaCervejasPerfilAdaptador(getContext(), new ArrayList<>()); // Inicializa o adaptador com uma lista vazia
        lvHistorico.setAdapter(listaCervejasAdaptador);
        lvTop3 = view.findViewById(R.id.lvTop3);

        botaoLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Chamar o método para realizar o logout
                realizarLogout();
            }
        });

        buscarHistorico();



        return view;
    }

    private void buscarHistorico() {
        Singleton.getInstance(getContext()).buscarHistorico(
                new Response.Listener<List<CervejaHistorico>>() {
                    @Override
                    public void onResponse(List<CervejaHistorico> cervejas) {
                        // Atualiza o adaptador com a lista de cervejas favoritas
                        listaCervejasAdaptador.clear(); // Limpa a lista atual do adaptador
                        listaCervejasAdaptador.addAll(cervejas); // Adiciona as cervejas favoritas
                        listaCervejasAdaptador.notifyDataSetChanged();
                        List<CervejaHistorico> top3Cervejas = CervejaHistorico.getTop3CervejasFromList(cervejas);
                        ArrayList<CervejaHistorico> top3CervejasArrayList = new ArrayList<>(top3Cervejas);
                        ListaCervejasPerfilTop3Adaptador top3Adaptador = new ListaCervejasPerfilTop3Adaptador(getContext(), top3CervejasArrayList,cervejas);
                        lvTop3.setAdapter(top3Adaptador);
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
    private void realizarLogout() {
        //Limpar dados do usuário das SharedPreferences
        SharedPreferences sharedPreferences = requireActivity().getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        Singleton.getInstance(getContext()).logout();

        Intent intent = new Intent(requireActivity(), LoginActivity.class);
        startActivity(intent);
        requireActivity().finish(); // Finalizar a BarraInferior
    }

    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        super.onCreateOptionsMenu(menu, inflater);

        inflater.inflate(R.menu.menu_newpag, menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == R.id.action_newpag) {

            PagNovaFragment pagNovaFragment = new PagNovaFragment();

            getFragmentManager().beginTransaction()
                    .replace(R.id.fragment_container, pagNovaFragment)
                    .addToBackStack(null)
                    .commit();

            return true;
        }
        return super.onOptionsItemSelected(item);
    }

}