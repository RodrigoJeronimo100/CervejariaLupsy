package pt.ipleiria.estg.dei.lupsyapp.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;

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

    public static boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();

        return networkInfo != null && networkInfo.isConnected();
    }

}
