package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.listeners.LoginListener;

public class LoginActivity extends AppCompatActivity implements LoginListener {


    private EditText etUsername;
    private EditText etPassword;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_login);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        etUsername = findViewById(R.id.etUsernameCad);
        etPassword = findViewById(R.id.etPassword);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        Utilizador utilizadorGuardado = Singleton.getInstance(this).getUtilizadorGuardado(this);
        System.out.println("Utilizador guardado oncreate: "+ utilizadorGuardado);
        if (utilizadorGuardado != null) {
            // Utilizador encontrado, faça o login automático
            onValidateLogin(utilizadorGuardado, this);
        }
    }

    private boolean isUsernameValido(String username) {
        if (username == null)
            return false;
        return true;
    }

    private boolean isPasswordValida(String password) {
        if (password == null)
            return false;
        return password.length() >= 4;
    }


    public void onClickLogin(View view) {
        System.out.println("click");
        String username = etUsername.getText().toString();
        String password = etPassword.getText().toString();
        //System.out.println(etUsername.getText().toString() + " : " + password);

        if (!isUsernameValido(username)) {
            etUsername.setError(getString(R.string.email_invalido));
            return;
        }

        if (!isPasswordValida(password)) {
            etPassword.setError(getString(R.string.password_invalida));
            return;
        }

        Singleton.getInstance(this).login(username, password, this,this);
    }

    public void onValidateLogin(Utilizador utilizador, Context context) {
        System.out.println("onValidateLogin "+ utilizador + " "+context);
        if (utilizador == null) {
            // Login falhou
            System.out.println("Erro no login");
            //Toast.makeText(this, "Erro ao fazer login", Toast.LENGTH_SHORT).show();
            etPassword.setError("Credenciais invalidas");
        } else {
            // Login bem-sucedido
            Toast.makeText(this, "Login bem-sucedido", Toast.LENGTH_SHORT).show();
            Intent intent = new Intent(LoginActivity.this, BarraInferior.class);
            startActivity(intent);
            finish();
        }
    }

    public void onClickCadastro(View view) {

        Intent intent = new Intent(LoginActivity.this, SignUpActivity.class);
        startActivity(intent);
    }
}