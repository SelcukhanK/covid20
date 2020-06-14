<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUsers() {
    $connection = dbConnect();
    $sql        = "SELECT * FROM 'c5522covid19' ";
    $statement = $connection->query( $sql );

    return $statement->fetchAll();
}

function getUserByEmail($email){

    $connection = dbConnect();
    $sql        = "SELECT * FROM `gebruikers` WHERE email = :email";
    $statement  = $connection->prepare( $sql );
    $statement->execute( [ 'email' => $email ] );

    if ( $statement->rowCount() === 1 ) {
        return $statement->fetch();
    }

    return false;

}

function getProductById($id) {
    $connection = dbConnect();
    $sql        = "SELECT * FROM `products` WHERE id='$id' ";
    $statement = $connection->query( $sql );

    return $statement->fetchAll();
}
function getProductsByName($productname) {
    $connection = dbConnect();
    $sql        = "SELECT * FROM `products` WHERE `name` LIKE '%$productname%' ";
    $statement = $connection->query( $sql );

    return $statement->fetchAll();
}
function getProducts($id = null) {
    $connection = dbConnect();
    if($id !== null){
        $sql = "SELECT * FROM `products` WHERE category_id='$id'";
    }else{
        $sql = "SELECT * FROM `products`";
    }
    $statement = $connection->query( $sql );

    return $statement->fetchAll();
}

function getCategories() {
    $connection = dbConnect();
    $sql        = "SELECT id, img, name, (SELECT COUNT(id) FROM `products` WHERE category_id=c.id) as amount FROM `categories` c";
    $statement = $connection->query( $sql );

    return $statement->fetchAll();
}