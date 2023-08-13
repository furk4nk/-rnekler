<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-sm-8 rows">
            <form method="Post">
                <label for="name">Kullanıcı Adı</label>
                <input type="text" name="UserName" id="username" class="form-control"> <br />
                <label for="password">Şifreniz</label>
                <input type="password" name="Password" id="password" class="form-control">
                <input type="submit" value="Oturum Aç" name="login" class="btn btn-success">
            </form>
        </div>
        <div class="col-sm-8 rows">
            <form method="post">
                <br />
                <input type="text" name="text" placeholder="İçerik" class="form-control">
                <input type="text" name="karakter" placeholder="Ayraç" class="form-control"> <br />
                <input type="submit" name="replace" value="Kelimelere Ayır" class="btn btn-primary">
            </form>
        </div>
    </div>

</body>

</html>

<?php
if (file_exists("control.php"))
    include "control.php";
if (isset($_POST["login"])) {
    if (isset($_SESSION["oturum"])) {
        if ($_SESSION["oturum"] == "Açık") {
            header("refresh:1;url=profile.php");
        }
    }
    if (isset($_POST["UserName"]) && isset($_POST["Password"])) {
        $ctrl = Login($_POST["UserName"], $_POST["Password"]);
        if ($ctrl) {
            setcookie("name", $_POST["UserName"], time() + 60);
            header("refresh:1;url=profile.php");
        } else
            echo "Kullanıcı Adı Veya Şifre Hatalı";
    }
}
if (isset($_POST["replace"]) && !empty($_POST["text"])) {
    $char = " ";
    if (!empty($_POST["karakter"]))
        $char = $_POST["karakter"];
    $gelen_veri = getList($_POST["text"], $char);
    echo $gelen_veri;
}
function getList($string, $char = " ")
{
    $array = explode($char, $string);
    $return = '<textarea class="form-control" name="area" rows=10 readonly="readonly">';
    foreach ($array as $value) {
        $return .= $value . "\n ";
    }
    $return .= "</textarea>";
    return $return;
}
?>