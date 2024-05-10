<?php


function get_all_author($conn){
    $sql = "SELECT * FROM authors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

   if ($stmt->rowCount() > 0) {
    $authors = $stmt->fetchAll();
   }else {
    $authors = 0;
   }

   return $authors;
}

function get_author($conn, $id){
    $sql = "SELECT * FROM authors WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
    $author = $stmt->fetch();
   }else {
    $author = 0;
   }

   return $author;
} 
?>