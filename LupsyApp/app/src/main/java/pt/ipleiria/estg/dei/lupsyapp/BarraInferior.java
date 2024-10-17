package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
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

    /*bottomNavigationView.setOnNavigationItemSelectedListener(item -> {
        switch (item.getItemId()) {
            case R.id.nav_favoritos:

                Intent intentFavoritos = new Intent(this, FavoritosActivity.class);
                startActivity(intentFavorites);
                return true;

            case R.id.nav_loja:

                Intent intentShop = new Intent(this, LojaActivity.class);
                startActivity(intentLoja);
                return true;

            case R.id.nav_lupa:

                Intent intentLupa = new Intent(this, LupaActivity.class);
                startActivity(intentLupa);
                return true;

            case R.id.nav_cart:

                Intent intentCart = new Intent(this, CarrinhoActivity.class);
                startActivity(intentCart);
                return true;

            case R.id.nav_perfil:

                Intent intentPerfil = new Intent(this, PerfilActivity.class);
                startActivity(intentPerfil);
                return true;
        }
        return false;
    });*/
}

