<?php
    require "../../db/logintoDB.php";

    if (isset($_POST["id"]) && $_POST['id'] > 0) {
        $sql = "DELETE FROM ticket WHERE ID = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $db->close();

        header("Location: tickets.php");
    }
?>