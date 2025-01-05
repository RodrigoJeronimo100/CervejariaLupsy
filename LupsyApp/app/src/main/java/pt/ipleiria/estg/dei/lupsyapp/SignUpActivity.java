package pt.ipleiria.estg.dei.lupsyapp;

import static pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton.UrlAPICreateUser;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Iterator;

public class SignUpActivity extends AppCompatActivity {

    private EditText etNomeCad, etEmailCad, etPasswordCad, etNIFCad, etTELECad, etMoradaCad, etUsernameCad;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        etNomeCad = findViewById(R.id.etNomeCad);
        etEmailCad = findViewById(R.id.etEmailCad);
        etPasswordCad = findViewById(R.id.etPasswordCad);
        etNIFCad = findViewById(R.id.etNIFCad);
        etTELECad = findViewById(R.id.etTELECad);
        etMoradaCad = findViewById(R.id.etMoradaCad);
        etUsernameCad = findViewById(R.id.etUsernameCad);
    }

    private boolean isNomeValido(String nome) {
        return nome != null && nome.length() >= 2;
    }

    private boolean isEmailValido(String email) {
        return email != null && Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private boolean isPasswordValida(String password) {
        return password != null && password.length() >= 4;
    }

    private boolean isNIFValido(String nif) {
        return nif != null && nif.length() == 9 && nif.matches("\\d+");
    }

    private boolean isTELEValido(String tele) {
        return tele != null && tele.length() == 9 && tele.matches("\\d+");
    }

    private boolean isMoradaValida(String morada) {
        return morada != null && morada.length() >= 4;
    }

    public void onClickSignUp(View view) {
        String nome = etNomeCad.getText().toString();
        String email = etEmailCad.getText().toString();
        String password = etPasswordCad.getText().toString();
        String nif = etNIFCad.getText().toString();
        String tele = etTELECad.getText().toString();
        String morada = etMoradaCad.getText().toString();
        String username = etUsernameCad.getText().toString();

        if (!isNomeValido(nome)) {
            etNomeCad.setError("Nome Inválido! Pelo menos 2 caractéres.");
            return;
        }
        if (!isEmailValido(email)) {
            etEmailCad.setError("Formato de Email Inválido!");
            return;
        }
        if (!isPasswordValida(password)) {
            etPasswordCad.setError("A Password tem que conter pelo menos 4 caractéres.");
            return;
        }
        if (!isNIFValido(nif)) {
            etNIFCad.setError("O NIF tem que ter exatamente 9 digitos.");
            return;
        }
        if (!isTELEValido(tele)) {
            etTELECad.setError("O Num de Telefone tem que conter exatamente 9 digitos.");
            return;
        }
        if (!isMoradaValida(morada)) {
            etMoradaCad.setError("Morada tem que conter pelo menos 4 caractéres.");
            return;
        }

        createUser(nome, email, password, nif, tele, morada, username);
    }

    private void createUser(String nome, String email, String password, String nif, String tele, String morada, String username) {
        new Thread(() -> {
            try {
                URL url = new URL(UrlAPICreateUser);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();

                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setDoOutput(true);

                JSONObject jsonPayload = new JSONObject();
                jsonPayload.put("nome", nome);
                jsonPayload.put("username", username);
                jsonPayload.put("email", email);
                jsonPayload.put("password", password);
                jsonPayload.put("nif", nif);
                jsonPayload.put("telefone", tele);
                jsonPayload.put("morada", morada);

                // Write data to request body
                OutputStream os = conn.getOutputStream();
                os.write(jsonPayload.toString().getBytes("UTF-8"));
                os.close();

                int responseCode = conn.getResponseCode();
                System.out.println("response code: " + responseCode);
                System.out.println("response message: " + conn.getResponseMessage());

                if (responseCode == 200) {
                    BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                    StringBuilder response = new StringBuilder();
                    String line;

                    while ((line = reader.readLine()) != null) {
                        response.append(line);
                    }

                    reader.close();

                    String responseMessage = response.toString();

                    if (responseMessage.contains("success")) {
                        System.out.println("success");
                        Intent intent = new Intent(SignUpActivity.this, LoginActivity.class);
                        startActivity(intent);
                        finish();

                    } else if (responseMessage.contains("error")) {
                        System.out.println("error: "+ responseMessage);
                        try {
                            JSONObject errorJson = new JSONObject(responseMessage);
                            JSONObject errorObject = errorJson.getJSONObject("error");
                            Iterator<String> keys = errorObject.keys();
                            StringBuilder errorMessage = new StringBuilder();

                            while (keys.hasNext()) {
                                String key = keys.next();
                                JSONArray fieldErrors = errorObject.getJSONArray(key);

                                for (int i = 0; i < fieldErrors.length(); i++) {
                                    errorMessage.append(fieldErrors.getString(i)).append("\n");
                                }
                            }

                            runOnUiThread(() -> Toast.makeText(this, errorMessage.toString(), Toast.LENGTH_LONG).show());
                        } catch (JSONException e) {
                            e.printStackTrace();
                            runOnUiThread(() -> Toast.makeText(this, "Erro ao processar a resposta do servidor", Toast.LENGTH_SHORT).show());
                        }

                    }
                } else {
                    runOnUiThread(() -> Toast.makeText(this, "Falha ao Criar Utilizador!", Toast.LENGTH_SHORT).show());
                    System.out.println("--> Falha ao Criar Utilizador");
                }
                conn.disconnect();
            } catch (Exception e) {
                runOnUiThread(() -> Toast.makeText(this, "Erro: " + e.getMessage(), Toast.LENGTH_SHORT).show());
                System.out.println("Erro: " + e.getMessage());
            }
        }).start();
    }
}
