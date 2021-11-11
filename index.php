<?php
$servername = "127.0.0.1";
$username = "root";
$password = "12345";
$dbname = "badwords";
$connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
if(isset($_POST['submit'])){
    
    
    
    
$text = $_POST['text'];  
    
$countingbadwords = 0;
$query = "
SELECT * FROM badwords
";

$statement = $connect->prepare($query);

if($statement->execute())
{
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
     
    if(strpos(preg_replace("/[^A-Za-z0-9]/", '', $text), $row['word']) !== false){
        $countingbadwords = ++$countingbadwords;
        $wordthing[$countingbadwords] = $row['word'];
    }
 }
}
    if($countingbadwords > 0){
        echo'Bad word found - '.$wordthing[$countingbadwords].''; 
    }
    
    

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="">
    <input type="text" name="text" />
    <input type="submit" name="submit" />
</form>
</body>
</html>