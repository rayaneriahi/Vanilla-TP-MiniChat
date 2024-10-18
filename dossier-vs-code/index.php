<?php

try {
    $mysql = new PDO("mysql:host=localhost;dbname=minichat","root","");
} catch (PDOException $e) {
    die("erreur");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-screen h-screen flex flex-row">

    <div class=" border border-black h-full w-1/4 p-5">
        <h1>Users</h1>
        <?php    

        $sqlRequest = "SELECT * FROM users";
        $selectUser = $mysql->prepare( $sqlRequest );
        $selectUser->execute();
        $users = $selectUser->fetchall();

        foreach ( $users as $user ) {
            echo "<p>" . $user["nickname"] . "<p>";
        };

        ?>
    </div>
    <div class=" border border-black h-full w-3/4 flex flex-col">
        <div class=" border border-black w-full h-4/5 flex flex-col-reverse p-5">
            <div>
                <?php    

                $sqlRequest = "SELECT * FROM messages INNER JOIN users ON messages.user_id = users.id";
                $selectMessages = $mysql->prepare( $sqlRequest );
                $selectMessages->execute();
                $messages = $selectMessages->fetchall();

                foreach ( $messages as $message ) {
                    echo "<p>" . $message["publication_date"] . " " . $message["nickname"] . " : " . $message["message_text"] . "<p>";
                };

                ?>
            </div>
        </div>
        <div class=" border border-black w-full h-1/5 p-5">
            <label for="sendingBox">Sending box</label>
            <form action="request.php" method="post" name="sendingBox">
                <input class=" border border-black rounded-xl px-2" type="text" name="nickname" placeholder="nickname" required>
                <input class=" border border-black rounded-xl px-2" type="text" name="messageText" placeholder="message" required>
                <input type="hidden" name="publicationDate">
                <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
                <button class=" border border-black rounded-xl px-2" type="submit">Send</button>
            </form>
        </div>
    </div>

</body>
</html>