package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import java.util.List;

public class FaturaHistorico extends Fatura {
    private String data;

    public FaturaHistorico(int id, int id_utilizador, String data_fatura, double total, String estado) {
        super(id, id_utilizador, data_fatura, total, estado);
    }

}
