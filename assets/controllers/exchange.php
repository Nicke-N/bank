<?php
    /*
        Handles transactions
    */
    
    include "../../vendor/autoload.php";
    $sql = new Db();
    $transaction = new Transaction($sql);
    $balance = $sql -> getAUserAccount($_POST["sender"]);
    
    try {
        if ($_POST["amount"] > $balance["balance"]) {
            throw new Exception("Error! Your balance is lower than the amount you wish to send!");
        } else if ($_POST["amount"] <= 0) {
            throw new Exception("Error! Amount is too low to send!");
            
        } else {  
            $transaction->transferMoneyFromSender($_POST["amount"], $_POST["sender"]);
            $transaction->transferMoneyToRecipient($_POST["amount"], $_POST["recipient"]);
            $transaction->trace($_POST["sender"], $_POST["recipient"], $_POST["amount"]);
            $newBalance = intval($balance) - intval($_POST["amount"]);
            
            echo "Your money has been sent!";
        }
    }  catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        echo " Website will reload in 5 seconds.";
    }

        



