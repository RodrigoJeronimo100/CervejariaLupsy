package pt.ipleiria.estg.dei.lupsyapp;

import android.os.Bundle;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class BarraInferior extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_barra_inferior);

    }

    BottomNavigationView bottomNavigationView = findViewById(R.id.bottom_navigation);
    // Configurar o clique dos itens do menu

}