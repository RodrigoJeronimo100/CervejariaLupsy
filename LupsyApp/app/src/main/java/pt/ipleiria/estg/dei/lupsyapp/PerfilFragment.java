package pt.ipleiria.estg.dei.lupsyapp;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.UtilizadorDBHelper;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link PerfilFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class PerfilFragment extends Fragment {

    private TextView username, nome, telefone, morada;

    public PerfilFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view =  inflater.inflate(R.layout.fragment_perfil, container, false);

        UtilizadorDBHelper dbHelper = new UtilizadorDBHelper(getContext());
        Utilizador utilizador = dbHelper.getUtilizador(getContext());
        username = view.findViewById(R.id.tvUsername);
        nome = view.findViewById(R.id.tvNome);
        telefone = view.findViewById(R.id.tvTelefone);
        morada = view.findViewById(R.id.tvMorada);

        username.setText(utilizador.getUsername());
        nome.setText(utilizador.getNome());
        telefone.setText(String.valueOf(utilizador.getTelefone()));
        morada.setText(utilizador.getMorada());

        return view;
    }
}