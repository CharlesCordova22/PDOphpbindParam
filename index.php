<?php
    include('localsetting.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP bindparam</title>
</head>
<body>
    <div>
        <h1>PHP PDO Bindparam()</h1>
    </div>
    <?php
        if (isset($_SESSION['message'])) {
            echo "<h4>".$_SESSION['message']."</h4>";
            unset($_SESSION['message']);
        }
    ?>
    <div>
        <form action="code.php" method="POST">
            <div>
                <input type="text" name="fullname" placeholder="FULLNAME">
            </div>
            <div>
                <input type="email" name="email" placeholder="EMAIL">
            </div>
            <div>
                <input type="number" name="phone" placeholder="PHONE NUMBER">
            </div>
            <div>
                <input type="text" name="course" placeholder="COURSE">
            </div>
            <div>
                <button type="submit" name="save">SAVE</button>
            </div>
        </form>
    </div><br>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FULLNAME</th>
                    <th>PHONE</th>
                    <th>COURSE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM sample";
                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $result = $statement->fetchAll(PDO::FETCH_OBJ); //OR FETCH_ASSOC
                    if ($result) {
                        foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?=$row->id?></td> 
                                    <td><?=$row->fullname?></td>
                                    <td><?=$row->email?></td>
                                    <td><?=$row->phone?></td>
                                    <td><?=$row->course?></td>
                                    <td>
                                        <form action="edit.php?id=<?=$row->id?>" method="POST">
                                            <button>EDIT</button>
                                        </form>
                                        <form action="code.php" method="POST">
                                            <button name="delete" value="<?=$row->id?>">DELETE</button>
                                        </form>
                                    </td>

                                </tr>
                            <?php
                        }
                    } else {
                        ?>
                            <tr>
                                <td coolspan="5">NO RECORD FOUND!</td>
                            </tr>
                        <?php
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>