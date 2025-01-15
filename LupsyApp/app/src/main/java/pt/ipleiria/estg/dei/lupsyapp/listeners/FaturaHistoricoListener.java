package pt.ipleiria.estg.dei.lupsyapp.listeners;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Fatura;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.FaturaHistorico;

public interface FaturaHistoricoListener {
    void onRefreshListaFaturas(ArrayList<FaturaHistorico> listaFaturas);
}
