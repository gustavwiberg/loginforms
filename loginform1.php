<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Formulär php - ingen validering alls</title>
        <meta name="description" content="phpinfo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>   
    <?php
    $pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=webbserver1", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $anv = $_POST['anvandarid'];
    $losen = $_POST['losenord'];

    $sql = 'SELECT * FROM anvandare WHERE Namn="' . $anv . '" AND losenord="' . $losen . '"';                        
    echo '<pre><code>' . print_r($sql,true) . '</code></pre>';
    $query = $pdo->query($sql);
    $resultat = $query->fetchall(PDO::FETCH_ASSOC);

    if (count($resultat)>0) {
        echo 'Ditt inloggningsförsök LYCKADES!';
    }
    else {
        echo 'Ditt inloggningsförsök misslyckades.';
    }    
    ?>
    <form action="loginform1.php" method="POST">
        <strong>Användarid:</strong><br>
        <input type="text" name="anvandarid"><br>
        <strong>Lösenord:</strong><br>
        <input type="password" name="losenord"><br>
        <input type="submit" value="Skicka">
    </form>
  
    </body>
</html>