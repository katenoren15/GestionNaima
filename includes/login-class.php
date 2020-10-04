<?php
    include "config.php";

    class Utilisateur extends Dbcon {

        public function login($username, $password){
            $user = $this->connect()->real_escape_string($username);
            $pass = $this->connect()->real_escape_string($password);
            $sql2 = "SELECT id FROM utilisateur WHERE username ='$user' and pwd='$pass'";
            $result = mysqli_query($this->connect(), $sql2);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;

            if($count_row == 1){
                $_SESSION["login"] = true;
                $_SESSION["uid"] = $user_data["id"];
                return true;
            }else{
                return false;
            }
        }

        public function get_session() {
            return $_SESSION["login"];
        }

        public function get_fullname($uid) {
            $sql3 = "SELECT fullName FROM utilisateur WHERE id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["fullName"];
        }

        public function get_username($uid) {
            $sql3 = "SELECT username FROM utilisateur WHERE id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["username"];
        }

        public function get_access_level($uid) {
            $sql3 = "SELECT user_level FROM utilisateur WHERE id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            echo $user_data["user_level"];
        }

        public function get_password($uid) {
            $sql3 = "SELECT pwd FROM utilisateur WHERE id = '$uid'";
            $result = mysqli_query($this->connect(), $sql3);
            $user_data = mysqli_fetch_array($result);
            $hidden_password = preg_replace("|.|","**",$user_data["pwd"]);
            echo $hidden_password;
        }

        public function addUser($nom, $username, $password, $access) {
            $sql9 = "SELECT * FROM utilisateur WHERE username = '$username'";
            $result9 = $this->numRows($sql9);
            if ($result9 == 0){
                $sql10 = "INSERT INTO utilisateur(fullName, username, pwd, user_level) VALUES ('$nom', '$username', '$password', '$access')";
    
                $result = mysqli_query($this->connect(), $sql10);
                if($result){
                    $_SESSION["response"]= "Ajout&eacute; avec succ&egrave;s!";
                    $_SESSION["res_type"]="success";
                    header("location:myaccount.php");
                }else{
                    $_SESSION["response"]= "L'ajout a &eacute;chou&eacute;!";
                    $_SESSION["res_type"]="danger";
                    header("location:myaccount.php");
                }
            }else{
                $_SESSION["response"]= "Le nom d'utilisateur est déjà pris.";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }

            
            
            
        }

        public function updateName($name, $uid){
            $sql4 = "UPDATE utilisateur SET fullName= '$name' WHERE id = '$uid'";

            $result = mysqli_query($this->connect(), $sql4);

            if($result){
                $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                $_SESSION["res_type"]="success";
                header("location:myaccount.php");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }
        }

        public function updateUser($user, $uid){
            $sql5 = "UPDATE utilisateur SET username= '$user' WHERE id = '$uid'";

            $result = mysqli_query($this->connect(), $sql5);

            if($result){
                $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                $_SESSION["res_type"]="success";
                header("location:myaccount.php");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }
        }

        public function updatePassword($pass1, $password, $uid){

            if ($pass1 == $password){
                $sql6 = "UPDATE utilisateur SET pwd= '$password' WHERE id = '$uid'";

                $result = mysqli_query($this->connect(), $sql6);

                if($result){
                    $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                    $_SESSION["res_type"]="success";
                    header("location:myaccount.php");
                }else{
                    $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                    $_SESSION["res_type"]="danger";
                    header("location:myaccount.php");
                }
            }else{
                $_SESSION["response"]= "Les mots de passe ne correspondent pas.";
                $_SESSION["res_type"]="danger";
                header("location:myaccount.php");
            }

        }

        public function user_logout() {
            $_SESSION["login"] = false;
            session_destroy();
        }
    }

?>