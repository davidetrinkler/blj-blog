<?php
$user = 'root';
$password = '';
$pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

]);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Das Feld wurde mitgesendet, wir können den Wert also übernehmen
    $vor_nachname = htmlentities($_POST['vor_nachname'] ?? '');
    $time_date = htmlentities($_POST['time_date'] ?? '');
    $titel_text= htmlentities($_POST['titel_text'] ?? '');
    $text_text = htmlentities($_POST['text_text'] ?? '');

    $stmt = $pdo->prepare("INSERT INTO `beitrag` (vor_nachname, titel_text, text_text) VALUES(:by, :on, :text)");
    $stmt->execute([':by' => $vor_nachname, ':on' => $titel_text, ':text' => $text_text]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>
<div class="grids">
<header class="header">
<h1 class =mitte >Blog</h1>
</header>
    <aside class="aside">
        <?php
            $user = 'blj';
            $password = '123';
            $pdo1 = new PDO('mysql:host=10.20.18.111;dbname=ipadressen', $user, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ]); 
            $sql1 = "SELECT vorname, ip FROM ipadressen";
             foreach ($pdo1->query($sql1) as $row1) {
                
                echo " <a href=[vorname]></a>";
                echo " <a href=[ip]></a>";
            ?>
            
        }       
    </aside>
    <main class="main">
        <form action="index.php" method="POST">
            <div class =kasten  >
                <div>
                <label for="vor_nachname">Name</label>
                <input class=name type="text" id="vor_nachname" name="vor_nachname" required>
                </div>
                <div class="form-field">
                <label for="titel_text">Titel</label>
                <input classe=titel type="text" id="titel_text" name="titel_text" required>
                </div>
                <div class="form-field">
                <label for="text_text">Blog</label>
                <textarea href="" cols="40" rows="4" type="text" id="text_text" name="text_text" required></textarea>
                </div>
                <div>
                <button type="submit" name="action" value="1">senden</button><br>
                </div>
            </div>
        <?php
            $sql = "SELECT vor_nachname, time_date, titel_text, text_text FROM beitrag";
            $sql = "SELECT * FROM beitrag order by time_date desc";
            foreach ($pdo->query($sql) as $row) { ?>
            <div class="ausgabe"> <?php
                echo $row['vor_nachname']."<br />";
                echo $row['time_date']."<br />";
                echo $row['titel_text']."<br />";
                echo $row['text_text']."<br /> <br />"; ?>
            </div>
        <?php          
            }
        ?>
    </main>
    </div>
</body>
</html>