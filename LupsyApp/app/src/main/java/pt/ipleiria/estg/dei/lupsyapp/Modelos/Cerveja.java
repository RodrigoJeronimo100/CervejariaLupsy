package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import java.util.Objects;

public class Cerveja {
        private int id;
        private String nome, descricao, fornecedor_nome, categoria_nome, estado;
        private Float teor_alcoolico, preco;

        public Cerveja(int id, String nome, String descricao, Float teor_alcoolico, Float preco, String fornecedor_nome, String categoria_nome, String estado) {
            this.id = id;
            this.nome = nome;
            this.descricao = descricao;
            this.teor_alcoolico = teor_alcoolico;
            this.preco = preco;
            this.fornecedor_nome = fornecedor_nome;
            this.categoria_nome = categoria_nome;
            this.estado = estado;

        }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getFornecedor_nome() {
        return fornecedor_nome;
    }

    public void setFornecedor_nome(String fornecedor_nome) {
        this.fornecedor_nome = fornecedor_nome;
    }

    public String getCategoria_nome() {
        return categoria_nome;
    }

    public void setCategoria_nome(String categoria_nome) {
        this.categoria_nome = categoria_nome;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public Float getTeor_alcoolico() {
        return teor_alcoolico;
    }

    public void setTeor_alcoolico(Float teor_alcoolico) {
        this.teor_alcoolico = teor_alcoolico;
    }

    public Float getPreco() {
        return preco;
    }

    public void setPreco(Float preco) {
        this.preco = preco;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Cerveja cerveja = (Cerveja) o;
        return id == cerveja.id; // Compara as cervejas pelo ID
    }

    @Override
    public int hashCode() {
        return Objects.hash(id); // Gera o hashCode com base no ID
    }
}
