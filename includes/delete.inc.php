<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deviceName = $_POST["nameDevice"];
    $pass = $_POST["pass"];
    $comment = $_POST["comment"];

    try {
        if (empty($deviceName) || empty($pass)) {
            throw new Exception("You did not fill out all the expected fields!");
        }
    } catch (Exception $t) {
        echo $t->getMessage();
        header("Location: ../manager.html");
        die();
    }

    try {
        require_once "password.inc.php";

        $query = "DELETE FROM `passwords1` WHERE deviceName = :deviceName AND passwords_column = :pass";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":deviceName", $deviceName);
        $stmt->bindParam(":pass", $pass);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../manager.html");
        die();

    } catch (PDOException $th) {
        echo "Please enter a valid password and name!";
        die("Query failed: {$th->getMessage()}");
    }
} else {
    header("Location: ../manager.html");
    die();
}
