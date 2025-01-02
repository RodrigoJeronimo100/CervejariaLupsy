package pt.ipleiria.estg.dei.lupsyapp.listeners;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Cerveja;
import pt.ipleiria.estg.dei.lupsyapp.Modelos.CervejaHistorico;

public interface CervejasHistoricoListener {
    void onRefreshListaCervejas(ArrayList<CervejaHistorico> listaCervejas);
}
