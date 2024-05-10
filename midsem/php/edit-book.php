<?php

session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])){


        include "../db_conn.php";

        include "func-validation.php";

        include "func-file-upload.php";

        /**
         * if all input field are filled
         * */
        if (isset($_POST['book_id']) && 
            isset($_POST['book_title']) &&
            isset($_POST['book_description']) &&
            isset($_POST['book_author']) && 
            isset($_POST['book_category']) &&
            isset($_FILES['book_cover']) && 
            isset($_FILES['file']) &&
            isset($_POST['current_cover']) &&
            isset($_POST['current_file'])) {

             /**
              * Get current cover & current file from POST request and store them in var
              */
            $current_cover = $_POST['current_cover'];
            $current_file = $_POST['current_file'];

            #simple from validation

            $text = "Book title";
            $location = "../edit-book.php";
            $ms = "id=$id&error";
            is_empty($title, $text, $location, $ms, "");

            $text = "Book description";
            $location = "../edit-book.php";
            $ms = "id=$id&error";
            is_empty($description, $text, $location, $ms, "");

            $text = "Book author";
            $location = "../edit-book.php";
            $ms = "id=$id&error";
            is_empty($author, $text, $location, $ms, "");

            $text = "Book category";
            $location = "../edit-book.php";
            $ms = "id=$id&error";
            is_empty($category, $text, $location, $ms, "");

            /**
             * if the admin try to update the book
             */

             if (!empty($_FILES['book_cover']['name'])) {
                /**
             * if the admin try to update both
             */
                if (!empty($_FILES['book_cover']['name'])) {
                    # update both here

                    # book cover uploading
                    $allowed_images_exs = array("jpg", "jpeg", "png", "webp");
                    $path = "covers";
                    $book_cover = upload_file($_FILES['book_cover'], $allowed_images_exs, $path);

                    # file uploading
                    $allowed_file_exs = array("pdf", "docx", "pptx");
                    $path = "files";
                    $files = upload_file($_FILES['file'], $allowed_file_exs, $path);


                    /**
                    * if error occurred while uploading the book cover
                    */
             if ($book_cover['status'] == "error" || $files['status'] == "error") {
                $em = $book_cover['data'];

                /**
                 * Redirect to '../edit-book.php' and passing error message & the id
                 */
                header("Location: ../edit-book.php?error=$em&id=$id");
                exit;
            }else {
                # current book cover path
                $c_p_book_cover = "../uploads/covers/$current_cover";

                #current file path
                $c_p_file = "../uploads/files/$current_file";

                    #Delete from the server
                    unlink($c_p_book_cover);
                    unlink($c_p_file);

                    /**
                     * Getting the new file name and the new book cover name
                     */
                    $file_URL = $file['data'];
                    $book_cover_URL = $book_cover['data'];

                    #update just the date
                    $sql = "UPDATE books SET title=?, author_id=?, description=?, category_id=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $id]);

                    /**
                    * if there is no error while updating the  date
                    */
                    if ($res){
                        # success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                        exit;
                    }else {
                        # Error message
                        $em = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$em&id=$id");
                        exit;
                    }
                }
                }else {
                    #update just the book cover

                    # book cover uploading
                    $allowed_images_exs = array("jpg", "jpeg", "png", "webp");
                    $path = "covers";
                    $book_cover = upload_file($_FILES['book_cover'], $allowed_images_exs, $path);

                    
                    /**
                    * if error occurred while uploading
                    */
             if ($book_cover['status'] == "error") {
                $em = $book_cover['data'];

                /**
                 * Redirect to '../edit-book.php' and passing error message & the id
                 */
                header("Location: ../edit-book.php?error=$em&id=$id");
                exit;
            }else {
                # current book cover path
                $c_p_book_cover = "../uploads/covers/$current_cover";

                
                    #Delete from the server
                    unlink($c_p_book_cover);

                    /**
                     * Getting the new file name and the new book cover name
                     */
                    $book_cover_URL = $book_cover['data'];

                    #update just the date
                    $sql = "UPDATE books SET title=?, author_id=?, description=?, category_id=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $id]);

                    /**
                    * if there is no error while updating the  date
                    */
                    if ($res){
                        # success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                        exit;
                    }else {
                        # Error message
                        $em = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$em&id=$id");
                        exit;
                    }
                }
             }
             }
             /**
             * if the admin try to update just the file
             */
            else if (!empty($_FILES['file']['name'])){
                #update just the file

                    # book cover uploading
                    $allowed_file_exs = array("pdf", "docx", "pptx");
                    $path = "files";
                    $files = upload_file($_FILES['file'], $allowed_file_exs, $path);

                    
                    /**
                    * if error occurred while uploading
                    */
            if ($files['status'] == "error") {
                $em = $files['data'];

                /**
                 * Redirect to '../edit-book.php' and passing error message & the id
                 */
                header("Location: ../edit-book.php?error=$em&id=$id");
                exit;
            }else {
                # current book cover path
                $c_p_file = "../uploads/files/$current_file";

                
                    #Delete from the server
                    unlink($c_p_file);

                    /**
                     * Getting the new file name and the new book cover name
                     */
                    $file_URL = $file['data'];

                    #update just the date
                    $sql = "UPDATE books SET title=?, author_id=?, description=?, category_id=?, cover=?, WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $file_URL, $id]);

                    /**
                    * if there is no error while updating the  date
                    */
                    if ($res){
                        # success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                        exit;
                    }else {
                        # Error message
                        $em = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$em&id=$id");
                        exit;
                    }
                }
                
            }else {
                #update just the date
                $sql = "UPDATE books SET title=?, author_id=?, description=?, category_id=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$title, $author, $description, $id]);

                /**
                 * if there is no error while updating the  date
                 */
                if ($res){
                    # success message
                    $sm = "Successfully updated!";
                    header("Location: ../edit-book.php?success=$sm&id=$id");
                    exit;
                }else {
                    # Error message
                    $em = "Unknown Error Occurred!";
                    header("Location: ../edit-book.php?error=$em&id=$id");
                    exit;
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