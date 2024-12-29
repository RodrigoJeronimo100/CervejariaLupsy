package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.NoConnectionError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.util.Util;

import org.json.JSONArray;
import org.json.JSONException;

import java.lang.ref.WeakReference;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejaListener;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasHistoricoListener;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasListener;
import pt.ipleiria.estg.dei.lupsyapp.listeners.LoginListener;
import pt.ipleiria.estg.dei.lupsyapp.utils.JsonParser;

public class Singleton {

    private static final String BASE_URL = "http://192.168.1.68:8080";
    private static final String UrlAPICervejas = BASE_URL + "/api/cerveja";
    private static final String UrlAPILogin = BASE_URL + "/api/utilizador/auth";
    private static final String UrlAPIFavoritas = BASE_URL + "/api/favorita/get-favoritas?id_utilizador=";
    private static final String UrlAPIHistorico = BASE_URL + "/api/historico/get-historico?id_utilizador=";

    private static Singleton instance=null;
    private static RequestQueue volleyQueue = null;
    private ArrayList<Cerveja> cervejas;
    private CervejaDBHelper cervejaDBHelper;
    private UtilizadorDBHelper utilizadorDBHelper;
    private CervejasListener cervejasListener;
    private CervejaListener cervejaListener;
    private CervejasHistoricoListener cervejasHistoricoListener;
    private Utilizador utilizador;
    private LoginListener loginListener;
    private Context context; // Variável de instância para o context

