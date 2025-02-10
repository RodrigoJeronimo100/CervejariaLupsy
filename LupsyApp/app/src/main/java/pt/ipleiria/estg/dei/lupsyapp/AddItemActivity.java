package pt.ipleiria.estg.dei.lupsyapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import pt.ipleiria.estg.dei.lupsyapp.utils.ItemManager;

public class AddItemActivity extends AppCompatActivity {

    private EditText editTextItemName;
    private FloatingActionButton fabSaveItem;
    private String currentItemName;
    private int itemPosition = -1;  // -1 means a new item

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_item);

        editTextItemName = findViewById(R.id.editTextItemName);
        fabSaveItem = findViewById(R.id.fabSaveItem);

        // Get item data (if it's an edit operation)
        Intent intent = getIntent();
        currentItemName = intent.getStringExtra("itemName");
        itemPosition = intent.getIntExtra("itemPosition", -1);

        if (itemPosition >= 0) {
            // Pre-fill the EditText with the existing item name, if it's an edit
            editTextItemName.setText(currentItemName);
        }

        fabSaveItem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String itemName = editTextItemName.getText().toString().trim();

                if (!itemName.isEmpty()) {
                    Intent resultIntent = new Intent();
                    resultIntent.putExtra("itemName", itemName);
                    resultIntent.putExtra("itemPosition", itemPosition);  // Pass item position if it's an edit
                    setResult(RESULT_OK, resultIntent);  // Return the result to the fragment
                    finish();  // Close the activity
                } else {
                    Toast.makeText(AddItemActivity.this, "Item name cannot be empty", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    // Inflate the options menu with the delete item
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_delete, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == R.id.action_delete) {

            if (itemPosition >= 0) {
                ItemManager.deleteItem(itemPosition);

                Intent resultIntent = new Intent();
                resultIntent.putExtra("deletedItem", currentItemName);
                setResult(RESULT_CANCELED, resultIntent);
                finish();
                return true;
            } else {
                Toast.makeText(this, "Item not found", Toast.LENGTH_SHORT).show();
                return false;
            }
        }

        return super.onOptionsItemSelected(item);
    }
}
