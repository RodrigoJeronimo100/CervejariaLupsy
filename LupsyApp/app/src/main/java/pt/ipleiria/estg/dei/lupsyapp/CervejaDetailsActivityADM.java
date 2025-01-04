package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONObject;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

import androidx.appcompat.app.AppCompatActivity;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

public class CervejaDetailsActivityADM extends AppCompatActivity {

    private EditText etNomeCev, etDescricao, etTeor_Alcool, etPreco;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cerveja_details_adm);

        etNomeCev = findViewById(R.id.etNomeCev);
        etDescricao = findViewById(R.id.etDescricao);
        etTeor_Alcool = findViewById(R.id.etTeor_Alcool);
        etPreco = findViewById(R.id.etPreco);
    }

    public void onClickAddCerveja(View view) {
        String nome = etNomeCev.getText().toString();
        String descricao = etDescricao.getText().toString();
        String teorAlcool = etTeor_Alcool.getText().toString();
        String preco = etPreco.getText().toString();

        if (nome.isEmpty() || descricao.isEmpty() || teorAlcool.isEmpty() || preco.isEmpty()) {
            Toast.makeText(this, "Todos os campos são obrigatórios", Toast.LENGTH_SHORT).show();
            return;
        }

        // Create the Cerveja object to send to the API
        createCerveja(nome, descricao, teorAlcool, preco);
    }

    private void createCerveja(String nome, String descricao, String teorAlcool, String preco) {
        new Thread(() -> {
            try {
                // API URL
                URL url = new URL(Singleton.UrlAPIIsCreateCerveja);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();

                // Setup connection
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setDoOutput(true);

                // Create JSON object with data to send
                JSONObject jsonPayload = new JSONObject();
                jsonPayload.put("nome", nome);
                jsonPayload.put("descricao", descricao);
                jsonPayload.put("teor_alcoolico", teorAlcool);
                jsonPayload.put("preco", preco);

                // Write data to request body
                OutputStream os = conn.getOutputStream();
                os.write(jsonPayload.toString().getBytes("UTF-8"));
                os.close();

                int responseCode = conn.getResponseCode();
                if (responseCode == HttpURLConnection.HTTP_CREATED) { // 201 Created
                    runOnUiThread(() -> {
                        Toast.makeText(this, "Cerveja Criada com Sucesso.", Toast.LENGTH_SHORT).show();
                        // Optional: Redirect to another activity or clear fields
                        Intent intent = new Intent(CervejaDetailsActivityADM.this, BarraInferior.class); // Adjust to the next activity
                        startActivity(intent);
                        finish();
                    });
                } else {
                    runOnUiThread(() -> Toast.makeText(this, "Falha ao Criar Cerveja!", Toast.LENGTH_SHORT).show());
                }
                conn.disconnect();
            } catch (Exception e) {
                runOnUiThread(() -> Toast.makeText(this, "Erro: " + e.getMessage(), Toast.LENGTH_SHORT).show());
            }
        }).start();
    }
}
