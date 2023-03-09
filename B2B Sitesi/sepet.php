<!DOCTYPE html>
<html lang="tr">

<head>
    <title>SEPET</title>
    <link rel="icon" href="img/cevizsoft.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="sepet.css">
</head>

<body>

    <div class="container">

        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <img src="img/cevizsoft.png" alt="" style="max-height: 25px;" class="mr-1">
            <a class="navbar-brand" href="magaza.html">BURAK GIDA</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapse_target">

                <form class="form-inline md-auto">
                    <input class="form-control mr-sm-2" style="width: 350px;" type="search" placeholder="Ara"
                        aria-label="Search">
                    <button class="btn btn-light my-sm-0" type="submit"><img src="img/search.png" alt=""
                            height="25px"></button>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="hesapDokumu.html">
                            Kalan Bakiye :
                            <span id="kalanBakiye"> 150.000,00 </span>
                            ₺
                        </a>
                    </li>
                    <!-- Sepet ile resmi birleştir -->
                    <li class="nav-item">
                        <a class="nav-link" href="sepet.html"><img src="img/sepet.png" alt="" height="25px">
                            <span id="sepettekiUrunSayisi">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="img/message.png" alt="" height="25px">
                            <span id="mesajSayisi"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-9  border rounded">
                <div class="mt-2 mb-2   ">
                    <span class="mr-2"><b>Ürün İsmi</b></span>

                    <div class="btn-group btn-light rounded">
                        <a href="#" class="btn btn-light"><img src="img/cop.png" alt="" style="height:17px;"></a>
                        <a href="#" class="btn btn-light"><img src="img/minus-dark.png" alt="" style="height:17px;"></a>
                        <a href="#" class="btn btn-light"><b>0</b> </a>
                        <a href="#" class="btn btn-light"><img src="img/add-dark.png" alt="" style="height:17px;"></a>
                    </div>
                </div>

            </div>

            <div class="col-sm-3 card border rounded">
                <p class="mt-2"><b>Sipariş Özeti</b></p>
                <p>Ürün Toplamı (0,00 adet) : <b>0,00 ₺</b></p>
                <p>Kargo Ücreti : <b>0,00 ₺</b></p>
                <p><b>Ödenecek Tutar : 0,00 ₺</b></p>
                <button class="btn btn-dark mb-2">
                    <b>Alışverişi Tamamla</b>
                </button>
            </div>

        </div>

    </div>

    <footer class="page-footer font-small text-sm-right">
        <img src="img/cevizsoft.png" class="responsive" alt="" style="height: 120px;">
    </footer>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>

</html>