<?php
function get_todoitems_by_category($category_id)
{
    global $db;
    if ($category_id) {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, C.categoryName From todoitems A
            LEFT JOIN categories C ON A.categoryID = C.categoryID
                WHERE A.categoryID = :categoryID ORDER BY A.ItemNum';
    } else {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, C.categoryName From todoitems A
        LEFT JOIN categories C ON A.categoryID = C.categoryID ORDER BY C.categoryID';
    }
    $statement = $db->prepare($query);
    if ($category_id) {
        $statement->bindValue(':categoryID', $category_id);
    }
    $statement->execute();
    $todoitems = $statement->fetchAll();
    $statement->closeCursor();
    return $todoitems;
}

function delete_item($item_number)
{
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :item_number';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($category_id, $title, $description) {
    global $db;
    
    // First, check if the categoryID exists in the categories table
    $query = 'SELECT COUNT(*) FROM categories WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $exists = $statement->fetchColumn() > 0;
    $statement->closeCursor();

    if (!$exists) {
        throw new Exception("Category ID: $category_id does not exist in categories table.");
    }

    // If categoryID exists, proceed to insert the new item
    $query = 'INSERT INTO todoitems (categoryID, Title, Description) VALUES (:category_id, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function update_item($item_number, $title, $description)
{
    global $db;
    $query = 'UPDATE todoitems SET Title = :title, Description = :description WHERE ItemNum = :item_number';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $statement->closeCursor();
}

function get_item($item_number)
{
    global $db;
    $query = 'SELECT * FROM todoitems WHERE ItemNum = :item_number';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $item = $statement->fetch();
    $statement->closeCursor();
    return $item;
}


?>