    public static synchronized Singleton getInstance(Context context){
        if(instance==null){
            instance=new Singleton(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }


    private Singleton(Context context){
        // gerarDadosDinamico();
        cervejas = new ArrayList<>();
        cervejaDBHelper = new CervejaDBHelper(context);
        utilizadorDBHelper = new UtilizadorDBHelper(context);
    }

    // Registro dos listeners
    public void setCervejasListener(CervejasListener cervejasListener) {
        this.cervejasListener = cervejasListener;
    }
    public void setCervejaListener(CervejaListener cervejaListener) {
        this.cervejaListener = cervejaListener;
    }
    public void setLoginListener(LoginListener loginListener) {
        this.loginListener = loginListener;
    }
    public LoginListener getLoginListener() {
        return loginListener;
    }
    public void adicionarCervejasBD(ArrayList<Cerveja> cervejas){
        cervejaDBHelper.removerallCervejasdb();

        for (Cerveja c : cervejas){
            adicionarCervejaBD(c);
        }
    }

    public ArrayList<Cerveja> getCervejas() {
        return new ArrayList<>(cervejas);
    }

    public Cerveja getCerveja(int id) {
        for (Cerveja c : cervejas) {
            if (c.getId() == id) {
                return c;
            }
        }
        return null;
    }

    public void editarCerveja(Cerveja cerveja) {
        for (int i = 0; i < cervejas.size(); i++) {
            if (cervejas.get(i).getId() == cerveja.getId()) {
                cervejas.set(i, cerveja);
                adicionarCervejaBD(cerveja);
                break;
            }
        }
    }

    public void adicionarCerveja(Cerveja cerveja) {
        cervejas.add(cerveja);
        adicionarCervejaBD(cerveja);
    }


    private void adicionarCervejaBD(Cerveja c) {
        cervejaDBHelper.adicionarCervejaBD(c);
    }
    private void adicionarUtilizadorBD(Utilizador u) {
        utilizadorDBHelper.insertOrUpdateUtilizador(u);
    }
    public void getAllCervejasAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "Nao tem internet", Toast.LENGTH_SHORT).show();
            System.out.println("---> Nao tem net");
            //TODO: carregar cervejas da db atraves do metodo *FEITO*
            if(cervejasListener != null){
                cervejasListener.onRefreshListaCervejas(cervejaDBHelper.getAllCervejasBD());
                System.out.println("---> cervejas listener != null");
            }
            System.out.println("---> outro");
        }
        else {
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, UrlAPICervejas, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    System.out.println("---> GETAPI"+ response);
                    cervejas = JsonParser.parserJsonCervejas(response);
                    adicionarCervejasBD(cervejas);

                    //TODO: implementar listeners *FEITO*
                    if(cervejasListener != null){
                        cervejasListener.onRefreshListaCervejas(cervejas);
//                        System.out.println("---> Lista de cervejas:");
//                        for (Cerveja cerveja : cervejas) {
//                            System.out.println("Nome: " + cerveja.getNome() + ", Descrição: " + cerveja.getDescricao() +
//                                    ", Teor Alcoólico: " + cerveja.getTeor_alcoolico() + ", Preço: " + cerveja.getPreco());
//                        }
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    //Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                    String errorMessage;
                    if (error.networkResponse != null) {
                        // Obter o código de status HTTP da resposta
                        int statusCode = error.networkResponse.statusCode;

                        // Exibir mensagem baseada no código de status
                        errorMessage = "Erro do servidor: Código " + statusCode;

                        // (Opcional) Converter a resposta em string se for um erro com conteúdo
                        try {
                            String responseBody = new String(error.networkResponse.data, "utf-8");
                            errorMessage += "\nDetalhes: " + responseBody;
                        } catch (Exception e) {
                            errorMessage += "\nErro ao processar resposta.";
                        }
                    } else if (error instanceof TimeoutError) {
                        // Erro de timeout
                        errorMessage = "Erro de timeout: O servidor não respondeu a tempo.";
                    } else if (error instanceof NoConnectionError) {
                        // Erro de conexão
                        errorMessage = "Erro de conexão: Não foi possível se conectar ao servidor.";
                    } else {
                        // Outros tipos de erro
                        errorMessage = "Erro desconhecido: " + error.getMessage();
                    }

                    // Exibir mensagem de erro no Toast e no console
                    Toast.makeText(context, errorMessage, Toast.LENGTH_SHORT).show();
                    System.out.println("---> erro: " + errorMessage);
                }
            });
            // Adicionar política de timeout
            int timeout = 10000; // 10 segundos
            RetryPolicy policy = new DefaultRetryPolicy(timeout, DefaultRetryPolicy.DEFAULT_MAX_RETRIES, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT);
            request.setRetryPolicy(policy);
            volleyQueue.add(request);
        }
    }

    public void login(final String email, final String password,LoginListener loginListener, Context context) {
        this.loginListener = loginListener;
        this.context = context;
        StringRequest request = new StringRequest(
                Request.Method.POST,
                UrlAPILogin,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            utilizador = JsonParser.parseJsonLogin(response);
                        } catch (JSONException e) {
                            System.out.println("---> erro no jsonParseLogin");
                            throw new RuntimeException(e);
                        }
                        if (utilizador != null) {
                            // Armazene os dados do usuário nas SharedPreferences
                            SharedPreferences sharedPreferences = context.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
                            SharedPreferences.Editor editor = sharedPreferences.edit();
                            editor.putInt("userId", utilizador.getId());
                            editor.putString("nome", utilizador.getNome());
                            editor.putString("username", utilizador.getUsername());
                            editor.putInt("nif", utilizador.getNif());
                            editor.putInt("telefone", utilizador.getTelefone());
                            editor.putString("morada", utilizador.getMorada());
                            editor.putString("role", utilizador.getRole());
                            editor.apply();
                            loginListener.onValidateLogin(utilizador, context);
                            utilizadorDBHelper.insertOrUpdateUtilizador(utilizador);
                            System.out.println("---> utilizador existe: " + utilizador.getNome());
                        } else {
                            // Lidar com erro de autenticação
                            System.out.println("---> erro de autenticacao");
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // Lidar com erro na requisição
                        if (error instanceof VolleyError && error.networkResponse != null && error.networkResponse.statusCode == 403) {

                            if (loginListener != null) {
                                loginListener.onValidateLogin(null,context);
                                System.out.println("---> erro 403 "+error.getMessage());
                            }
                        } else {
                            // Outro tipo de erro
                            System.out.println("---> erro na requisição "+error.getMessage());
                        }
                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("username", email);
                params.put("password", password);
                System.out.println("---> params: " + params);
                return params;
            }
        };

        volleyQueue.add(request);
    }

    public void logout() {
        utilizador = null;
    }

    private int getUserId(Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        return sharedPreferences.getInt("userId", -1); // -1 indica que nenhum usuário está logado
    }
    public Utilizador getUtilizadorGuardado(Context context) {
        this.context = context;
        SharedPreferences sharedPreferences = context.getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        String username = sharedPreferences.getString("username", null);

        int id = sharedPreferences.getInt("userId", -1);
        String nome = sharedPreferences.getString("nome", null);
        int nif = sharedPreferences.getInt("nif", -1);
        int telefone = sharedPreferences.getInt("telefone", -1);
        String morada = sharedPreferences.getString("morada", null);
        String role = sharedPreferences.getString("role", null);
        System.out.println("Utilizador guardado: "+ username+" " +id+" "+nome+" "+nif+" "+telefone+" "+morada+" "+role);
        if (username != null && id != -1 && nome != null && nif != -1 && telefone != -1 && morada != null && role != null) {
            // Crie um objeto Utilizador com os dados guardados
            utilizador = new Utilizador(id, nome, username, nif, telefone, morada, role);
            utilizadorDBHelper.insertOrUpdateUtilizador(utilizador);
            System.out.println("Utilizador guardado classe: "+ utilizador);
            return utilizador;
        } else {
            return null; // Nenhum utilizador guardado
        }
    }

    public void buscarFavoritas(final Response.Listener<List<Cerveja>> listener, final Response.ErrorListener errorListener) {
        int userId = getUserId(context);

        if (userId != -1) {
            String url = UrlAPIFavoritas + userId;

            JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            List<Cerveja> cervejasFavoritas = JsonParser.parserJsonCervejas(response); // Envia o response diretamente

                            // Verifica se a lista está vazia
                            if (cervejasFavoritas.isEmpty()) {
                                // não mostrar nada no fragmento)
                            } else {
                                listener.onResponse(cervejasFavoritas);
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            errorListener.onErrorResponse(error);
                        }
                    }
            );

            RequestQueue requestQueue = Volley.newRequestQueue(context);
            requestQueue.add(jsonArrayRequest);
        } else {
            // Lidar com o caso em que nenhum utilizador está logado
            // ...
        }
    }
    public void buscarHistorico(final Response.Listener<List<CervejaHistorico>> listener, final Response.ErrorListener errorListener) {
        if (!JsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Nao tem internet", Toast.LENGTH_SHORT).show();
            System.out.println("---> Nao tem net");
            if (cervejasHistoricoListener != null) {
                cervejasHistoricoListener.onRefreshListaCervejas(cervejaDBHelper.getAllCervejasHistorico());
                System.out.println("---> cervejas listener != null");
            }
            System.out.println("---> outro");
        } else {
            int userId = getUserId(context);

            if (userId != -1) {
                String url = UrlAPIHistorico + userId;

                JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null,
                        new Response.Listener<JSONArray>() {
                            @Override
                            public void onResponse(JSONArray response) {
                                List<CervejaHistorico> historicoCervejas = JsonParser.parserJsonCervejasHistorico(response); // Envia o response diretamente

                                // Verifica se a lista está vazia
                                if (historicoCervejas.isEmpty()) {
                                    //retorna nada
                                } else {
                                    cervejaDBHelper.removerallCervejasHistorico(); // Limpa o histórico anterior
                                    for (CervejaHistorico cerveja : historicoCervejas) {
                                        cervejaDBHelper.adicionarCervejaHistoricoBD(cerveja);
                                    }
                                    listener.onResponse(historicoCervejas);
                                }
                            }
                        },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                errorListener.onErrorResponse(error);
                            }
                        }
                );

                RequestQueue requestQueue = Volley.newRequestQueue(context);
                requestQueue.add(jsonArrayRequest);
            } else {
                // Lidar com o caso em que nenhum usuário está logado
                // ...
            }
        }
    }
}
