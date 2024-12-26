package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import android.content.Context;
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
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejaListener;
import pt.ipleiria.estg.dei.lupsyapp.listeners.CervejasListener;
import pt.ipleiria.estg.dei.lupsyapp.utils.JsonParser;

public class Singleton {

    private static final String UrlAPICervejas = "http://192.168.1.68:8080/api/cerveja";
    private static Singleton instance=null;
    private static RequestQueue volleyQueue = null;
    private ArrayList<Cerveja> cervejas;
    private CervejaDBHelper cervejaDBHelper;
    private CervejasListener cervejasListener;
    private CervejaListener cervejaListener;

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
    }

    // Registro dos listeners
    public void setCervejasListener(CervejasListener cervejasListener) {
        this.cervejasListener = cervejasListener;
    }
    public void setCervejaListener(CervejaListener cervejaListener) {
        this.cervejaListener = cervejaListener;
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

    private void adicionarCervejaBD(Cerveja c) {
        cervejaDBHelper.adicionarCervejaBD(c);
    }

    public void getAllCervejasAPI(final Context context){
        if (!JsonParser.isConnectionInternet(context)){
            Toast.makeText(context, "Nao tem internet", Toast.LENGTH_SHORT).show();
            System.out.println("---> Nao tem net");
            //TODO: carregar livros da db atraves do metodo getalllivrosdb *FEITO*
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
                        System.out.println("---> Lista de cervejas:");
                        for (Cerveja cerveja : cervejas) {
                            System.out.println("Nome: " + cerveja.getNome() + ", Descrição: " + cerveja.getDescricao() +
                                    ", Teor Alcoólico: " + cerveja.getTeor_alcoolico() + ", Preço: " + cerveja.getPreco());
                        }
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
}
