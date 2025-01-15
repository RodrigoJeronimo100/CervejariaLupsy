package pt.ipleiria.estg.dei.lupsyapp.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import androidx.core.util.Pair;

import com.bumptech.glide.util.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.CervejaHistorico;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;

public class JsonParser {
    public static ArrayList<Cerveja> parserJsonCervejas(JSONArray response){
        ArrayList<Cerveja> cervejas = new ArrayList<>();

        try {
            for (int i = 0; i < response.length();i++)
            {
                JSONObject cerveja = (JSONObject) response.get(i);
                int id = cerveja.getInt("id");
                String nome = cerveja.getString("nome");
                String descricao = cerveja.getString("descricao");
                float teor_alcoolico = (float) cerveja.getDouble("teor_alcoolico");
                float preco = (float) cerveja.getDouble("preco");
                String estado = cerveja.getString("estado");
                String categoria_nome = cerveja.getString("categoria_nome");
                String fornecedor_nome = cerveja.getString("fornecedor_nome");

                Cerveja auxLivro = new Cerveja(id,nome,descricao,teor_alcoolico,preco,fornecedor_nome,categoria_nome,estado);
                cervejas.add(auxLivro);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return cervejas;
    }

    public static Pair<Utilizador, String> parseJsonLogin(String response) throws JSONException {
        try {
            JSONObject jsonResponse = new JSONObject(response);

            int id = jsonResponse.getInt("id");
            String nome = jsonResponse.getString("nome");
            String username = jsonResponse.getString("username");
            int nif = jsonResponse.getInt("nif");
            int telefone = jsonResponse.getInt("telefone");
            String morada = jsonResponse.getString("morada");
            String role = jsonResponse.getString("role");
            String token = jsonResponse.getString("token");

            Utilizador user = new Utilizador(id, nome, username, nif, telefone, morada, role);

            return new Pair<>(user, token);
        } catch (JSONException e) {
            System.out.println("-->Erro ao processar o JSON: " + e.getMessage());
            throw e; // Relance a exceção
        }

    }

    public static ArrayList<CervejaHistorico> parserJsonCervejasHistorico(JSONArray response){
        ArrayList<CervejaHistorico> cervejas = new ArrayList<>();

        try {
            for (int i = 0; i < response.length();i++)
            {
                JSONObject cerveja = (JSONObject) response.get(i);
                int id = cerveja.getInt("id");
                String nome = cerveja.getString("nome");
                String descricao = cerveja.getString("descricao");
                float teor_alcoolico = (float) cerveja.getDouble("teor_alcoolico");
                float preco = (float) cerveja.getDouble("preco");
                String estado = cerveja.getString("estado");
                String categoria_nome = cerveja.getString("categoria_nome");
                String fornecedor_nome = cerveja.getString("fornecedor_nome");
                String data = cerveja.getString("data");

                CervejaHistorico auxLivro = new CervejaHistorico(id,nome,descricao,teor_alcoolico,preco,fornecedor_nome,categoria_nome,estado,data);
                cervejas.add(auxLivro);
            }
        }catch (JSONException e){
            e.printStackTrace();
        }

        return cervejas;
    }

    public static ArrayList<Fatura> parserJsonFaturas(JSONArray response) {
        ArrayList<Fatura> faturas = new ArrayList<>();

        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject fatura = (JSONObject) response.get(i);

                // Parsing the fields from the JSON response
                int id = fatura.getInt("id");
                int id_utilizador = fatura.getInt("id_utilizador");
                String data_fatura = fatura.getString("data_fatura");
                Double total = fatura.getDouble("total");
                String estado = fatura.getString("estado");

                Fatura auxFatura = new Fatura(id, id_utilizador, data_fatura, total, estado);
                faturas.add(auxFatura);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return faturas;
    }

    public static boolean isConnectionInternet(Context context){
        if(context == null)
            return false;

        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();

        return networkInfo != null && networkInfo.isConnected();
    }

}
