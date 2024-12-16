package pt.ipleiria.estg.dei.lupsyapp.Modelos;

public class Cerveja {
        private int id, id_fornecedor, id_categoria;
        private Boolean estado;
        private String nome, descricao;
        private Float teor_alcoolico, preco;

        public Cerveja(int id, String nome, String descricao, Float teor_alcoolico, Float preco, int id_fornecedor, int id_categoria, Boolean estado) {
            this.id = id;
            this.nome = nome;
            this.descricao = descricao;
            this.teor_alcoolico = teor_alcoolico;
            this.preco = preco;
            this.id_fornecedor = id_fornecedor;
            this.id_categoria = id_categoria;
            this.estado = estado;
        }
}
