package pt.ipleiria.estg.dei.lupsyapp.Modelos;

public class ItemFatura {
    private int id;
    private int id_fatura;
    private int id_cerveja;
    private int quantidade;
    private double preco;

    public ItemFatura(int id, int id_fatura, int id_cerveja, int quantidade, double preco) {
        this.id = id;
        this.id_fatura = id_fatura;
        this.id_cerveja = id_cerveja;
        this.quantidade = quantidade;
        this.preco = preco;
    }

    public int getId_fatura() {
        return id_fatura;
    }

    public void setId_fatura(int id_fatura) {
        this.id_fatura = id_fatura;
    }

    public int getId() {
        return id;
    }

    public int getId_cerveja() {
        return id_cerveja;
    }

    public void setId_cerveja(int id_cerveja) {
        this.id_cerveja = id_cerveja;
    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }

    public double getPreco() {
        return preco;
    }

    public void setPreco(double preco) {
        this.preco = preco;
    }
}
