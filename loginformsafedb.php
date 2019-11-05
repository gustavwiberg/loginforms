<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Formulär php</title>
        <meta name="description" content="phpinfo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>   
    <?php
    $inmatning = false;
    if (isset($_POST['anvandarid']) && isset($_POST['losenord'])) {  
        //Kolla antal poster i array $_POST
        if (count($_POST) != 2) {
            echo 'Inkorrekt information är skickad';
            exit;
        }

        if (strlen($_POST['anvandarid'])>0 && strlen($_POST['losenord'])>0) {   
            if (strlen($_POST['anvandarid'])<20 && strlen($_POST['losenord']<30)) {              
                $inmatning = true;             
                $pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=webbserver1", 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $anv = $_POST['anvandarid'];
                $losen = $_POST['losenord'];
                $hashed_losen = password_hash($losen, PASSWORD_BCRYPT);
                
                $sql = "SELECT * FROM anvandare2 WHERE Namn=:anvandarid";
                echo '<pre><code>' . print_r($sql,true) . '</code></pre>';

                $query = $pdo->prepare($sql);
                $query->execute(array(
                                ':anvandarid' => $anv
                            ));
                $resultat = $query->fetchall(PDO::FETCH_ASSOC);
                $query = null;
                

                if (isset($resultat[0]['losenord']) && password_verify($losen, $resultat[0]['losenord'])) {
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