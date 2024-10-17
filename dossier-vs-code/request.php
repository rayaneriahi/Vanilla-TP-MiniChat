<?php

try {
    $mysql = new PDO("mysql:host=localhost;dbname=minichat","root","");
} catch (PDOException $e) {
    die("erreur");
}

if (!empty($_POST)) {
    echo "ip = " . $_POST["ip"] . "<br>nickname = " . $_POST["nickname"] . "<br>message_text = " . $_POST["messageText"] . "<br>publication_date = " . date("d-m-Y G:i:s") . "<br>";

    $sqlRequest = "SELECT * FROM users WHERE nickname = :nickname";
    $selectUser = $mysql->prepare( $sqlRequest );
    $selectUser->execute([
        "nickname"=> $_POST["nickname"],
    ]);
    $user = $selectUser->fetch();

    if (empty($user)) {
    $sqlRequest = "INSERT INTO users (ip, nickname) VALUES (:ip, :nickname)";
    $createUser = $mysql->prepare( $sqlRequest );
    $createUser->execute([
        "ip"=> $_POST["ip"],
        "nickname"=> $_POST["nickname"],
    ]);
    };

    $sqlRequest = "SELECT * FROM users WHERE nickname = :nickname";
    $selectUser = $mysql->prepare( $sqlRequest );
    $selectUser->execute([
        "nickname"=> $_POST["nickname"],
    ]);
    $user = $selectUser->fetch();

    $sqlRequest = "INSERT INTO messages (message_text, publication_date, user_id) VALUES (:message_text, :publication_date, :user_id)";
    $createMessage = $mysql->prepare( $sqlRequest );
    $createMessage->execute([
        "message_text"=> $_POST["messageText"],
        "publication_date"=> date("Y-m-d\TG:i:s"),
        "user_id"=> $user["id"],
    ]);
};

?>