<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examples</title>
    <?php if(file_exists("control.php")) include("control.php"); ?>
</head>
<body>
    Hoşgeldiniz <?php if(isset($_COOKIE["name"])) echo $_COOKIE["name"] ?><br/>
    <a href="login.php"><button>Oturum Açma Sayfasına Dön</button></a>
    <?php 
        $table = Get();
        echo $table;
    ?>
</body>
</html>