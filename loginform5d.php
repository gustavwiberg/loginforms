<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Formulär php - kollar postade värden och om de faktiskt innehåller en begränsad mängd data</title>
        <meta name="description" content="phpinfo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>   
    <?php
    $inmatning = false;
    if (isset($_REQUEST['anvandarid']) && isset($_REQUEST['losenord'])) {  
        if (strlen($_REQUEST['anvandarid'])>0 && strlen($_REQUEST['losenord'])>0) {  
            if (strlen($_REQUEST['anvandarid'])<20 && strlen($_REQUEST['losenord']<30)) {
                $inmatning = true;             
                $pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=webbserver1", 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $anv = $_REQUEST['anvandarid'];
                $losen = $_REQUEST['losenord'];

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
            }
        }
    }

    if ($inmatning === false) {
        echo 'Du måste ange både användarnamn och lösenord.';
    }
    ?>
    <form method="POST">
        <strong>Användarid:</strong><br>
        <input type="text" name="anvandarid"><br>
        <strong>Lösenord:</strong><br>
        <input type="password" name="losenord"><br>
        <input type="submit" value="Skicka">
    </form>
  
    </body>
</html>