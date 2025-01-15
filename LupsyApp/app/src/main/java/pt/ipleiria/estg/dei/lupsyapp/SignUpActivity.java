package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

import androidx.appcompat.app.AppCompatActivity;

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

        Singleton.getInstance(getApplicationContext()).createUser(this, nome, email, password, nif, tele, morada, username);
    }
}
