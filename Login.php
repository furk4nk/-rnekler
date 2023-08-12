<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .input{
            padding-left: 20px;
        }
    </style>
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
        <input type="text" name="text">
        <input type="submit" name="replace" value="Kelimelere Ayır">
        </form>
    </div>
</body>
</html>

<?php
        if(isset($_POST["UserName"]) && isset($_POST["Password"]) ){
            if($_POST["UserName"] == "furkan60" && $_POST["Password"] == "123456"){
                echo print("Giriş Başarılı");
                header("refresh:0;url=Anasayfa.php");
            }
            else{
             echo print("Giriş Başarısız");
            }
        }
        if(isset($_POST["replace"]) && !empty($_POST["text"])){
            $gelen_veri = getList($_POST["text"]);
            echo $gelen_veri;
        }
         function getList($string){
            $array = explode(" ",$string);
            $return = '<textarea name="area" cols="10" rows="10" readonly="readonly">';
            foreach($array as $value){
                $return .= $value."\n";
            }
            $return .="</textarea>";
            return $return;
        }
?>