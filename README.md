# B2B Site — PHP

Toptan satış (B2B) sitesi: giriş, ürün mağazası, sepet, cari hesap dökümü ve ürün görseli
yükleme. Saf PHP + MySQL (PDO) ile yazıldı; framework yok.

## Sayfalar

```
B2B Sitesi/
├── giris.php / girisYap.php     # giriş formu ve oturum açma
├── magaza.php                   # ürün listeleme
├── sepet.php                    # sepet
├── hesapDokumu.php              # cari hesap dökümü
├── resimEkle.php                # ürün görseli yükleme
├── imageView.php / listImages.php
├── baglan.php                   # PDO MySQL bağlantısı
├── db.php / ayarlar.php
├── css/ (giris, magaza, sepet, hesapDokumu, charty)
└── js/ (giris, hesapDokumu)
```

## Çalıştırma

MySQL'de `b2bsitesi` adında bir veritabanı oluşturun, `baglan.php` içindeki bağlantı bilgilerini
kendi ortamınıza göre düzenleyin, ardından klasörü PHP destekli bir sunucuda yayınlayın:

```bash
php -S localhost:8000 -t "B2B Sitesi"
```

## Sınırlar ve uyarılar

Bu repo bir dönem çalışması olarak duruyor; üretime çıkmadan önce kapatılması gereken borçlar:

- **Veritabanı bilgileri `baglan.php` içinde sabit yazılı.** Ortam değişkenine taşınmalı ve
  dosya `.gitignore`'a alınmalı.
- **Şifre saklama yöntemi gözden geçirilmeli** — `password_hash()` / `password_verify()`
  kullanımı doğrulanmadı.
- **Sorgularda parametreli ifade denetimi yapılmadı**; SQL enjeksiyonu açısından taranmalı.
- Sepet ve hesap dökümü iş kuralları için **test yok**.
