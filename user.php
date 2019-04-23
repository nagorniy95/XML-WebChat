<?php 

class User
{

    public function addUser($name, $password, $db){
        $sql = "INSERT INTO users (name, password)
                VALUES (:name, :password)";
        $pcat = $db->prepare($sql); // prepare
        $pcat->bindParam(':name', $name);
        $pcat->bindParam(':password', $password);
        $result = $pcat->execute(); // execute
        return $result;
    } // end addNewCategory function

    public function getUser($name, $password, $dbcon){
        $sql = "SELECT * FROM users WHERE name='$_POST[uname]' && password='$password' ";
        $pdostm = $dbcon->prepare($sql); // prepare
        $pdostm->execute(); // execute
        // $result = $pdostm->fetchAll(PDO::FETCH_OBJ);
        $count =$pdostm->fetchColumn();
        return $count;
    } // end getAllCategories function

    
    
} // end passwordass
