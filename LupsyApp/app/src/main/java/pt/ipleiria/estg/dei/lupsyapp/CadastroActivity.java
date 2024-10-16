package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class CadastroActivity extends AppCompatActivity {

    private EditText etNomeCad;
    private EditText etEmailCad;
    private EditText etPasswordCad;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_cadastro);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });


        etNomeCad = findViewById(R.id.etNomeCad);
        etEmailCad = findViewById(R.id.etEmailCad);
        etPasswordCad = findViewById(R.id.etPasswordCad);

    }

    private boolean isNomeValidoCad(String nome) {
        if (nome == null)
            return false;
        return nome.length() >= 2;
    }

    private boolean isEmailValidoCad(String email) {
        if (email == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();

    }

    private boolean isPasswordValidaCad(String password) {
        if (password == null)
            return false;
        return password.length() >= 4;
    }

    public void onClickCadastro(View view) {

        String nome = etNomeCad.getText().toString();
        String email = etEmailCad.getText().toString();
        String password = etPasswordCad.getText().toString();

       if (!isNomeValidoCad(nome)) {
           etNomeCad.setError(getString(R.string.nome_invalido));
           return;
       }
        if (!isEmailValidoCad(email)) {
            etEmailCad.setError(getString(R.string.email_invalido));
            return;
        }

        if (!isPasswordValidaCad(password)) {
            etPasswordCad.setError(getString(R.string.password_invalida));
            return;
        }

        // Aqui você pode adicionar o restante do código de login
        Toast.makeText(this, "Conta Criada", Toast.LENGTH_SHORT).show();


        Intent intent = new Intent(CadastroActivity.this, LoginActivity.class);
        startActivity(intent);
        finish();
    }
}