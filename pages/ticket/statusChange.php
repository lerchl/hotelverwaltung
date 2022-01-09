<?php
    session_start();

    include "../../guard.php";
    include "../../db/logIntoDB.php";


    guardTechnician();

    if (isset($_GET["id"]) && isset($_GET["status"])) {
        $changeStatusQuery = "UPDATE ticket SET STATUS = ? WHERE ID = ?;";
        $changeStatusStatement = $db->prepare($changeStatusQuery);
        $changeStatusStatement->bind_param("ii", $_GET["status"], $_GET["id"]);
        $changeStatusStatement->execute();
    }
    
    header("Location: /pages/ticket/tickets.php");
?>