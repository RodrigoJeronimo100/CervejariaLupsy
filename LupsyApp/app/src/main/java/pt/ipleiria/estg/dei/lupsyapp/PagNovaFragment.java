package pt.ipleiria.estg.dei.lupsyapp;

import static pt.ipleiria.estg.dei.lupsyapp.utils.ItemManager.items;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import androidx.fragment.app.Fragment;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

import pt.ipleiria.estg.dei.lupsyapp.Modelos.Item;
import pt.ipleiria.estg.dei.lupsyapp.utils.ItemManager;

public class PagNovaFragment extends Fragment {

    private ListView listView;
    private ArrayAdapter<String> adapter;
    private FloatingActionButton fabAddItem;

    public PagNovaFragment() {
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_pag_nova, container, false);

        // Initialize ListView and List
        listView = view.findViewById(R.id.listViewItems);
        fabAddItem = view.findViewById(R.id.fabAddItem);

        // Initialize the items list in memory
        if (items == null) {
            items = new ArrayList<>();
        }

        // Ensure that the list has some default values
        if (items.isEmpty()) {
            items.add("Item 1");
            items.add("Item 2");
            items.add("Item 3");
        }

        // Set the adapter with the current items in memory
        adapter = new ArrayAdapter<>(getContext(), android.R.layout.simple_list_item_1, items);
        listView.setAdapter(adapter);

        // Set an OnClickListener for the FAB
        fabAddItem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to AddItemActivity to add a new item
                Intent intent = new Intent(getActivity(), AddItemActivity.class);
                startActivityForResult(intent, 1); // Request code 1
            }
        });

        // Set an OnItemClickListener for the ListView to edit an item
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                String selectedItem = items.get(position);

                // Start AddItemActivity to edit the selected item
                Intent intent = new Intent(getActivity(), AddItemActivity.class);
                intent.putExtra("itemName", selectedItem);  // Pass the item name
                intent.putExtra("itemPosition", position);  // Pass the item position
                startActivityForResult(intent, 2); // Request code 2 for editing
            }
        });

        return view;
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (resultCode == getActivity().RESULT_OK) {
            String newItem = data.getStringExtra("itemName");
            int position = data.getIntExtra("itemPosition", -1);

            if (requestCode == 1) {
                // Add new item
                ItemManager.addItem(newItem);
            } else if (requestCode == 2 && position >= 0) {
                // Update existing item
                ItemManager.updateItem(position, newItem);
            }

            adapter.notifyDataSetChanged();
        } else if (resultCode == getActivity().RESULT_CANCELED) {
            // Logic for deleting an item (if needed)
            String deletedItem = data.getStringExtra("deletedItem");
            if (deletedItem != null) {
                // Handle item deletion
                adapter.notifyDataSetChanged();
            }
        }
    }
}
