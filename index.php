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

<body class="h-screen w-screen flex flex-row bg-pink-50">
    <div class="relative border-4 border-gray-600 w-1/4 h-full flex flex-col p-5 space-y-5">
        <p class ="text-2xl font-bold">User</p>
        <?php    

        $sqlRequest = "SELECT * FROM users";
        $selectUser = $mysql->prepare( $sqlRequest );
        $selectUser->execute();
        $users = $selectUser->fetchall();
        ?>
        <div class=" space-y-3">
            <?php
            foreach ( $users as $user ) {
                echo "<p style=\"color:" . $user["color"] . ";\">" . $user["nickname"] . "<p>";
            };

            ?>
        </div>
    </div>
    
    <div class="w-3/4 h-full flex flex-col">
        <div class="relative border-4 border-gray-600 h-full w-full overflow-y-scroll space-y-5 p-5">
        <?php    

        $sqlRequest = "SELECT * FROM messages INNER JOIN users ON messages.user_id = users.id";
        $selectMessages = $mysql->prepare( $sqlRequest );
        $selectMessages->execute();
        $messages = $selectMessages->fetchall();

        foreach ( $messages as $message ) {
            echo "<p>" . $message["publication_date"] . " " . "<span style=\"color:" . $message["color"] . ";\">" . $message["nickname"] . "</span>" . " : " . $message["message_text"] . "<p>";
        };

        ?>
        </div>
        <div class="relative border-4 border-gray-600 h-1/5 w-full space-y-5 p-5">
        <label class="font-bold" for="sendingBox">Sending box</label>
            <form action="request.php" method="post" name="sendingBox">
                <input class=" border border-black rounded-xl px-2" type="text" name="nickname" placeholder="nickname" required value="<?php  if (isset($_COOKIE["nickname"])) {echo $_COOKIE["nickname"];}; ?>">
                <input class=" border border-black rounded-xl px-2" type="text" name="messageText" placeholder="message" required>
                <input type="hidden" name="publicationDate">
                <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
                <button class=" border border-black rounded-xl px-2" type="submit">Send</button>
            </form>
        </div>

</body>
</html>