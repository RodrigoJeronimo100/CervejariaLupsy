package pt.ipleiria.estg.dei.lupsyapp.utils;

import java.util.ArrayList;


public class ItemManager {

    public static ArrayList<String> items = new ArrayList<>();

    public static void addItem(String itemName) {
        items.add(itemName);
    }

    public static ArrayList<String> getAllItems() {
        return items;
    }

    public static void updateItem(int position, String newItemName) {
        items.set(position, newItemName);
    }

    public static void deleteItem(int position) {
        items.remove(position);
    }
}

