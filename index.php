<?php 
require('model/database.php');
require('model/item_db.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW) ?: 'list_items';

switch ($action) {
    case 'list_items':
        $items = get_items();
        include('view/item_list.php');
        break;

    case 'delete_item':
        $item_number = filter_input(INPUT_POST, 'item_number', FILTER_VALIDATE_INT);
        delete_item($item_number);
        header("Location: .?action=list_items");
        break;

    case 'edit_item_form':
        $item_number = filter_input(INPUT_POST, 'item_number', FILTER_VALIDATE_INT);
        if ($item_number) {
            $item = get_item($item_number);
            include('view/edit_item_form.php');
        } else {
            $error = "Missing or incorrect item number.";
            include('view/error.php');
        }
        break; 

    case 'edit_item':
        $item_number = filter_input(INPUT_POST, 'item_number', FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        update_item($item_number, $title, $description);
        header("Location: .?action=list_items");
        break;

    case 'add_item':
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        add_item($title, $description);
        header("Location: .?action=list_items");
        break;
}
?>

