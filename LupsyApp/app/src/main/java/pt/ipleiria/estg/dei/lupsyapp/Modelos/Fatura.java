package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import java.util.Objects;

public class Fatura {
    private int id, id_utilizador;
    private String data_fatura, estado;
    private double total;

    public Fatura(int id, int id_utilizador, String data_fatura, double total, String estado) {
        this.id = id;
        this.id_utilizador = id_utilizador;
        this.data_fatura = data_fatura;
        this.total = total;
        this.estado = estado;

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_utilizador() {
        return id_utilizador;
    }

    public void setId_utilizador(int id_utilizador) {
        this.id_utilizador = id_utilizador;
    }

    public String getData_fatura() {
        return data_fatura;
    }

    public void setData_fatura(String data_fatura) {
        this.data_fatura = data_fatura;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public double getTotal() {
        return total;
    }

    public void setTotal(double total) {
        this.total = total;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Fatura fatura = (Fatura) o;
        return id == fatura.id;
    }

    @Override
    public int hashCode() {
        return Objects.hash(id);
    }
}
