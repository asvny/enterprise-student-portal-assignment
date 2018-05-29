<?php

include("env.php");

class OracleDB
{
    private $db;
    private static $instance = NULL;

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
        $this->connect();
    }

    public function __destruct(){
        $this->disconnect();
    }

    private function connect() {
        $this->db = oci_connect(DB_USER, DB_PASSWORD, DB_NAME); 

        if (!$this->db)  { 
            echo "[ERROR] An error occurred connecting to the database"; 
            exit; 
        } 
    }

    private function disconnect() {
        oci_close($this->db);
    }

    public function authenticate($username, $password, $captcha) {
         
        if($_SESSION["captchaValue"] != $captcha) {
            die("Invalid Captcha");
        }

        $connection = $this->db;

        $salted = md5($password.APP_SALT);

        $sql = 'SELECT * FROM Login WHERE username = :username AND password = :password';
        $statement = oci_parse($connection, $sql);
        
        oci_bind_by_name($statement, ':username', $username);
        oci_bind_by_name($statement, ':password', $salted);

        oci_execute($statement);

        $row = oci_fetch_array($statement, OCI_ASSOC);

        if( $row ) {
            $_SESSION['isLogged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row["ROLE"];
        }

        oci_free_statement($statement);
    }

    public function logout() {
        unset($_SESSION['isLogged']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);
    }
}

$DB = OracleDB::getInstance();

?>