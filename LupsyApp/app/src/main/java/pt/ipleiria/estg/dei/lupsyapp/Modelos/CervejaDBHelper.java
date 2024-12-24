package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class CervejaDBHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "db";
    private static final int DB_VERSION = 1;
    private final SQLiteDatabase db;

    private static final String TABLE_NAME = "cervejas";
    private static final String NOME = "nome";
    private static final String ID = "id";
    private static final String DESCRICAO = "descricao";
    private static final String TEOR_ALCOOLICO = "teor_alcoolico";
    private static final String PRECO = "preco";
    private static final String ESTADO = "estado";
    private static final String CATEGORIA_NOME = "categoria_nome";
    private static final String FORNECEDOR_NOME = "fornecedor_nome";

    public CervejaDBHelper(@Nullable Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createCervejaTable = "CREATE TABLE " + TABLE_NAME + "("+ID+" INTEGER, "+ NOME+ " TEXT NOT NULL, "
                +DESCRICAO+ " TEXT NOT NULL, "+ TEOR_ALCOOLICO + " REAL NOT NULL, "+ FORNECEDOR_NOME + " TEXT NOT NULL, "+ ESTADO + " TEXT NOT NULL, "+PRECO+" REAL NOT NULL, "+ CATEGORIA_NOME
                +" TEXT"+");";
        db.execSQL(createCervejaTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+ TABLE_NAME);
        this.onCreate(db);
    }

    public void adicionarCervejaBD(Cerveja c) {
        ContentValues values = new ContentValues();

        values.put(ID, c.getId());
        values.put(NOME, c.getNome());
        values.put(DESCRICAO, c.getDescricao());
        values.put(TEOR_ALCOOLICO, c.getTeor_alcoolico());
        values.put(FORNECEDOR_NOME, c.getFornecedor_nome());
        values.put(ESTADO, c.getEstado());
        values.put(PRECO, c.getPreco());
        values.put(CATEGORIA_NOME, c.getCategoria_nome());
        System.out.println("---> adicinarCervejaDB");
        this.db.insert(TABLE_NAME,null,values);
    }

    public ArrayList<Cerveja> getAllCervejasBD() {
        ArrayList<Cerveja> cervejas = new ArrayList<>();

        Cursor cursor = this.db.query(TABLE_NAME,new String[]{ID,NOME,DESCRICAO,TEOR_ALCOOLICO,FORNECEDOR_NOME,ESTADO,PRECO,CATEGORIA_NOME},null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                Cerveja auxCerveja = new Cerveja(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getString(2),
                        cursor.getFloat(3),
                        cursor.getFloat(6),
                        cursor.getString(4),
                        cursor.getString(7),
                        cursor.getString(5)
                );

                cervejas.add(auxCerveja);
            }while (cursor.moveToNext());
        }
        System.out.println("---> getALLCervejasDB");
        return cervejas;
    }
    public void removerallCervejasdb(){
        this.db.delete(TABLE_NAME, null,null);
    }
}
