 <?php
/* $user = 'blj';
$password = '123';
$pdo = new PDO('mysql:host=10.20.18.113;dbname=blog', $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
 ]);*/
$user = 'root';
$password = '';
$pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Das Feld wurde mitgesendet, wir können den Wert also übernehmen
    $vor_nachname = $_POST['vor_nachname'] ?? '';
    $time_date = $_POST['time_date'] ?? '';
    $titel_text= $_POST['titel_text'] ?? '';
    $text_text = $_POST['text_text'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO `beitrag` (vor_nachname, titel_text, text_text) VALUES(:by, :on, :text)");
    $stmt->execute([':by' => $vor_nachname, ':on' => $titel_text, ':text' => $text_text]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <title>Blog</title>
</head>
<body>
    <form action="formular.php" method="POST">
        <h1 class = titel >Blog</h1>
        <div class =mitte class = titel>
        <label for="vor_nachname">Name</label>
            <input type="text" id="vor_nachname" name="vor_nachname">
            </div>
            <div class="form-field">
            <label for="titel_text">Titel</label>
            <input type="text" id="titel_text" name="titel_text">
            </div>
            <div class="form-field">
            <label for="text_text">Blog</label>
            <textarea cols="40" rows="4" type="text" id="text_text" name="text_text"></textarea>
            </div>
            <button type="submit" name="action" value="1">senden</button>
        </div> 
      <div>
  
            <?php
             $sql = "SELECT vor_nachname, time_date, title_text, text_text FROM posts";
             foreach ($pdo->query($sql) as $row) {
            echo $row['vor_nachname']."<br />";
            echo $row['time_date']."<br />";
            echo $row['title_text']."<br />";
            echo $row['text_text']."<br />";
            
        }
    ?>


        </div>
</body>
</html>                            