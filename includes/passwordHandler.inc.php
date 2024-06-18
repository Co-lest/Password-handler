<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $deviceName = $_POST["nameDevice"];
        $password = $_POST["pass"];
        $comment = $_POST["comment"];

        try{
            if (empty($deviceName) || empty($password)) {
                throw new Exception("You did not fill out all the expected fields!");
                header("Location: ../manager.html");
            }
        } catch (Exception $t) {
            echo $t->getMessage();
            header("Location: ../manager.html");
            die();
        }

        try {
            require_once "password.inc.php";

            $query = "INSERT INTO USERS (`userName`, `pwd`, `email`) VALUES
            (?, ?, ?);";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$deviceName, $password, $comment]);

            $pdo = null;
            $stmt = null;

            header("Location: ../manager.html");

            die();

        } catch (PDOException $th) {
            die("Query failed: {$th->getMessage()}");
            header("Location ../manager.html");
        }
    } else {
        header("Location: ../manager.html");
    }



/*
CREATE DATABASE IF NOT EXISTS `passWord` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `passWord`;

CREATE TABLE IF NOT EXISTS "sasa"(
	"id" VARCHAR(255) NOT NULL,
    
);
*/
