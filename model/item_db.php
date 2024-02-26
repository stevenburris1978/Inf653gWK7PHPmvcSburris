<?php
function get_items()
{
    global $db;
    $query = 'SELECT * FROM todoitems ORDER BY ItemNum';
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
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

function add_item($title, $description)
{
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description) VALUES (:title, :description)';
    $statement = $db->prepare($query);
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
