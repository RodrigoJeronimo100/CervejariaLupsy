package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class BarraInferior extends AppCompatActivity {

    public static final int ADD = 100, EDIT = 200, DELETE = 300;
    public static final String OP_CODE = "OPERACAO_DETALHES";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_barra_inferior);
        // Iniciar na Home
        loadFragment(new HomeFragment());

        BottomNavigationView bottomNavigationView = findViewById(R.id.bottom_navigation);


        bottomNavigationView.setOnItemSelectedListener(item -> {
            Fragment selectedFragment = null;

            if (item.getItemId() == R.id.nav_lupa) {
                loadFragment(new HomeFragment());
                return true;
            } else if (item.getItemId() == R.id.nav_loja) {
                loadFragment(new LojaFragment());
                return true;
            } else if (item.getItemId() == R.id.nav_favoritos) {
                loadFragment(new FavoritosFragment());
                return true;
            } else if (item.getItemId() == R.id.nav_cart) {
                loadFragment(new CarrinhoFragment());
                return true;
            } else if (item.getItemId() == R.id.nav_perfil) {
                loadFragment(new PerfilFragment());
                return true;

            }

            return false;
        });

    }



    private void loadFragment(Fragment fragment) {
        getSupportFragmentManager().beginTransaction()
                .setCustomAnimations(
                        R.anim.fadein,
                        R.anim.fadeout
                )
                .replace(R.id.fragment_container, fragment)
                .addToBackStack(null)
                .commit();
    }

}
