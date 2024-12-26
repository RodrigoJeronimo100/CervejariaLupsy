package pt.ipleiria.estg.dei.lupsyapp;

import android.os.Bundle;
import android.view.Menu;
import android.widget.TextView;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.Locale;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

public class CervejaDetailsActivity extends AppCompatActivity {

    private TextView tv_nome, tv_descricao, tv_teor_alcool, tv_preco;
    private ImageView imgCapa;
    private Cerveja cerveja;

    public static final String ID_CERVEJA = "ID_CERVEJA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cerveja_details);


        tv_nome = findViewById(R.id.tv_nome);
        tv_descricao = findViewById(R.id.tv_descricao);
        tv_teor_alcool = findViewById(R.id.tv_teor_alcool);
        tv_preco = findViewById(R.id.tv_preco);
        imgCapa = findViewById(R.id.imgCapa);


        int id = getIntent().getIntExtra(ID_CERVEJA, 0);
        cerveja = Singleton.getInstance(this).getCerveja(id);


        carregarDetalhes();
    }

    private void carregarDetalhes() {
        if (cerveja != null) {
            // Set details
            tv_nome.setText(cerveja.getNome());
            tv_descricao.setText(cerveja.getDescricao());
            tv_teor_alcool.setText(String.format(Locale.getDefault(), "%.1f %%", cerveja.getTeor_alcoolico()));
            tv_preco.setText(String.format(Locale.getDefault(), "%.2f €", cerveja.getPreco()));

            // If imgCapa is dynamic, set it here (e.g., using Glide or Picasso for loading)
            // imgCapa.setImageResource(R.drawable.placeholder); // Example for static resource
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (cerveja != null) {
            return super.onCreateOptionsMenu(menu);
        }
        return false;
    }
}
