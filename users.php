<?php 
    include "headers.php";

    class User{
        function signUp($json){
            include "connection.php";
           // {"username":"kobi", "password":"kobi123","fullName":"Kobi Macario", "email":"kobi@gmail.com"}
            $json = json_decode($json, true);

            $username = $json["username"];
            $password = $json["password"];
            $fullName = $json["fullName"];
            $email = $json["email"];

            $sql = "INSERT INTO tblusers(user_username, user_password, user_fullName, user_email) ";
            $sql .= "VALUES(:username, :password, :fullName, :email)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":fullName", $fullName);
            $stmt->bindParam(":email", $email);
            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $returnValue = 1;
                }
            }

            return $returnValue;
        }

        function login($json){
            include "connection.php";
            
            //{"username":"kobi", "password":"kobi123"}

            $json = json_decode($json, true);
            $username = $json["username"];
            $password = $json["password"];

            $sql = "SELECT * FROM tblusers WHERE user_username = :username AND user_password = :password";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
                    $returnValue = json_encode($rs);
                }
            }

            return $returnValue;
        }


        //add 
        function addContact($json){
            include "connection.php";
           // {"fullName":"qweqweqw", "mobileNumber":"23123123123", "officeNumber":"123123421", "address":"asdaswe", "email":"@gmaqweqweil", "groupId":"1", "userId":"1", "mobileNumber2":"123123213123123"}
            $json = json_decode($json, true);

            $fullName = $json["fullName"];
            $mobileNumber = $json["mobileNumber"];
            $officeNumber = $json["officeNumber"];
            $address = $json["address"];
            $email = $json["email"];
            $groupId = $json["groupId"];
            $userId = $json["userId"];
            $mobileNumber2 = $json["mobileNumber2"];


            $sql = "INSERT INTO tblcontact(con_fullName, con_mobileNumber, con_officeNumber, con_address, con_email, con_groupId, con_userId, con_mobileNumber2) ";
            $sql .= "VALUES(:fullName, :mobileNumber, :officeNumber, :address, :email, :groupId, :userId, :mobileNumber2)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":fullName", $fullName);
            $stmt->bindParam(":mobileNumber", $mobileNumber);
            $stmt->bindParam(":officeNumber", $officeNumber);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":groupId", $groupId);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":mobileNumber2", $mobileNumber2);

            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $returnValue = 1;
                }
            }

            return $returnValue;
        }

        function addGroup($json){
            include "connection.php";
            // {"name":"Mga gago", "userId":"1"}
             $json = json_decode($json, true);
 
             $name = $json["name"];
             $userId = $json["userId"];

             $sql = "INSERT INTO tblgroup(grp_name, grp_userId) ";
             $sql .= "VALUES(:name, :userId)";
 
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(":name", $name);
             $stmt->bindParam(":userId", $userId);
 
             $returnValue = 0;
 
             if($stmt->execute()){
                 if($stmt->rowCount() > 0){
                     $returnValue = 1;
                 }
             }
 
             return $returnValue; 
        }
        
        //get
        function getUsername(){
            include "connection.php";

            $sql = "SELECT user_username, user_email FROM tblusers";

            $stmt = $conn->prepare($sql);
            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount()){
                    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $returnValue = json_encode($rs);
                }
            }

            return $returnValue;
        }

        function getContact($json){
            include "connection.php";

            // {"userId":"1"}

            $json = json_decode($json, true);

            $userId = $json["userId"];

            $sql = "SELECT * FROM tblcontact WHERE con_userId=:userId";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":userId", $userId);

            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $returnValue = json_encode($rs);
                }
            }

            return $returnValue;
        }

        function getGroup($json){
            include "connection.php";

            // {"userId":"1"}

            $json = json_decode($json, true);

            $userId = $json["userId"];

            $sql = "SELECT * FROM tblgroup WHERE grp_userId=:userId";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":userId", $userId);

            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $returnValue = json_encode($rs);
                }
            }

            return $returnValue;
        }

        function deleteContact($json){
            include "connection.php";

            $json = json_decode($json, true);

            $conId = $json["conId"];

            $sql = "DELETE FROM tblcontact WHERE con_id = :conId";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":conId", $conId);
            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $returnValue = 1;
                }
            }

            return $returnValue;
        }
        
        function selectContact($json){
            include "connection.php";

            $json = json_decode($json, true);

            $contactId = $json["contactId"];

            $sql = "SELECT * FROM tblcontact WHERE con_id=:contactId";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":contactId", $contactId);

            $returnValue = 0;

            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
                    $returnValue = json_encode($rs);
                }
            }

            return $returnValue;
            
        }

        function updateContact($json){
            
        }
    }

    $json = isset($_POST["json"]) ? $_POST["json"] : "0";
    $operation = isset($_POST["operation"]) ? $_POST["operation"] : "0";

    $user = new User();

    switch($operation){
        case "signup":
            echo $user->signup($json);
            break;
        case "getUsername":
            echo $user->getUsername();
            break;
        case "login":
            echo $user->login($json);
            break;
        case "getContact":
            echo $user->getContact($json);
            break;
        case "addContact":
            echo $user->addContact($json);
            break;
        case "addGroup":
            echo $user->addGroup($json);
            break;
        case "getGroup":
            echo $user->getGroup($json);
            break;
        case "deleteContact":
            echo $user->deleteContact($json);
            break;
        case "selectContact":
            echo $user->selectContact($json);
            break;
    }
?>