<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="padding-left: 10px;">
        <div>
            <form method="Post">
                <label for="name">Kullanıcı Adı</label>
                <input type="text" name="UserName" id="username" class="form-control"> <br/>
                <label for="password">Şifreniz</label>
                <input type="password" name="Password" id="password" class="form-control"><br/>
                <input type="submit" value="Oturum Aç" name="login"> 
                <p id="hata"></p>
            </form>
        </div>  
    </div>
    <div>
        <form method="post">
            <input type="text" name="text" placeholder="İçerik"> <br/>
            <input type="text" name="karakter" placeholder="Ayraç"><br/>
            <input type="submit" name="replace" value="Kelimelere Ayır"> <br/>
        </form>
    </div>
</body>
</html>

<?php
    if (file_exists("control.php")) include "control.php";
    if(isset($_POST["login"])){
        if(isset($_SESSION["oturum"])){
            if($_SESSION["oturum"] == "Açık"){
                header("refresh:1;url=profile.php"); 
            }
        }
        if(isset($_POST["UserName"]) && isset($_POST["Password"]) ){
            $ctrl = Login($_POST["UserName"],$_POST["Password"]);
            if($ctrl)
            {   
                setcookie("name",$_POST["UserName"],time()+60);
                header("refresh:1;url=profile.php");
            }
            else echo "Kullanıcı Adı Veya Şifre Hatalı";
        }
    }
    if(isset($_POST["replace"]) && !empty($_POST["text"])){
        $char =" ";
        if(!empty($_POST["karakter"])) $char = $_POST["karakter"];
        $gelen_veri = getList($_POST["text"],$char);
        echo $gelen_veri;
    }
    function getList($string,$char=" "){
        $array = explode($char,$string);
        $return = '<textarea name="area" cols="10" rows="10" readonly="readonly">';
        foreach($array as $value){
            $return .= $value."\n ";
        }
        $return .="</textarea>";
        return $return;          
    }
?>