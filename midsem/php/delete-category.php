<?php

session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])){


        include "../db_conn.php";


        /**
         * check if the category id is set
         */
        if (isset($_GET['id'])) {
            # Get data from GET request and store it in var
             
            $id = $_GET['id'];

            # simple from validation
            if (empty($id)){
                $em = "Error Occurred!";
                header("Location: ../admin.php?error=$em");
                exit;
            }else {
                // # GET book from the Database
                // $sql = "DELETE FROM books WHERE id=:id";
                // $stmt2 = $conn->prepare($sql);
                // $stmt2->bindParam(':id', $id);
                // $stmt2->execute();

                // if ($stmt2->rowCount() > 0){
                    # Delete the category from Database
                    $sql = "DELETE FROM categories WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$id]);
    
                    /**
                     * If there is no error while delete the data
                     */
                    if ($res){
                        // # delete the current book_cover and the file
                        // $cover = $the_book['cover'];
                        // $file = $the_book['file'];
                        // $c_b_c = "../uploads/covers/$cover";
                        // $c_f = "../uploads/files/$file";
                        
                        // unlink($c_b_c);
                        // unlink($c_f);


                        # success message
                        $sm = "Successfully removed!";
                        header("Location: ../admin.php?success=$sm");
                        exit;

                }else {
                    $em = "Error Occurred!";
                    header("Location: ../admin.php?error=$em");
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