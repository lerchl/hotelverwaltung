<?php
    session_start();
    require_once "../db/logIntoDB.php";
    $moveToRoot = "../";
    require_once "../uploadPicture.php";

    $addQuery = "INSERT INTO news_post (TITLE, CONTENT, PICTURE, USER_ID) VALUES (?, ?, ?, ?);";
    $addStatement = $db->prepare($addQuery);
    $addStatement->bind_param("sssi", $_POST["title"], $_POST["content"], $fileName, $_SESSION["user"]["ID"]);
    $addStatement->execute();
    header("Location: ../index.php");
?>