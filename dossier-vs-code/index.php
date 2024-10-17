<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen flex flex-row bg-pink-50">
    <div class="relative border-4 border-gray-600 w-1/4 h-full flex flex-col py-10 px-10">
        <p class ="text-2xl font-bold absolute top-0 left-0">User</p>
        <li class="text-blue-600">Nicolas</li>        
        <li class="text-blue-600">Rayane</li>
        <li class="text-blue-600">Quentin</li>
    </div>
    
    <div class="w-3/4 h-full flex flex-col">
        <div class="relative border-4 border-gray-600 h-4/5 w-full">
            <p class="text-blue-600 absolute bottom-0 right-0 mr-14 mb-14">17.10.2024 10:50 Quentin : My name is Quentin</p>
        </div>
        <div class="relative border-4 border-gray-600 h-1/5 w-full">
            <p class="text-2xl font-bold absolute bottom-0 left-0 ml-14 mb-14">Sending box / nickname</p>
            <p class="text-blue-600 absolute bottom-0 right-0 mr-14 mb-14">Je suis en train d'écrire...</p>
    </div>
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