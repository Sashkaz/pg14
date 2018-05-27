<?php 
class adminLogin{
    public function userLogin(array $input){
        if(empty($input[1])){
            return "Var god och fyll i mejlet."; 
        }
        elseif(!preg_match("/.+@.+\..+/", $input[1])){
            return "Ogiltig mejl."; 
        }else if(empty($input[2])){
            return "Var god och fyll i lösenordet.";
        }else{
            return 1;//if all ok then return 1
        }
    }
    //returns all "converted" input
    public function sanitizeInput(array $input){
        $sanitizedInput = array();
        for($i = 1; $i <= count($input)-1; $i++ ){
            $sanitizedInput[$i] = mysqli_real_escape_string($input[0], $input[$i]);
        }
        return $sanitizedInput;
    }
    public function hash($pwd){
        $salt = md5($pwd);
        $pwd = hash("sha256", $salt.$pwd.$salt);
        return $pwd;
    }
}
?>