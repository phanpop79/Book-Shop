<?php

session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])){


        include "../db_conn.php";

        include "func-validation.php";

        include "func-file-upload.php";



        if (isset($_POST['book_title']) &&
            isset($_POST['book_description']) &&
            isset($_POST['book_author']) && 
            isset($_POST['book_category']) &&
            isset($_FILES['book_cover']) && 
            isset($_FILES['file'])){

             
            $title = $_POST['book_title'];
            $description = $_POST['book_description'];
            $author = $_POST['book_author'];
            $category = $_POST['book_category'];

            $user_input = 'title=' .$title. '&category=' .$category.
                            '&desc=' .$description. '&author_id=' .$author;


            $text = "Book title";
            $location = "../add-book.php";
            $ms = "error";
            is_empty($title, $text, $location, $ms, $user_input);

            $text = "Book description";
            $location = "../add-book.php";
            $ms = "error";
            is_empty($description, $text, $location, $ms, $user_input);

            $text = "Book author";
            $location = "../add-book.php";
            $ms = "error";
            is_empty($author, $text, $location, $ms, $user_input);

            $text = "Book category";
            $location = "../add-book.php";
            $ms = "error";
            is_empty($category, $text, $location, $ms, $user_input);

             # book cover upload
             $allowed_images_exs = array("jpg", "jpeg", "png", "webp");
             $path = "covers";
             $book_cover = upload_file($_FILES['book_cover'], $allowed_images_exs, $path);

                /**
                 * if error occurred while uploading the book cover
                 */
             if ($book_cover['status'] == "error") {
                 $em = $book_cover['data'];


                 header("Location: ../add-book.php?error=$em&$user_input");
                 exit;
             }else {
                 $allowed_file_exs = array("pdf", "docx", "pptx");
                 $path = "files";
                 $file = upload_file($_FILES['file'], $allowed_file_exs, $path);


                 if ($file['status'] == "error") {
                     $em = $file['data'];
    
    
                     header("Location: ../add-book.php?error=$em&$user_input");
                     exit;
                 }else {


                    /**Getting the  new file name and book cover name */
                    $file_URL = $file['data'];
                    $book_cover_URL = $book_cover['data'];

                    $sql = "INSERT INTO books(title, author_id, description, category_id, cover, file)
                                                VALUES(?, ?, ?, ?, ?, ?)";

                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL]);


                        if ($res){

                            $sm = "The book successfully created!";
                            header("Location: ../add-book.php?success=$sm");
                            exit;
                        }else {
                            $em = "Unknown Error Occurred!";
                            header("Location: ../add-book.php?error=$em");
                            exit;
}
                 }
             }
           

         }else{
             header("Location: ../admin.php");
             exit;
         }

}else{
    header("Location: ../login.php");
    exit;
}