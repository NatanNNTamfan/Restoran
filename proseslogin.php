<?php
if(isset($_POST["username"])){

    //data static
    $data_username = "admin";
    $data_password= "12345";
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username == $data_username && $password == $data_password){
        session_start();
        $_SESSION["username"] = $username;
        header("location:index.php");
        }else{
            echo "login gagal. username atau password salah";
    }
}else{
    echo "form login harus diisi";
}

?>