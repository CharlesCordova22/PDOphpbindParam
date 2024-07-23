<?php
    include('localsetting.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE bindparam</title>
</head>
<body>
    <div>
        <h1>PHP PDO UPDATE Bindparam()</h1>
    </div>
    <?php
        if (isset($_SESSION['message'])) {
            echo "<h4>".$_SESSION['message']."</h4>";
            unset($_SESSION['message']);
        }
    ?>
    <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "SELECT * FROM sample WHERE id = ? LIMIT 1";
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_OBJ); //FETCH_ASSOC
    ?>
    <div>
        <form action="code.php" method="POST">
            <input type="hidden" name="id" value="<?=$result->id?>">
            <div>
                <input type="text" name="fullname" value="<?=$result->fullname?>" placeholder="FULLNAME">
            </div>
            <div>
                <input type="email" name="email" value="<?=$result->email?>" placeholder="EMAIL">
            </div>
            <div>
                <input type="number" name="phone" value="<?=$result->phone?>" placeholder="PHONE NUMBER">
            </div>
            <div>
                <input type="text" name="course" value="<?=$result->course?>" placeholder="COURSE">
            </div><br>
            <div>
                <button type="submit" name="update" >UPDATE</button>
            </div>
        </form>
    </div>
    <?php 
        }else {
            echo "<h5> NO ID FOUND</h5>";
        }
    ?>
</body>
</html>