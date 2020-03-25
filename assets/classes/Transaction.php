<?php
//namespace Source;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "\..\config");
$dotenv->load();
/** 
 * Class for users interactions 
 */


class Transaction implements Exchanges {
    protected $db;

    public function __construct(Db $db) 
    {
        $this->db = $db;
    }

    public function transferMoneyToRecipient($amount,$userId)
    {   
        
        $account = $this->db->getAUserAccount($userId);
        $newAmount = $account["balance"] + $amount;
        $statement = $this->db->connect()->prepare("UPDATE account SET balance = :amount WHERE user_id =:id");
        $statement->bindParam("id", $userId);
        $statement->bindParam("amount", $newAmount);
        if($statement->execute()) {
            return true;
        }
        
     
    }
    public function transferMoneyFromSender($amount, $userId)
    {   
        $account = $this->db->getAUserAccount($userId);
        $newAmount = $account["balance"] - $amount;
        $statement = $this->db->connect()->prepare("UPDATE account SET balance = :amount WHERE user_id =:id");
        $statement->bindParam("id", $userId);
        $statement->bindParam("amount", $newAmount);
        if($statement->execute()) {
            return true;
        }
     
    } 
    public function trace($fromAcc, $toAcc, $amount) 
    {   
        $date = date('Y-m-d H:i:s', time());
        $statement = $this->db->connect()->prepare(
        "INSERT INTO transactions (from_account, amount, to_account, date) VALUES (:from_account, :amount, :to_account, :date)");
        $statement->bindParam("from_account", $fromAcc);
        $statement->bindParam("to_account", $toAcc);
        $statement->bindParam("amount", $amount);
        $statement->bindParam("date", $date);
        if($statement->execute()) {
            return true;
        }
    }

}