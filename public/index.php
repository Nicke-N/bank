<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php
        include "../vendor/autoload.php";
    ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(../assets/pics/login.jpg);
            background-size: 50%;
            height: 100vh;
            background-position: center;
        }

    </style>
</head>
<body>
    <div class="container">
    
        <div class="overlay">
            <h3>Choose a user</h3>
            <form action="account.php" method="POST">
            <?php
            $object1 = new Db();
            $stmt1 = $object1->getAllUsers();
            foreach ($stmt1 as $row) {
                echo "<div><input type=radio name=id value= " . $row["id"] . " >" . $row["username"] . "</a></div>";
            }
            ?>
            <button type="submit">login</button>
            </form>
        </div>
    </div>

</body>
</html>