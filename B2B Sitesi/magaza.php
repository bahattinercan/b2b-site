<!DOCTYPE html>
<html lang="tr">

<head>
    <?php require_once 'baglan.php';
    ?>
    <title>MAĞAZA</title>
    <link rel="icon" href="img/cevizsoft.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/magaza.css">

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
                    <hr>
                    <h5>Ürün Ekleme</h5>
                    <div class="form-group">
                        <label for="yeniUrunFiyat">Fiyat:</label>
                        <input type="number" class="form_control" id="yeniUrunFiyat" name="yeniUrunFiyat">
                    </div>
                    <div class="form-group">
                        <label for="yeniUrunResim">Yüklenecek Resim: </label>
                        <input class="form-file " name="userImage" type="file" id="yeniUrunResim" name="yeniUrunResim" />
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

    <div class="container" style="margin-bottom: 25px;">
        <div class="rows">
            <div class="col-sm-12">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/slider image 1.jpg" class="d-block w-100" alt="Resim" data-interval="2000" style=" max-height: 520px;">
                            <div class="carousel-caption d-none d-block text-dark">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider image 2.jpg" class="d-block w-100" alt="Resim" data-interval="2000" style="max-height: 520px;">
                            <div class="carousel-caption d-none d-block text-dark">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/slider image 3.jpg" class="d-block w-100" alt="Resim" data-interval="2000" style="max-height: 520px;">
                            <div class="carousel-caption d-none d-block text-dark">
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


        </div>
    </div>

    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-4 mb-2">
                <a href="#" class="text-dark">
                    <img src="img/empty.png" class="card-img-top" alt="..." style="border-radius: 15px; height: 250px; ">
                </a>
            </div>
            <div class="col-sm-4 mb-2">
                <a href="#" class="text-dark">
                    <img src="img/empty.png" class="card-img-top" alt="..." style="border-radius: 15px; height: 250px;">
                </a>
            </div>
            <div class="col-sm-4 mb-2">
                <a href="#" class="text-dark">
                    <img src="img/empty.png" class="card-img-top" alt="..." style="border-radius: 15px; height: 250px;">
                </a>
            </div>
        </div>
        <!-- Satırlar -->
        <div class="row">

            <?php
            $bilgilerimsor = $db->prepare("SELECT * from urunler");
            $bilgilerimsor->execute();
            while ($bilgilerimcek = $bilgilerimsor->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-sm-4 mb-3">
                    <div class="card">
                        <img src="imageView.php?id=<?php echo $bilgilerimcek["id"]; ?>" class="card-img-top" alt="..." style="max-height:300px" />
                        <div class="card-body text-center pb-1 pt-1 pr-0 pl-0">
                            <div class="card-text">
                                <span class="card-title my-auto mr-2"><b> <?php echo $bilgilerimcek["fiyat"]; ?> ₺</b></span>
                                <div class="btn-group">
                                    <a href="#" type="button" class="btn btn-danger"><img src="img/minus.png" alt="" style="height: 13px;"></a>
                                    <a href="#" type="button" class="btn btn-light" >
                                        <input type="text" value="0" id="<?= $urunSayisi.$bilgilerimcek['id'] ?>"></a>
                                    <?php 
                                    $geciciYazi=$urunSayisi+$bilgilerimcek['id'];
                                    ?>
                                    <a type="button" class="btn btn-success" onclick="UrunSayisiniArttir('<?= $geciciYazi ?>')"><img src="img/add.png" alt="" style="height: 13px;"></a>
                                </div>
                                <a href="#" class="btn btn-warning">Sepete Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <script type="text/javascript">
            function UrunSayisiniArttir(buttonID) {
                var button= document.getElementById(buttonID);
                button.value++;
            }
        </script>
    </div>

    <div class="container-fluid">
        <footer class="page-footer font-small text-sm-right">
            <img src="img/cevizsoft.png" class="responsive" alt="" style="height: 90px;">
        </footer>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</script>

</html>