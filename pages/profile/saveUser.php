<?php
    session_start();
    require_once "../../db/logIntoDB.php";
    require_once "../../util/validation/validation.php";

    $validator = new Validator(
        new TextValidateable("USERNAME", $_POST, 3, 20),
        new NumberValidateable("HONORIFIC", $_POST, 0, 2),
        new TextValidateable("LAST_NAME", $_POST, 2, 30),
        new TextValidateable("FIRST_NAME", $_POST, 2, 30),
        new EmailValidateable("EMAIL", $_POST, 5, 50)
    );
    $validator->validate();
    if ($validator->hasFailed()) {
        header("Location: registration.php?" . $validator->generateUrlErrorParams());
        exit;
    }

    $userId = isset($_POST["userId"]) ? $_POST["userId"] : $_SESSION["user"]["ID"];
    $query = "UPDATE user SET USERNAME = ?, HONORIFIC = ?, LAST_NAME = ?, FIRST_NAME = ?, EMAIL = ? WHERE id = ?;";
    $statement = $db->prepare($query);
    $statement->bind_param("sssssi", $_POST["USERNAME"], $_POST["HONORIFIC"], $_POST["LAST_NAME"], $_POST["FIRST_NAME"], $_POST["EMAIL"], $userId);
    $statement->execute();

    $userIdParam = isset($_POST["userId"]) ? "userId=" . $userId . "&" : "";
    header("Location: profile.php?" . $userIdParam . "type0=INFO&msg0=SAVED");
?>