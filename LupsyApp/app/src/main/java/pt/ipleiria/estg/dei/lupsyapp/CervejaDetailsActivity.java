package pt.ipleiria.estg.dei.lupsyapp;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.animation.ObjectAnimator;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import org.json.JSONException;
import org.json.JSONObject;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Singleton;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.UtilizadorDBHelper;

public class CervejaDetailsActivity extends AppCompatActivity {

    private TextView tv_nome, tv_descricao, tv_teor_alcool, tv_preco, tvQuantity;
    private ImageView imgCapa, heartImageView;
    private CardView heartContainer, tchimTchimButton, btnAddToCart;
    private Button btnPlus, btnMinus;
    private Cerveja cerveja;
    private boolean isFavorited = false;
    private int quantity = 1; // Valor inicial

    public static final String ID_CERVEJA = "ID_CERVEJA";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cerveja_details);


        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        }

        tv_nome = findViewById(R.id.tv_nome);
        tv_descricao = findViewById(R.id.tv_descricao);
        tv_teor_alcool = findViewById(R.id.tv_teor_alcool);
        tv_preco = findViewById(R.id.tv_preco);
        imgCapa = findViewById(R.id.imgCapa);
        heartImageView = findViewById(R.id.heartImageView);
        heartContainer = findViewById(R.id.btn_favoritos);
        tchimTchimButton = findViewById(R.id.btn_tchim_tchim);
        tvQuantity = findViewById(R.id.tv_quantity);
        btnPlus = findViewById(R.id.btn_plus);
        btnMinus = findViewById(R.id.btn_minus);
        btnAddToCart = findViewById(R.id.btn_carrinho);


        int id = getIntent().getIntExtra(ID_CERVEJA, 0);
        Singleton.getInstance(this).getAllCervejasAPI(this);
        cerveja = Singleton.getInstance(this).getCerveja(id);

        if (cerveja != null) {
            carregarDetalhes();
        } else {
            System.out.println("Erro ao carregar os detalhes da cerveja");
        }


        isFavorite(id);

        // Listener para o botão de favoritos
        heartContainer.setOnClickListener(v -> {
            isFavorited = !isFavorited;
            toggleFavorite(id);
        });

        // Listener para o botão Tchim-Tchim
        tchimTchimButton.setOnClickListener(v ->{
            int id_cerveja = id;
            Singleton.getInstance(getApplicationContext()).Beber(id_cerveja);
        });

        // Listener para o botão "+"
        btnPlus.setOnClickListener(v -> {
            if (quantity < 100) {
                quantity++;
                tvQuantity.setText(String.valueOf(quantity));
            }
        });

        // Listener para o botão "-"
        btnMinus.setOnClickListener(v -> {
            if (quantity > 1) {
                quantity--;
                tvQuantity.setText(String.valueOf(quantity));
            }
        });

        btnAddToCart.setOnClickListener(v -> addToCart());
    }

    public void carrinhoClicado(View view) {
        // Obtendo o utilizador logado
        UtilizadorDBHelper dbHelper = new UtilizadorDBHelper(this);
        Utilizador utilizador = dbHelper.getUtilizador(this);

        if (utilizador != null) {
            int idUtilizador = utilizador.getId();  // Obtendo o ID do utilizador logado
            int quantity = Integer.parseInt(tvQuantity.getText().toString());  // Obtendo a quantidade da interface
            int idCerveja = cerveja.getId();
            double preco = cerveja.getPreco();

            // Calculando o total com a quantidade de cervejas
            double total = cerveja.getPreco() * quantity;

            // Chamando o método do Singleton para adicionar a cerveja à fatura
            Singleton.getInstance(this).adicionarAoCarrinhoAPI(this,idCerveja,quantity,preco,
                    new Response.Listener<JSONObject>() {
                        @Override
                        public void onResponse(JSONObject response) {
                            try {
                                if (response.has("success")) {
                                    String successMessage = response.getString("success");
                                    Toast.makeText(CervejaDetailsActivity.this, successMessage, Toast.LENGTH_SHORT).show();
                                    }
                                else if (response.has("errors")) { // Verifica se a chave "errors" existe
                                    // Erro ao adicionar ao carrinho
                                    JSONObject errors = response.getJSONObject("errors");
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {

                        }
                    });
        } else {
            // Caso não tenha um utilizador logado
            Toast.makeText(this, "Nenhum utilizador logado", Toast.LENGTH_SHORT).show();
        }
    }

    private void carregarDetalhes() {
        if (cerveja != null) {
            tv_nome.setText(cerveja.getNome());
            tv_descricao.setText(cerveja.getDescricao());
            tv_teor_alcool.setText(String.format("%.1f %%", cerveja.getTeor_alcoolico()));
            tv_preco.setText(String.format("%.2f €", cerveja.getPreco()));
        } else {
            Toast.makeText(this, "Erro ao carregar os detalhes da cerveja", Toast.LENGTH_SHORT).show();
        }
    }

    private void toggleFavorite(int id) {
        ObjectAnimator fadeOut = ObjectAnimator.ofFloat(heartImageView, "alpha", 1f, 0f);
        fadeOut.setDuration(100);

        fadeOut.addListener(new AnimatorListenerAdapter() {
            @Override
            public void onAnimationEnd(Animator animation) {
                if (isFavorited) {
                    heartImageView.setImageResource(R.drawable.heart_full);
                    Singleton.getInstance(CervejaDetailsActivity.this).togglefavoriteAPI(id);
                } else {
                    heartImageView.setImageResource(R.drawable.heart_blank);
                    Singleton.getInstance(CervejaDetailsActivity.this).togglefavoriteAPI(id);
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

    private void addToCart() {
        for (int i = 0; i < quantity; i++) {
            Singleton.getInstance(this).adicionarAoCarrinho(cerveja);
        }
        String message = quantity + " cervejas foram adicionadas ao teu carrinho";
        new AlertDialog.Builder(this)
                .setTitle("Carrinho")
                .setMessage(message)
                .setPositiveButton("OK", (dialog, which) -> dialog.dismiss())
                .create()
                .show();
    }

    public void isFavorite(int id) {
        Singleton.getInstance(this).isFavorito(id, new Response.Listener<Boolean>() {
            @Override
            public void onResponse(Boolean isFavorito) {
                if (isFavorito) {
                    heartImageView.setImageResource(R.drawable.heart_full);
                    isFavorited = true;
                } else {
                    heartImageView.setImageResource(R.drawable.heart_blank);
                    isFavorited = false;
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("CervejaDetailsActivity", "Erro ao verificar favorito: " + error.getMessage());
                Toast.makeText(CervejaDetailsActivity.this, "Erro ao verificar favorito", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (cerveja != null) {
            return super.onCreateOptionsMenu(menu);

        }
        return false;


    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            onBackPressed();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

}
