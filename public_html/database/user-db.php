<?php
// session_start();

class Database
{
    private $con;

    public function connect()
    {
        include_once "constants.php";
        $this->con = new Mysqli(HOST, $_SESSION["db_user_name"], $_SESSION["db_pass"], $_SESSION["db_name"]);
        if ($this->con) {
            return $this->con;
        } else {
            return "DATABASE_CONENCTION_FAILED";
        }
    }
}  



?>