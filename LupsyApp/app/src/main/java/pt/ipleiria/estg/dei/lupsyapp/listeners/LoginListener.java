package pt.ipleiria.estg.dei.lupsyapp.listeners;

import android.content.Context;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Utilizador;

public interface LoginListener {
    void onValidateLogin(final Utilizador utilizador, final Context context);
}
