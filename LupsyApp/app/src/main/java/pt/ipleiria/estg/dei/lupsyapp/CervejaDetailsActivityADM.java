package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

public class CervejaDetailsActivityADM extends AppCompatActivity {

    private EditText etNomeCev, etDescricao, etTeor_Alcool, etPreco;
    private Spinner spinnerFornecedor, spinnerCategoria;
    private CheckBox checkBoxEstado;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cerveja_details_adm);

        etNomeCev = findViewById(R.id.etNomeCev);
        etDescricao = findViewById(R.id.etDescricao);
        etTeor_Alcool = findViewById(R.id.etTeor_Alcool);
        etPreco = findViewById(R.id.etPreco);
        spinnerFornecedor = findViewById(R.id.spinnerFornecedor);
        spinnerCategoria = findViewById(R.id.spinnerCategoria);
        checkBoxEstado = findViewById(R.id.checkBoxEstado);

        ArrayAdapter<String> fornecedorAdapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item,
                new String[]{"Lisboa", "Leiria", "Porto", "Aveiro"});
        fornecedorAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerFornecedor.setAdapter(fornecedorAdapter);

        ArrayAdapter<String> categoriaAdapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item,
                new String[]{"Lager", "Ale", "Pale Ale", "Bitter", "Stout"});
        categoriaAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerCategoria.setAdapter(categoriaAdapter);
    }

    public void onClickAddCerveja(View view) {
        String nome = etNomeCev.getText().toString();
        String descricao = etDescricao.getText().toString();
        String teorAlcool = etTeor_Alcool.getText().toString();
        String preco = etPreco.getText().toString();
        String fornecedor = spinnerFornecedor.getSelectedItem().toString();
        String categoria = spinnerCategoria.getSelectedItem().toString();
        int estado = checkBoxEstado.isChecked() ? 1 : 0;

        if (nome.isEmpty() || descricao.isEmpty() || teorAlcool.isEmpty() || preco.isEmpty()) {
            Toast.makeText(this, "Todos os campos são obrigatórios", Toast.LENGTH_SHORT).show();
            return;
        }

        Singleton.createCerveja(this, nome, descricao, teorAlcool, preco, fornecedor, categoria, estado);
    }
}
