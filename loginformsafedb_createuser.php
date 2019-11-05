<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Skapa användare INNAN loginformsafedb.php</title>
        <meta name="description" content="phpinfo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>   
    <?php
    $user = 'peter';
    $password = 'pan';
    $hased_password = password_hash($password, PASSWORD_BCRYPT);
    echo $hased_password . ' created for user ' . $user;
    ?>
    </body>
    </html>