package pt.ipleiria.estg.dei.lupsyapp.listeners;

import java.util.ArrayList;


import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;

public interface FaturasListener {
    void onRefreshListaFaturas(ArrayList<Fatura> listaFaturas);
}
