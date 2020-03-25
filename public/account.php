<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

    <?php
        include "../vendor/autoload.php";
        //use Source\Db;
        //use Source\Transaction;
    ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(../assets/pics/Bank.jpg);
            background-size: 80%;
            height: 100vh;
            background-position: center;
        }

    </style>
</head>
<body>
    <?php
        session_start();
        if ( isset($_POST["id"]) ) {
            $_SESSION["id"] = $_POST["id"];        
        }
        
        $obj = new Db();
        $user = $obj ->getAUser($_SESSION["id"]);
        $userList = $obj ->getAllUsers();
        $allUsers = $obj ->getAllUsers();
        $balance = $obj ->getAUserAccount($_SESSION["id"]);
       
    ?>
    <div id="rates">

    </div>

    
    <div class="container">
        
        <div class="overlay">
            <div id="result"></div>
            <div id="user">
                <h2> Welcome
                <?php 
                    echo $user["firstName"] . " " . $user["lastName"]."!";
                ?>
                </h2>
            </div>
            <div id="balance">
                <h4>Your liquidity is: 
                <?php
                    print_r($balance["balance"]);
                ?>
                </h4>
            </div>
            <div id="transaction">
                    <form>
                        <label for="sender">Your account number is: </label>
                        <input type="text" name="sender" id="sender" size="1" maxlength="1" value=<?php echo $user["id"] ?> readonly>
                        <br>
                        <label for="recipient">Choose a recipient: </label>
                        <select name="recipient" id="recipient">
                        <?php
                            foreach ($userList as $row) {
                                if ($row["username"] != $user["username"]) {
                                echo "<option name=recipient id=recipient value= " . $row["id"] . ">" . $row["username"] . "</option>";
                                }
                            }                
                        ?>
                        </select>
                        <label for="amount">Amount to send: </label>   
                        <input name= "amount" id="amount" maxlength="6" type="number" required>
                        <button name="send" id="send">Send some cash</button>
                    </form>
            </div>
            
            <a href="index.php">Logout!</a>
        </div>
    </div>

    <script>
    $(document).on("click", "#send", function (e) {
        e.preventDefault();
        let sender = $("#sender").val();
        let recipient = $("#recipient").val();
        let amount = $("#amount").val();
        $.ajax({
        url: "../assets/controllers/exchange.php",
        method:"POST",
        data:{sender:sender, recipient:recipient, amount:amount},
        success: function (data) {
            $("#result").text(data);
            setTimeout(function(){
            window.location.reload(1);
            }, 5000);
           

        }
    })
    })
        
    </script>
    <script src="../assets/js/main.js"></script>
</body>
</html>




