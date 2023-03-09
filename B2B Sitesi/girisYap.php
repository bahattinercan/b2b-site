<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <?php
    require_once 'baglan.php';

    if (isset($_POST['girisFormu'])) {

        $alinanKullaniciAdi = $_POST['kullaniciAdi'];
        $alinanParola = $_POST['parola'];

        $bilgilerimsor = $db->prepare("SELECT kullanici_adi,parola,id from kullanicilar");
        $bilgilerimsor->execute();

        while ($bilgilerimcek = $bilgilerimsor->fetch(PDO::FETCH_ASSOC)) {
            $sistemKA = $bilgilerimcek['kullanici_adi'];
            $sistemP = $bilgilerimcek['parola'];
            $sistemID = $bilgilerimcek['id'];
            $db->connection = null;
            if (($sistemKA == $alinanKullaniciAdi and $sistemP == $alinanParola)) {
                setcookie('id', $sistemID);
                header("Location:magaza.php");
                return;
            }
        }
        header("Location:giris.php");
    }

    ?>
</body>

</html>