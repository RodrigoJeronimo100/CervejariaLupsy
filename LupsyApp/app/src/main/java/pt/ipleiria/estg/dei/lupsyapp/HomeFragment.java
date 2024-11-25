package pt.ipleiria.estg.dei.lupsyapp;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

public class HomeFragment extends Fragment {

    private TextView tvData;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_home, container, false);

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

        return view;
    }

    public void onClickFunil(View view) {
        Toast.makeText(getActivity(), "Funil clicado!", Toast.LENGTH_SHORT).show();
    }
}