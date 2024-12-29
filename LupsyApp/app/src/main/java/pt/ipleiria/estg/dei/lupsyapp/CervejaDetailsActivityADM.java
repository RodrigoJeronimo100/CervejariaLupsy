package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

public class CervejaDetailsActivityADM extends AppCompatActivity {

    private EditText etNomeCev, etDescricao, etTeor_Alcool, etPreco;
    private ImageView imgCapa, heartImageView;
    private CardView heartContainer, tchimTchimButton;
    private Cerveja cerveja;
    private FloatingActionButton fabGuardar;

    public static final String ID_CERVEJA = "ID_CERVEJA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_cerveja_details_adm);

        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        }

        etNomeCev = findViewById(R.id.etNomeCev);
        etDescricao = findViewById(R.id.etDescricao);
        etTeor_Alcool = findViewById(R.id.etTeor_Alcool);
        etPreco = findViewById(R.id.etPreco);
        imgCapa = findViewById(R.id.imgCapa);


        fabGuardar = findViewById(R.id.fabGuardar);

        if (cerveja != null)
        {
            carregarDetalhes();
            fabGuardar.setImageResource(R.drawable.ic_save);
        }else{
            setTitle(getString(R.string.txt_adicionar));
            fabGuardar.setImageResource(R.drawable.ic_save);
        }


        fabGuardar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(cerveja != null){
                    

                    cerveja.setNome((etNomeCev.getText().toString()));
                    cerveja.setDescricao((etDescricao.getText().toString()));
                    cerveja.setTeor_alcoolico(Float.parseFloat(etTeor_Alcool.getText().toString()));
                    cerveja.setPreco(Float.parseFloat(etPreco.getText().toString()));


                    Singleton.getInstance(CervejaDetailsActivityADM.this).adicionarCerveja(cerveja);


                    Intent intent = new Intent();
                    intent.putExtra(BarraInferior.OP_CODE, BarraInferior.EDIT);
                    setResult(RESULT_OK, intent);
                    finish();

                }else {


                            Float.parseFloat(etTeor_Alcool.getText().toString());
                            Float.parseFloat(etPreco.getText().toString());
                            etNomeCev.getText().toString();
                            etDescricao.getText().toString();

                    Singleton.getInstance(CervejaDetailsActivityADM.this).editarCerveja(cerveja);


                    // Ex 10.2
                    Intent intent = new Intent();
                    intent.putExtra(BarraInferior.OP_CODE, BarraInferior.ADD);
                    setResult(RESULT_OK, intent);
                    finish();

                }
            }
        });
    }

    private void carregarDetalhes() {
        if (cerveja != null) {
            etNomeCev.setText(cerveja.getNome());
            etDescricao.setText(cerveja.getDescricao());
            etTeor_Alcool.setText(String.format("%.1f %%", cerveja.getTeor_alcoolico()));
            etPreco.setText(String.format("%.2f €", cerveja.getPreco()));
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (cerveja != null) {
            return super.onCreateOptionsMenu(menu);
        }
        return false;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            // Handle the back arrow click
            onBackPressed(); // This will navigate to the previous activity
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}