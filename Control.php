<?php

$host = "localhost";
$db = "Dbexample";
$ka = "root";
$charset = "utf8";
$hostPass = "";

function Get($username = "")
{
    global $host, $db, $ka, $charset, $hostPass;
    try {
        $bag = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $ka, $hostPass);
        if (!empty($username))
            $query = $bag->prepare("select * from tbl_users where UserName = :username");
        else {
            $query = $bag->prepare("select * from tbl_users");
        }
        if (!empty($username))
            $query->bindParam(":username", $username);
        $query->execute();
        $table = '<table class="table table-hover table-bordered"><tr><th>Adı</th><th>Soyadı</th></tr>';
        if ($query->rowCount()) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $table .= "<tr><td>" . $row["Name"] . "</td><td>" . $row["UserName"] . "</td></tr>";
            }
            $table .= "</table>";
        } else {
            return null;
        }
        $bag = null;
        return $table;
    } catch (PDOException $ssl) {
        die("Hata!!" . $ssl->getMessage());
    }
}


/**
 * Kullanıcı Giriş İşlemi
 * @return bool
 */
function Login($username, $password)
{
    if (empty($username)) {
        echo "Kullanıcı ismi Giriniz";
    } else {
        $result = Get($username);
        if (!empty($result)) {
            return true;
        }
    }
    return false;
}
function LogOut(): bool
{
    if (isset($_SESSION["oturum"]) && !empty($_SESSION["oturum"]) == "Açık") {
        session_destroy();
        return true;
    }
    return false;
}
?>