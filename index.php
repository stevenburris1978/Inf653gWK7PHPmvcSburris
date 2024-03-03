<?php 
require('model/database.php');
require('model/item_db.php');
require('model/category_db.php');

// Filter input to prevent XSS and SQL Injection
$item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_SPECIAL_CHARS);

// Attempt to get $category_id from POST, fallback to GET if not available
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT) ?: filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

// Determine the action to take, defaulting to 'list_todoitems' if none specified
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?: filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?: 'list_todoitems';

switch ($action) {
    case "list_categories":
        $categories = get_categories();
        include('view/category_list.php');
        break;
    case "add_category":
        if (!empty($category_name)) {
            add_category($category_name);
            header("Location: .?action=list_categories");
        } else {
            $error = "Invalid catgeory name. Please check the field and try again.";
            include("view/error.php");
            exit(); 
        }
        break; 
    case "add_item":
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($category_id !== false && !empty($description) && !empty($title)) {
            try {
                add_item($category_id, $title, $description);
                header("Location: .?action=list_todoitems&category_id=" . $category_id);
                exit();
            } catch (Exception $e) {
                $error = "Error adding item: " . $e->getMessage();
                include("view/error.php");
                exit();
            }
        } else {
            $error = "Invalid item data. Check all fields and try again.";
            include("view/error.php");
            exit();
        }
        break; 
    case "delete_category":
        if ($category_id) {
            try {
                delete_category($category_id);
                header("Location: .?action=list_categories");
                exit(); 
            } catch (PDOException $e) {
                $error = "You cannot delete a category if items exist in the category.";
                include('view/error.php');
                exit(); 
            }
        }
        break; 
    case "delete_item":
        if ($item_id) {
            delete_item($item_id);
            header("Location: .?action=list_todoitems&category_id=" . $category_id);
            exit();
        } else {
            $error = "Missing or incorrect item id.";
            include('view/error.php');
            exit(); 
        }
        break;
    case "edit_item_form":
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
        if ($item_id) {
            $item = get_item($item_id);
            include('view/edit_item_form.php');
        } else {
            $error = "Missing or incorrect item id.";
            include('view/error.php');
            exit(); 
        }
        break;
         
    default:
        $categories = get_categories();
        $todoitems = get_todoitems_by_category($category_id);
        include('view/item_list.php');

}