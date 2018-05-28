<?php
    class Database{
        function __construct($host, $user, $pwd, $db){
            $this->db = mysqli_connect($host, $user, $pwd, $db);
            if ($this->db->connect_error) {
                $code  = $mysqli->connect_errno;
                die("Error: ($code)".$this->db->connect_error);
            }
        }
        public function q($sql){
            return $this->db->query($sql);
        }
        public function lastError(){
            return $this->db->error;
        }
    }
?>