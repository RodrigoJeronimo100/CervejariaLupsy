package pt.ipleiria.estg.dei.lupsyapp.Modelos;

public class Utilizador {
    private int id, nif, telefone;
    private String nome, morada, username, role;

    public Utilizador(int id, String nome, String username, int nif, int telefone, String morada , String role) {
        this.id = id;
        this.nome = nome;
        this.username = username;
        this.nif = nif;
        this.telefone = telefone;
        this.morada = morada;
        this.role = role;
    }

    public int getId() {
        return id;
    }

    public int getTelefone() {
        return telefone;
    }

    public void setTelefone(int telefone) {
        this.telefone = telefone;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getMorada() {
        return morada;
    }

    public void setMorada(String morada) {
        this.morada = morada;
    }

    public String getUsername() {
        return username;
    }

    public String getRole() {
        return role;
    }
}
