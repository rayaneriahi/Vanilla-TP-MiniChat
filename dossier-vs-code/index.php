<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <label for="sendingBox">Sending box</label>
    <form action="request.php" method="post" name="sendingBox">
        <input type="text" name="nickname" placeholder="nickname">
        <input type="text" name="messageText" placeholder="message">
        <input type="hidden" name="publicationDate">
        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
        <button type="submit">Send</button>
    </form>

</body>
</html>