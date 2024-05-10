<?php

# Get all books function
function get_all_books($conn){
    $sql = "SELECT * FROM books ORDER bY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

   if ($stmt->rowCount() > 0) {
    $books = $stmt->fetchAll();
   }else {
    $books = 0;
   }

   return $books;
}

# Get book by ID function
function get_book($conn, $id){
    $sql = "SELECT * FROM books WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
    $books = $stmt->fetch();
   }else {
    $books = 0;
   }

   return $books;
}



# Search books function
function search_books($conn, $key){
    # creating simple search algorithm
    $key = "%{$key}%";

    $sql = "SELECT * FROM books WHERE title LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key]);

   if ($stmt->rowCount() > 0) {
    $books = $stmt->fetchAll();
   }else {
    $books = 0;
   }

   return $books;
}

# get books by category
function get_books_by_category($conn, $id){
    $sql = "SELECT * FROM books WHERE category_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
    $books = $stmt->fetchAll();
   }else {
    $books = 0;
   }

   return $books;
}

# get books by author
function get_books_by_author($conn, $id){
    $sql = "SELECT * FROM books WHERE author_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
    $books = $stmt->fetchAll();
   }else {
    $books = 0;
   }

   return $books;
}

?>