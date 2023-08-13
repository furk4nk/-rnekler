<?php
$Host = "localhost";
$Db = "Dbexample";
$ka = "root";
$password = "";
$table = "tbl_product";
$aK = array("0", "%", "%", "0");
function listele($islem, $aK)
{
    try {
        global $Host, $Db, $ka, $password, $table;
        $bag = new PDO("mysql:host=$Host; dbname=$Db; charset=utf8", $ka, $password);
        if ($islem != "Kayıt Ara") {
            $sorgu = $bag->prepare("SELECT * FROM $table ORDER BY ID");
        } else {
            $sql = "SELECT * FROM $table WHERE ";
            if ($aK[0] != "0")
                $sql .= "ID = :id AND ";
            else
                $sql .= "ID > :id AND ";
            $sql .= "Ad LIKE :ad AND ";
            $sql .= "Adres LIKE :adr AND ";
            if ($aK[3] != "0")
                $sql .= "Maas= :maas AND ";
            else
                $sql .= "Maas > :maas AND ";
            $sql = substr($sql, 0, strlen($sql) - 5);
            $sql .= " ORDER BY ID";
            $sorgu = $bag->prepare($sql);
            $sorgu->bindParam(":id", $aK[0]);
            $sorgu->bindParam(":ad", $aK[1]);
            $sorgu->bindParam(":adr", $aK[2]);
            $sorgu->bindParam(":maas", $aK[3]);
        }
        $sorgu->execute();
        $table = '<table class="table table-bordered" name="tablo"><tr><th>ID</th><th>AD</th><th>ADRES</th><th>MAAŞ</th></tr>';
        $i = 0;
        if ($sorgu->rowCount()) {
            while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                $table .= "<tr id='s$i' onClick='kayitAl($i)'><td id='h$i-0'>" . $row["ID"] . "</td>";
                $table .= "<td id='h$i-1'>" . $row["Ad"] . "</td>";
                $table .= "<td id='h$i-2'>" . $row["Adres"] . "</td>";
                $table .= "<td id='h$i-3'>" . $row["Maas"] . "</td></tr>";
                $i++;
            }
        }
        $table .= "</table>";
        echo $table;
    } catch (PDOException $hata) {
        echo "<script>alert('" . $hata->getMessage() . "');</script>";
    }
    $bag = null;
}
function ekle($gK)
{
    try {
        global $Host, $Db, $ka, $password, $table;
        $bag = new PDO("mysql:host=$Host; dbname=$Db; charset=utf8", $ka, $password);
        $komut = "INSERT INTO $table VALUES(:id, :ad, :adr, :maas)";
        $sorgu = $bag->prepare($komut);
        $sorgu->bindParam(":id", $gK[0]);
        $sorgu->bindParam(":ad", $gK[1]);
        $sorgu->bindParam(":adr", $gK[2]);
        $sorgu->bindParam(":maas", $gK[3]);
        $sorgu->execute();
        echo "<script>alert('Kayıt Eklendi!...');</script>";
    } catch (PDOException $hata) {
        echo "<script>alert('" . $hata->getMessage() . "');</script>";
    }
    $bag = null;
}
function guncelle($id, $gK)
{
    try {
        global $Host, $Db, $ka, $password, $table;
        $bag = new PDO("mysql:host=$Host; dbname=$Db; charset=utf8", $ka, $password);
        $komut = "UPDATE $table SET ID=:id, Ad=:ad, Adres=:adr, Maas=:maas 
WHERE ID = :idD";
        $sorgu = $bag->prepare($komut);
        $sorgu->bindParam(":id", $gK[0]);
        $sorgu->bindParam(":ad", $gK[1]);
        $sorgu->bindParam(":adr", $gK[2]);
        $sorgu->bindParam(":maas", $gK[3]);
        $sorgu->bindParam(":idD", $id);
        $sorgu->execute();
        echo "<script>alert('Kayıt Güncellendi!...');</script>";
    } catch (PDOException $hata) {
        echo "<script>alert('" . $hata->getMessage() . "');</script>";
    }
    $bag = null;
}
function sil($id)
{
    try {
        global $Host, $Db, $ka, $password, $table;
        $bag = new PDO("mysql:host=$Host; dbname=$Db; charset=utf8", $ka, $password);
        $komut = "DELETE FROM $table WHERE ID = :id";
        $sorgu = $bag->prepare($komut);
        $sorgu->bindParam(":id", $id);
        $sorgu->execute();
        echo "<script>alert('Kayıt Silindi!...');</script>";
    } catch (PDOException $hata) {
        echo "<script>alert('" . $hata->getMessage() . "');</script>";
    }
    $bag = null;
}
?>