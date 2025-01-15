package pt.ipleiria.estg.dei.lupsyapp.listeners;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;

public interface FaturaListener {
    void onRefreshListaFaturas(ArrayList<Fatura> listaFaturas);

    void onRefreshDetalhes(int op);
}
