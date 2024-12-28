package pt.ipleiria.estg.dei.lupsyapp.Modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class UtilizadorDBHelper extends SQLiteOpenHelper {

    private static final String DATABASE_NAME = "utilizador_database";
    private static final int DATABASE_VERSION = 1;
    private static final String TABLE_NAME = "utilizadores";
    private static final String COLUMN_ID = "id";
    private static final String COLUMN_NOME = "nome";
    private static final String COLUMN_USERNAME = "username";
    private static final String COLUMN_NIF = "nif";
    private static final String COLUMN_TELEFONE = "telefone";
    private static final String COLUMN_MORADA = "morada";
    private static final String COLUMN_ROLE = "role";
    private static final String COLUMN_IS_CURRENT_USER = "is_current_user";

    public UtilizadorDBHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String createTableQuery = "CREATE TABLE " + TABLE_NAME + " (" +
                COLUMN_ID + " INTEGER PRIMARY KEY," +
                COLUMN_NOME + " TEXT," +
                COLUMN_USERNAME + " TEXT," +
                COLUMN_NIF + " INTEGER," +
                COLUMN_TELEFONE + " INTEGER," +
                COLUMN_MORADA + " TEXT," +
                COLUMN_ROLE + " TEXT," +
                COLUMN_IS_CURRENT_USER + " INTEGER DEFAULT 0)";
        db.execSQL(createTableQuery);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+ TABLE_NAME);
        onCreate(db);
    }

    public void insertOrUpdateUtilizador(Utilizador utilizador) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_ID, utilizador.getId());
        values.put(COLUMN_NOME, utilizador.getNome());
        values.put(COLUMN_USERNAME, utilizador.getUsername());
        values.put(COLUMN_NIF, utilizador.getNif());
        values.put(COLUMN_TELEFONE, utilizador.getTelefone());
        values.put(COLUMN_MORADA, utilizador.getMorada());
        values.put(COLUMN_ROLE, utilizador.getRole());
        values.put(COLUMN_IS_CURRENT_USER, 1); // Definir como usuário atual

        // Verificar se já existe um usuário na tabela
        long rowsAffected = db.update(TABLE_NAME, values, COLUMN_IS_CURRENT_USER + " = ?", new String[]{"1"});

        // Se nenhum usuário foi atualizado, inserir um novo
        if (rowsAffected == 0) {
            rowsAffected = db.insert(TABLE_NAME, null, values);
        }

        db.close();
    }
    public Utilizador getUtilizador(Context context) {
        UtilizadorDBHelper dbHelper = new UtilizadorDBHelper(context);
        SQLiteDatabase db = dbHelper.getReadableDatabase();
        Utilizador utilizador = null;

        Cursor cursor = db.query(
                UtilizadorDBHelper.TABLE_NAME,
                null, // Selecionar todas as colunas
                UtilizadorDBHelper.COLUMN_IS_CURRENT_USER + " = ?", // Cláusula WHERE
                new String[]{"1"}, // Valor para a cláusula WHERE
                null,
                null,
                null
        );

        if (cursor != null && cursor.moveToFirst()) {
            // Criar um objeto Utilizador com os dados do cursor
            utilizador = new Utilizador(
                    cursor.getInt(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_ID)),
                    cursor.getString(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_NOME)),
                    cursor.getString(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_USERNAME)),
                    cursor.getInt(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_NIF)),
                    cursor.getInt(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_TELEFONE)),
                    cursor.getString(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_MORADA)),
                    cursor.getString(cursor.getColumnIndexOrThrow(UtilizadorDBHelper.COLUMN_ROLE))
            );
            cursor.close();
        }

        db.close();
        return utilizador;
    }
}
