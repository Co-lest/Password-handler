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

            $query = "INSERT INTO `passwords1` (`deviceName`, `passwords_column`, `comment1`) VALUES
            (?, ?, ?);";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$deviceName, $password, $comment]);

            $pdo = null;
            $stmt = null;

            header("Location: ../manager.html");
            die();

        } catch (PDOException $th) {
            header("Location ../manager.html");
            die("Query failed: {$th->getMessage()}");
        }
    } else {
        header("Location: ../manager.html");
    }
