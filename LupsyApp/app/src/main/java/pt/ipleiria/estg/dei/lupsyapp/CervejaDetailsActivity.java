package pt.ipleiria.estg.dei.lupsyapp;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.animation.ObjectAnimator;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
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
    private CardView heartContainer, tchimTchimButton;
    private Cerveja cerveja;
    private boolean isFavorited = false;
    private TextView tvQuantity;
    private Button btnPlus, btnMinus;
    private int quantity = 1;  // Valor inicial

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
        tchimTchimButton.setOnClickListener(v -> showMessageBox());

        tvQuantity = findViewById(R.id.tv_quantity);
        btnPlus = findViewById(R.id.btn_plus);
        btnMinus = findViewById(R.id.btn_minus);

        // Listener for the "+" button
        btnPlus.setOnClickListener(v -> {
            if (quantity < 10) {
                quantity++;
                tvQuantity.setText(String.valueOf(quantity));
            }
        });

        // Listener for the "-" button
        btnMinus.setOnClickListener(v -> {
            if (quantity > 1) {
                quantity--;
                tvQuantity.setText(String.valueOf(quantity));
            }
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
        ObjectAnimator fadeOut = ObjectAnimator.ofFloat(heartImageView, "alpha", 1f, 0f);
        fadeOut.setDuration(100);

        fadeOut.addListener(new AnimatorListenerAdapter() {
            @Override
            public void onAnimationEnd(Animator animation) {
                if (isFavorited) {
                    heartImageView.setImageResource(R.drawable.heart_full);
                    Toast.makeText(CervejaDetailsActivity.this, "Cerveja Adicionada aos Favoritos", Toast.LENGTH_SHORT).show();
                } else {
                    heartImageView.setImageResource(R.drawable.heart_blank);
                    Toast.makeText(CervejaDetailsActivity.this, "Cerveja Removida dos Favoritos", Toast.LENGTH_SHORT).show();
                }

                ObjectAnimator fadeIn = ObjectAnimator.ofFloat(heartImageView, "alpha", 0f, 1f);
                fadeIn.setDuration(200);
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


    public void carrinhoClicado(View view) {
        String message = quantity + " cervejas foram adicionadas ao teu carrinho";
        new AlertDialog.Builder(this)
                .setTitle("Carrinho")
                .setMessage(message)
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
