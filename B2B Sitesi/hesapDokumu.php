<!DOCTYPE html>
<html lang="tr">

<head>
    <?php require_once 'baglan.php'; ?>
    <title>HESAP DÖKÜMÜ</title>
    <link rel="icon" href="img/cevizsoft.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/hesapDokumu.css">
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="img/cevizsoft.png" alt="" style="max-height: 25px;" class="mr-1">
            <a class="navbar-brand" href="magaza.php">
                <?php
                $site_ayarlari = $db->prepare("SELECT * from site_ayarlari");
                $site_ayarlari->execute();
                $site_ayarlari_cek = $site_ayarlari->fetch(PDO::FETCH_ASSOC);
                echo $site_ayarlari_cek['site_ismi'];
                ?>
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-1" id="collapse_target">

                <form class="form-inline md-auto">
                    <input class="form-control" type="search" placeholder="Ara" aria-label="Search" id="searchBar">
                    <button class="btn btn-light my-sm-0" type="submit"><img src="img/search.png" alt="" height="25px"></button>
                </form>
                <ul class="navbar-nav ml-auto">

                    <?php
                    $db = new PDO("mysql:host=localhost;dbname=$dbName;charset=utf8", $phpMA_Ad, $phpMA_Sifre);
                    $cookieId = $_COOKIE['id'];
                    $kullaniciSor = $db->prepare("SELECT * from kullanicilar where id=$cookieId");
                    $kullaniciSor->execute();
                    $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                    $kullaniciTuru = $kullaniciCek['kullanici_turu'];
                    switch ($kullaniciTuru) {
                        case "normal":
                        break;
                        case "admin":
                        break;
                        case "super_admin":
                        ?>
                        <li class="nav-item">
                            <button class="nav-link btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="İşlemler">
                                İşlemler
                            </button>
                        </li>
                        <?php
                        break;
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link kalanBakiye" href="hesapDokumu.php">
                            Kalan Bakiye :
                            <span id="kalanBakiye">
                                <?php $cookieId = $_COOKIE['id'];
                                $kullaniciSor = $db->prepare("SELECT * from kullanicilar where id=$cookieId");
                                $kullaniciSor->execute();
                                $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                                echo $kullaniciCek["kalan_bakiye"];
                                ?>
                            </span> ₺
                        </a>
                    </li>
                    <!-- Sepet ile resmi birleştir -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="img/sepet.png" alt="" height="25px">
                            <span id="sepettekiUrunSayisi">
                                <?php $cookieId = $_COOKIE['id'];
                                $kullaniciSor = $db->prepare("SELECT * from kullanicilar where id=$cookieId");
                                $kullaniciSor->execute();
                                $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                                echo $kullaniciCek["sepetteki_urun_sayisi"];
                                ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="img/message.png" alt="" height="25px">
                            <span id="mesajSayisi">
                                <?php $cookieId = $_COOKIE['id'];
                                $kullaniciSor = $db->prepare("SELECT * from kullanicilar where id=$cookieId");
                                $kullaniciSor->execute();
                                $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                                echo $kullaniciCek["mesaj_sayisi"];
                                ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <?php
            require_once "db.php";
            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {

                    $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
                    $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
                    $fiyat = $_POST["yeniUrunFiyat"];

                    $sql = "INSERT INTO urunler(fiyat, imageType ,imageData)
                    VALUES('{$fiyat}', '{$imageProperties['mime']}', '{$imgData}')";
                    $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
                    if (isset($current_id)) {
                        header("Location: magaza.php");
                    }
                }
            }
            if (isset($_POST["siteIsmiDegistir"])) {
                echo $_POST["yeniSiteIsmi"];
                $siteIsmi = $_POST["yeniSiteIsmi"];
                $kullaniciSor = $db->prepare("UPDATE site_ayarlari SET site_ismi='{$siteIsmi}' where id=1");
                $kullaniciSor->execute();
                header("Location: magaza.php");
            }

            ?>
            <div class="container">
                <form class="form" name="frmImage" enctype="multipart/form-data" action="" method="POST" class="frmImageUpload">
                    <h5>Ürün Ekleme</h5>
                    <div class="form-group">
                        <label for="yeniUrunFiyat">Fiyat:</label>
                        <input type="number" class="form_control" id="yeniUrunFiyat" name="yeniUrunFiyat">
                    </div>
                    <div class="form-group">
                        <label for="yeniUrunResim">Yüklenecek Resim: </label>
                        <input class="form-file" name="userImage" type="file" id="yeniUrunResim" name="yeniUrunResim" />
                    </div>
                    <input class="btn btn-light" type="submit" value="Kaydet" />
                    <hr>
                    <h5>Site İsmini Değiştirme</h5>
                    <div class="form-group">
                        <label for="yeniSiteIsmi">Site İsmi:</label>
                        <input type="text" class="form_control" id="yeniUrunFiyat" name="yeniSiteIsmi" placeholder="En fazla 50 karakter">
                    </div>
                    <input class="btn btn-light" type="submit" value="Kaydet" name="siteIsmiDegistir" />
                </form>
            </div>

        </div>
    </div>

    <div class="container">
        <!-- Genel Bilgiler -->
        <div class="row mt-2">
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">TOPLAM SİPARİŞ</h5>
                        <div class="card-text" id="toplamSiparis">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT toplam_siparis from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek['toplam_siparis'];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">BEKLEYEN SİPARİŞ</h5>
                        <div class="card-text" id="bekleyenSiparis">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT bekleyen_siparis from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek["bekleyen_siparis"];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">İADE SİPARİŞ</h5>
                        <div class="card-text" id="iadeSiparis">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT iade_siparis from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek["iade_siparis"];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">TOPLAM ÖDEME</h5>
                        <p class="card-text">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT toplam_odeme from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek["toplam_odeme"];
                        ?>₺</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">AÇIK BAKİYE</h5>
                        <p class="card-text">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT acik_bakiye from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek["acik_bakiye"];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class=" col-md-4 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">BS / BA MUTABAKAT</h5>
                        <p class="card-text">
                            <?php $cookieId = $_COOKIE['id'];
                            $kullaniciSor = $db->prepare("SELECT bs_ba_mutabakat from kullanicilar where id=$cookieId");
                            $kullaniciSor->execute();
                            $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
                            echo $kullaniciCek["bs_ba_mutabakat"];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tablolar -->
        <div class="card text-center mt-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <form action=" " method="POST"><input class="btn btn-sm text-primary" type="submit" name="sonSiparislerButton" value="Son Siparişler"></form>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="nav-link"  action=" " method="POST"><input class="btn btn-sm text-primary" type="submit" name="bekleyenSiparislerButton" value="Bekleyen Siparişler"></form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <form action=" " method="POST"><input class="btn btn-sm text-primary" type="submit" name="iadeSiparislerButton" value="İade Siparişler"></form>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" id="tablo">

                </table>
            </div>
            <script type="text/javascript">
                var itemAdları = {
                    tablo: "#tablo",
                    sonSiparisButton: "#sonSiparis",
                    bekleyenSiparisButton: "#bekleyenSiparis",
                    iadeSiparisButton: "#iadeSiparis"
                }
            </script>

            <?php // Son Siparişler Tablosu
            if(isset ($_POST['sonSiparislerButton']))
            {
                $kullaniciSor = $db->prepare("SELECT * from son_siparisler");
                $kullaniciSor->execute();
                ?>
                <script type="text/javascript">
                    let html = `
                    <thead>
                    <tr>
                    <th scope="col">Sipariş No</th>
                    <th scope="col">Sipariş Veren</th>
                    <th scope="col">Durumu</th>
                    <th scope="col">Sipariş Tarihi</th>
                    <th scope="col">Ödeme</th>
                    <th scope="col">Tutar(₺)</th>
                    </tr>
                    </thead>
                    <tbody>`;
                </script>

                <?php while ($kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <script type="text/javascript">
                        html += `
                        <tr>
                        <th scope="row"><?php echo $kullaniciCek['siparis_no'] ?></th>
                        <td><?php echo $kullaniciCek['siparis_veren'] ?></td>
                        <td><?php echo $kullaniciCek['durum'] ?></td>
                        <td><?php echo $kullaniciCek['siparis_tarihi'] ?></td>
                        <td><?php echo $kullaniciCek['odeme'] ?></td>
                        <td><?php echo $kullaniciCek['tutar'] ?>,00 ₺</td>
                        </tr>
                        `;
                    </script>

                <?php } ?>
                <script type="text/javascript">
                    html += `</tbody>`;

                    console.log(itemAdları.tablo);
                    var tabloItem = document.querySelector(itemAdları.tablo);
                    tabloItem.innerHTML = "";
                    tabloItem.innerHTML = html;
                </script>
            <?php } ?>


            <?php // Bekleyen Siparişler Tablosu
            if(isset ($_POST['bekleyenSiparislerButton']))
            {
                $kullaniciSor = $db->prepare("SELECT * from bekleyen_siparisler");
                $kullaniciSor->execute();
                ?>
                <script type="text/javascript">
                    let html = `
                    <thead>
                    <tr>
                    <th scope="col">Sipariş No</th>
                    <th scope="col">Sipariş Veren</th>
                    <th scope="col">Durumu</th>
                    <th scope="col">Sipariş Tarihi</th>
                    </tr>
                    </thead>
                    <tbody>`;
                </script>

                <?php while ($kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <script type="text/javascript">
                        html += `
                        <tr>
                        <th scope="row"><?php echo $kullaniciCek['siparis_no'] ?></th>
                        <td><?php echo $kullaniciCek['siparis_veren'] ?></td>
                        <td><?php echo $kullaniciCek['durum'] ?></td>
                        <td><?php echo $kullaniciCek['siparis_tarihi'] ?></td>
                        </tr>
                        `;
                    </script>

                <?php } ?>
                <script type="text/javascript">
                    html += `</tbody>`;

                    console.log(itemAdları.tablo);
                    var tabloItem = document.querySelector(itemAdları.tablo);
                    tabloItem.innerHTML = "";
                    tabloItem.innerHTML = html;
                </script>
            <?php } ?>

            <?php // İade Siparişler Tablosu
            if(isset ($_POST['iadeSiparislerButton']))
            {
                $kullaniciSor = $db->prepare("SELECT * from iade_siparisler");
                $kullaniciSor->execute();
                ?>
                <script type="text/javascript">
                    let html = `
                    <thead>
                    <tr>
                    <th scope="col">Sipariş No</th>
                    <th scope="col">Sipariş Veren</th>
                    <th scope="col">Durumu</th>
                    <th scope="col">Sipariş Tarihi</th>
                    <th scope="col">İade Nedeni</th>
                    </tr>
                    </thead>
                    <tbody>`;
                </script>

                <?php while ($kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <script type="text/javascript">
                        html += `
                        <tr>
                        <th scope="row"><?php echo $kullaniciCek['siparis_no'] ?></th>
                        <td><?php echo $kullaniciCek['siparis_veren'] ?></td>
                        <td><?php echo $kullaniciCek['durum'] ?></td>
                        <td><?php echo $kullaniciCek['siparis_tarihi'] ?></td>
                        <td><?php echo $kullaniciCek['iade_nedeni'] ?></td>
                        </tr>
                        `;
                    </script>

                <?php } ?>
                <script type="text/javascript">
                    html += `</tbody>`;

                    console.log(itemAdları.tablo);
                    var tabloItem = document.querySelector(itemAdları.tablo);
                    tabloItem.innerHTML = "";
                    tabloItem.innerHTML = html;
                </script>
            <?php } ?>
        </div>

        <div class="row ">
            <div class="col-sm-6 mt-3" >
                <div id="chartContainer" style="width: 100%;"></div>
            </div>
            <div class="col-sm-6 mt-3" id="chart2">
               <div id="chartContainer2" style="width: 100%;"></div>
           </div>
       </div>
       <div class="row">
        <div class="col-sm-6 mt-3" style="padding-top: 450px;">
            <div id="chartContainer3" style="width: 100%;"></div>
        </div>
        <div class="col-sm-6 mt-3" style="padding-top: 450px;">
            <div id="chartContainer4" style="width: 100%;"></div>
        </div>
    </div>

</div>

<div class="container">
    <footer class="page-footer  font-small text-sm-right" style="padding-top: 450px;">
        <img src="img/cevizsoft.png" class="responsive" alt="" style="height: 90px;">
    </footer>

</div>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="js/hesapDokumu.js" type="text/javascript"></script>


</html>