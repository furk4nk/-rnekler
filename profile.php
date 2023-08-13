<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examples</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php if (file_exists("control.php"))
        include("control.php");
    if (file_exists("product.php"))
        include("product.php");
    ?>
    <script>
        var satir = -1; // tıklanan bir önceki satır numarasını tutan değişken
        function kayitAl(sat) // tablodaki kayıt satırlarına tıklandığında çalışacak fonksiyon
        {
            if (document.getElementsByName("process")[0].value == "Kayıt Güncelle" ||
                document.getElementsByName("process")[0].value == "Kayıt Sil") {
                n = document.getElementById("h" + sat + "-0").innerHTML; // Tıklanan satırdaki
                ad = document.getElementById("h" + sat + "-1").innerHTML; // hücrelerden değerler
                adr = document.getElementById("h" + sat + "-2").innerHTML; // değişkenlere
                m = document.getElementById("h" + sat + "-3").innerHTML; // alınıyor
                document.getElementsByName("id")[0].value = n; // değişeknlerdeki değerler
                document.getElementsByName("name")[0].value = ad; // metin kutularına aktarılıyor
                document.getElementsByName("adr")[0].value = adr;
                document.getElementsByName("salary")[0].value = m;
                document.getElementsByName("idD")[0].value = n;
                if (satir != -1) // tıklanan bir önceki satırın zemin rengi default renge dönüşüyor
                    document.getElementById("s" + satir).style.backgroundColor = "";
                // tıklanan satırın zemin rengi sarı renge dönüşüyor
                document.getElementById("s" + sat).style.backgroundColor = "yellow";
                satir = sat; // tıklanan satır numarası bir önceki satır numarası değişkenine alınıyor
            }
        }
        function islemSec() // işlem seçeneği değiştirildiğinde çalışacak fonksiyon
        {
            islem = document.getElementsByName("process")[0].value;
            document.getElementsByName("gonder")[0].value = islem;
            document.getElementById("uyariG").innerHTML = "";
            if (islem == "Kayıt Güncelle") {
                document.getElementById("uyariG").innerHTML = "Tablodan güncellemek istediğiniz kayda tıklayınız!";
            }
            if (islem == "Kayıt Sil") {
                document.getElementById("uyariG").innerHTML = "Tablodan silmek istediğiniz kayda tıklayınız!";
                document.getElementById("id").removeAttribute('readonly');
            }
            if (islem == "Kayıt Ekle") {
                document.getElementById('id').value = null;
                document.getElementById('id').setAttribute('readonly', 'readonly');
                document.getElementById("s" + satir).style.backgroundColor = "";
                document.getElementById("id").value = "";
                document.getElementById("name").value = "";
                document.getElementById("salary").value = "";
                document.getElementById("adr").value = "";
            }
        }

        function sifirla() {
            document.getElementById("uyariG").innerHTML = "";
            document.getElementById("s" + satir).style.backgroundColor = "";
        }
    </script>
</head>

<body>

    <div class="rows col-md-12">
        <h4 class="col-form-label-lg">Hoşgeldiniz
            <?php if (isset($_COOKIE["name"]))
                echo $_COOKIE["name"] ?>
            </h4>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <form action="profile.php" method="post">
                            işlem: <select name="process" onchange="islemSec()">
                                <option hidden value="">İşlem Seçiniz</option>
                                <option value="kayıt Listele">Kayıt Listele</option>
                                <option value="Kayıt Ara">Kayıt Ara</option>
                                <option value="Kayıt Ekle">Kayıt Ekle</option>
                                <option value="Kayıt Güncelle">Kayıt Güncelle</option>
                                <option value="Kayıt Sil">Kayıt Sil</option>
                            </select><br />
                            <span id="uyariG"></span> <br />
                            <input type="submit" value="Kayıt Listele" name="gonder" /> <br /><br />
                            Numara: <input type="text" name="id" id="id" class="form-control" /><br />
                            Ad: <input type="text" name="name" id="name" class="form-control" /><br />
                            Adres: <input type="text" name="adr" id="adr" class="form-control" /><br />
                            Maaş: <input type="text" name="salary" id="salary" class="form-control" /><br />
                            <input type="text" name="idD" hidden />
                            <div class="btn-group">
                                <button class="btn btn-primary" type="reset" id="reset" onclick="sifirla()">Sıfırla</button>
                                <a href="login.php" class="btn btn-light">Oturum Açma Sayfasına Dön</a>
                            </div>
                        </form>
                    </td>
                    <td id="sonuc" style="vertical-align: top; padding-left: 30px;">
                        <?php
            $process = "";
            if (isset($_POST["process"]))
                $process = $_POST["process"];
            $id = "0";
            if (!empty($_POST["id"]))
                $id = $_POST["id"];
            $name = "";
            if (!empty($_POST["name"]))
                $name = $_POST["name"];
            $adr = "";
            if (!empty($_POST["adr"]))
                $adr = $_POST["adr"];
            $salary = "0";
            if (!empty($_POST["salary"]))
                $salary = $_POST["salary"];
            $idD = "0";
            if (!empty($_POST["idD"]))
                $idD = $_POST["idD"];
            $aK[0] = $id;
            $aK[1] = $name;
            $aK[2] = $adr;
            $aK[3] = $salary;
            switch ($process) {
                case "Kayıt Ara":
                    if ($name == "")
                        $aK[1] = "%";
                    if ($adr == "")
                        $aK[2] = "%";
                    break;
                case "Kayıt Ekle":
                    ekle($aK);
                    break;
                case "Kayıt Güncelle":
                    guncelle($idD, $aK);
                    break;
                case "Kayıt Sil":
                    sil($idD);
                    break;
            }
            listele($process, $aK);
            ?>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>