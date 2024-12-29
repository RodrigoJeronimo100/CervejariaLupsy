package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

public class CervejaHistorico extends Cerveja{
    private String data;

    public CervejaHistorico(int id, String nome, String descricao, Float teor_alcoolico, Float preco, String fornecedor_nome, String categoria_nome, String estado, String data) {
        super(id, nome, descricao, teor_alcoolico, preco, fornecedor_nome, categoria_nome, estado);
        this.data = data;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }
    public static List<CervejaHistorico> getTop3CervejasFromList(List<CervejaHistorico> cervejas) {
        System.out.println("lista cervejas: "+cervejas);
        Map<CervejaHistorico, Integer> frequencyMap = new HashMap<>();
        for (CervejaHistorico cerveja : cervejas) {
            frequencyMap.put(cerveja, frequencyMap.getOrDefault(cerveja, 0) + 1);
        }

        List<CervejaHistorico> top3Cervejas = frequencyMap.entrySet().stream()
                .sorted(Map.Entry.<CervejaHistorico, Integer>comparingByValue().reversed())
                .limit(3)
                .map(Map.Entry::getKey)
                .collect(Collectors.toList());
        System.out.println("top3 : "+top3Cervejas);
        return top3Cervejas;
    }

    public static int contarFrequenciaCerveja(List<CervejaHistorico> cervejas, CervejaHistorico cervejaAlvo) {
        int frequencia = 0;
        for (CervejaHistorico cerveja : cervejas) {
            if (cerveja.equals(cervejaAlvo)) { // Usa o método equals para comparar as cervejas
                frequencia++;
            }
        }
        return frequencia;
    }
}
