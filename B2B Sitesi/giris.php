<!DOCTYPE html>
<html lang="tr">

<head>
    <title>GİRİŞ</title>
    <link rel="icon" href="img/cevizsoft.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/giris.css">
    <style>

</style>
</head>

<body>


    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 text-center mt-3">
                <img src="img/Giriş Arkaplan.jpg" alt="Nature" id="girisResmi" >
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form action="girisYap.php" method="POST">
                    <div class="form-group">
                        <label for="email">Kullanıcı Adı:</label>
                        <input type="text" class="form-control" id="email" placeholder="Kullanıcı Adınız" name="kullaniciAdi" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Şifre:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Şifreniz" name="parola" required="">
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="hatirla"> Beni
                            Hatırla
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="girisFormu">Giriş Yap</button>
                </form>
            </div>
            <div class="col-sm-4">
            </div>
        </div>

        <div class="container-fluid">
            <footer class="page-footer font-small text-sm-right"">
                <img src="img/cevizsoft.png" class="responsive" alt="" style="height: 90px;">
            </footer>
        </div>

    </div>
</body>

<script src="js/giris.js"></script>
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