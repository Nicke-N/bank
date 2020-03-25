<?php
/**
 * Section for all interfaces
 */


interface Exchanges
{
    public function transferMoneyToRecipient( $amount, $userId);
    public function transferMoneyFromSender($amount,$userId);
    public function trace($fromAcc, $toAcc, $amount);
}
interface DbInteraction
{   
    public function connect();
    public function getAllUsers();
    public function getAllAccounts();
    public function getAUser($id);
    public function getAUserAccount($id);
}