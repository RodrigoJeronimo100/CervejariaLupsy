package pt.ipleiria.estg.dei.lupsyapp;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.animation.ObjectAnimator;
import android.os.Bundle;
import android.view.Menu;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;

public class CervejaDetailsActivity extends AppCompatActivity {

    private TextView tv_nome, tv_descricao, tv_teor_alcool, tv_preco;
    private ImageView imgCapa, heartImageView;
    private CardView heartContainer, tchimTchimButton; // Reference for both buttons
    private Cerveja cerveja;
    private boolean isFavorited = false;  // Track if beer is favorited

    public static final String ID_CERVEJA = "ID_CERVEJA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cerveja_details);

        tv_nome = findViewById(R.id.tv_nome);
        tv_descricao = findViewById(R.id.tv_descricao);
        tv_teor_alcool = findViewById(R.id.tv_teor_alcool);
        tv_preco = findViewById(R.id.tv_preco);
        imgCapa = findViewById(R.id.imgCapa);
        heartImageView = findViewById(R.id.heartImageView);
        heartContainer = findViewById(R.id.btn_favoritos);
        tchimTchimButton = findViewById(R.id.btn_tchim_tchim);

        int id = getIntent().getIntExtra(ID_CERVEJA, 0);
        cerveja = Singleton.getInstance(this).getCerveja(id);

        carregarDetalhes();

        toggleFavorite();

        // Click listener for heartContainer
        heartContainer.setOnClickListener(v -> {
            isFavorited = !isFavorited;
            toggleFavorite();
        });

        // Click listener for Tchim-Tchim button
        tchimTchimButton.setOnClickListener(v -> {
            // Show the message box (AlertDialog)
            showMessageBox();
        });
    }

    private void carregarDetalhes() {
        if (cerveja != null) {
            tv_nome.setText(cerveja.getNome());
            tv_descricao.setText(cerveja.getDescricao());
            tv_teor_alcool.setText(String.format("%.1f %%", cerveja.getTeor_alcoolico()));
            tv_preco.setText(String.format("%.2f €", cerveja.getPreco()));
        }
    }

    private void toggleFavorite() {
        // Fade transition for smooth toggle
        ObjectAnimator fadeOut = ObjectAnimator.ofFloat(heartImageView, "alpha", 1f, 0f);
        fadeOut.setDuration(100);  // Fade-out duration

        fadeOut.addListener(new AnimatorListenerAdapter() {
            @Override
            public void onAnimationEnd(Animator animation) {
                // Change the image after fade-out
                if (isFavorited) {
                    heartImageView.setImageResource(R.drawable.heart_full);
                    Toast.makeText(CervejaDetailsActivity.this, "Cerveja Adicionada aos Favoritos", Toast.LENGTH_SHORT).show();
                } else {
                    heartImageView.setImageResource(R.drawable.heart_blank);
                    Toast.makeText(CervejaDetailsActivity.this, "Cerveja Removida dos Favoritos", Toast.LENGTH_SHORT).show();
                }

                // Fade in the new image
                ObjectAnimator fadeIn = ObjectAnimator.ofFloat(heartImageView, "alpha", 0f, 1f);
                fadeIn.setDuration(200); // Fade-in duration
                fadeIn.start();
            }
        });

        fadeOut.start();
    }



    private void showMessageBox() {
        new AlertDialog.Builder(this)
                .setTitle("Histórico")
                .setMessage("Adicionaste uma Cerveja ao teu histórico")
                .setPositiveButton("OK", (dialog, which) -> dialog.dismiss())
                .create()
                .show();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (cerveja != null) {
            return super.onCreateOptionsMenu(menu);
        }
        return false;
    }
}
