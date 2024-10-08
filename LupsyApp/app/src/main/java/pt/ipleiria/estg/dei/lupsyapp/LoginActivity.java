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

public class LoginActivity extends AppCompatActivity {


    private EditText etEmail;
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

        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
    }
    private boolean isEmailValido(String email){
        if(email == null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();

    }
    private boolean isPasswordValida(String password){
        if(password == null)
            return false;
        return password.length() >= 4;
    }



    public void onClickLogin(View view) {
        String email = etEmail.getText().toString();
        String password = etPassword.getText().toString();

        // Validar email e senha
        if (!isEmailValido(email)) {
            etEmail.setError(getString(R.string.email_invalido));
            return;
        }

        if (!isPasswordValida(password)) {
            etPassword.setError(getString(R.string.password_invalida));
            return;
        }

        // Aqui você pode adicionar o restante do código de login
        Toast.makeText(this, "Login bem-sucedido", Toast.LENGTH_SHORT).show();


        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
        startActivity(intent);
        finish();

    }
}