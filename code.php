<?php
    include('localsetting.php');
    session_start();

    //Add Function
    if (isset($_POST['save'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];
        try {
            $query = "INSERT INTO sample(fullname, email, phone, course) VALUES(?, ?, ?, ?)";
            $statement = $conn->prepare($query);
            $statement->bindparam(1, $fullname);
            $statement->bindparam(2, $email);
            $statement->bindparam(3, $phone);
            $statement->bindparam(4, $course);
            $query_execute = $statement->execute();
            if ($query_execute) {
                $_SESSION['message'] = "Added Student!";
                header('Location:index.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Not Added Student!";
                header('Location:index.php');
                exit(0);
            }
            
        } catch (PDOException $e) {
            echo "Error Add Function!". $e->getMessage();
        }
    }

    // Edit Function
    if (isset($_POST['update'])) {
        
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];

        try {
            $query = "UPDATE sample SET fullname = :fullname, email = :email, phone = :phone, course = :course WHERE id = :id LIMIT 1";
            $statement = $conn->prepare($query);
            $statement->bindParam(':fullname', $fullname);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':course', $course);
            $statement->bindParam(':id', $id);
            $query_execute = $statement->execute();

            if ($query_execute) {
                $_SESSION['message'] = "Updated Student!";
                header('Location:index.php');
                echo "sample";
                exit(0);
            } else {
                $_SESSION['message'] = "Not Updated Student!";
                header('Location:index.php');
                exit(0);
            }

        } catch (PDOException $e) {
            echo "Error Edit Function". $e->getMessage();
        }
    }

    //Delete Function
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        try {
            $query = "DELETE FROM sample WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->bindParam(':id', $id);

            $query_execute = $statement->execute();

            if ($query_execute) {
                $_SESSION['message'] = "Delete Student!";
                header('Location:index.php');
                echo "sample";
                exit(0);
            } else {
                $_SESSION['message'] = "Not Deleted Student!";
                header('Location:index.php');
                exit(0);
            }
            

        } catch (PDOException $e) {
            echo "Error Delete Function". $e->getMessage();
        }
    }
?>