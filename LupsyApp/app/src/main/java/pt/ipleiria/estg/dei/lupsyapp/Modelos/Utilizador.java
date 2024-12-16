package pt.ipleiria.estg.dei.lupsyapp.Modelos;

public class Utilizador {
    private int id, nif, telefone, id_user;
    private String nome, morada, username, password;

    public Utilizador(int id, String nome, String username, String password, int nif, int telefone, String morada , int id_user) {
        this.id = id;
        this.nome = nome;
        this.username = username;
        this.password = password;
        this.nif = nif;
        this.telefone = telefone;
        this.morada = morada;
        this.id_user = id_user;
    }
}
