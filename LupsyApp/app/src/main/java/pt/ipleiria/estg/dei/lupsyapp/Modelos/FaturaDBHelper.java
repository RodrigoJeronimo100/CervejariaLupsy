package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class FaturaDBHelper extends SQLiteOpenHelper {

    public static final String DB_NAME = "db";
    private static final int DB_VERSION = 1;
    private static final String TABLE_NAME = "faturas";
    private final SQLiteDatabase db;

    private static final String ID = "id";
    private static final String ID_UTILIZADOR = "id_utilizador";
    private static final String DATA_FATURA = "data_fatura";
    private static final String TOTAL = "total";
    private static final String ESTADO = "estado";

    public FaturaDBHelper(@Nullable Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db = getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createFaturaTable = "CREATE TABLE " + TABLE_NAME + " (" +
                ID + " INTEGER PRIMARY KEY, " +
                ID_UTILIZADOR + " INTEGER NOT NULL, " +
                DATA_FATURA + " TEXT NOT NULL, " +
                TOTAL + " DOUBLE NOT NULL, " +
                ESTADO + " TEXT NOT NULL" +
                ");";
        db.execSQL(createFaturaTable);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        this.onCreate(db);
    }

    public void adicionarFaturaBD(Fatura f) {
        ContentValues values = new ContentValues();
        values.put(ID, f.getId());
        values.put(ID_UTILIZADOR, f.getId_utilizador());
        values.put(DATA_FATURA, f.getData_fatura());
        values.put(TOTAL, f.getTotal());
        values.put(ESTADO, f.getEstado());

        this.db.insert(TABLE_NAME, null, values);
    }

    public ArrayList<Fatura> getAllFaturasBD() {
        ArrayList<Fatura> faturas = new ArrayList<>();

        Cursor cursor = this.db.query(TABLE_NAME, new String[]{ID, ID_UTILIZADOR, DATA_FATURA, TOTAL, ESTADO},
                null, null, null, null, null);

        if (cursor.moveToFirst()) {
            do {
                Fatura fatura = new Fatura(
                        cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getString(2),
                        cursor.getDouble(3),
                        cursor.getString(4)
                );
                faturas.add(fatura);
            } while (cursor.moveToNext());
        }

        return faturas;
    }


    public Fatura getFatura(int id) {
        Fatura fatura = null;

        Cursor cursor = this.db.query(
                TABLE_NAME,
                new String[]{ID, ID_UTILIZADOR, DATA_FATURA, TOTAL, ESTADO},
                ID + " = ?", // WHERE clause
                new String[]{String.valueOf(id)}, // WHERE values
                null,
                null,
                null
        );

        if (cursor != null && cursor.moveToFirst()) {
            fatura = new Fatura(
                    cursor.getInt(0),
                    cursor.getInt(1),
                    cursor.getString(2),
                    cursor.getDouble(3),
                    cursor.getString(4)
            );
            cursor.close();
        }

        return fatura;
    }
}
