# Tekirdağ Yangın teması — güncellenmiş sürüm

Bu klasör, sitede çalışan `tekirdagyangin` temasının güncellenmiş hâlidir.
Menüler, ürünler, hesaplayıcı, formlar ve tüm içerik aynen korunmuştur.

## Kurulum (2 yol)

### A) WordPress panelinden (en kolay)

1. **Önce yedek alın:** Görünüm → Temalar → mevcut temayı bir FTP/dosya
   yöneticisinden indirin ya da hosting panelinden `wp-content/themes/`
   klasörünü yedekleyin.
2. Panel → **Görünüm → Temalar → Yeni ekle → Tema yükle**
3. `tekirdagyangin.zip` dosyasını seçin → **Şimdi yükle**
4. "Tema zaten var" uyarısı çıkarsa **"Yüklediğim dosyayla değiştir"** deyin.
5. LiteSpeed Cache kuruluysa: **LiteSpeed Cache → Araçlar → Tüm önbelleği boşalt**

### B) FTP / cPanel Dosya Yöneticisi ile

1. `wp-content/themes/tekirdagyangin/` klasörünün yedeğini alın.
2. Zip içindeki `tekirdagyangin` klasörünü aynı yere, üzerine yazarak yükleyin.
3. Önbelleği temizleyin.

## Geri dönmek isterseniz

Yedeklediğiniz eski klasörü aynı yere geri koyun. Veritabanında hiçbir
değişiklik yapılmadı; içerik, ürünler ve ayarlar etkilenmez.

## İsteğe bağlı: hareket dosyası (app.js)

`assets/js/app.js` küçük arayüz geliştirmeleri ekler (kaydırınca başlığın
küçülmesi, bölümlerin belirmesi, mobil menünün Esc ile kapanması).
**Yüklenmese de site tam çalışır.** Devreye almak için `functions.php`
içindeki enqueue fonksiyonuna şunu ekleyin:

```php
wp_enqueue_script(
    'ty-app',
    get_template_directory_uri() . '/assets/js/app.js',
    array(),
    filemtime( get_template_directory() . '/assets/js/app.js' ),
    true
);
```

## Koyu tema

Ziyaretçinin cihazı koyu moddaysa site de koyu görünür. İstemezseniz
`header.php` içindeki `<html>` etiketine tek öznitelik ekleyin:

```php
<html <?php language_attributes(); ?> data-theme="light">
```

## Fotoğrafları değiştirmek

Tüm fotoğraflar `assets/img/foto/` klasöründe, 800×600 JPG. Kendi
çekimlerinizi aynı dosya adının üzerine yazarak değiştirebilirsiniz.

Sektör fotoğrafı için özel dosya koymak isterseniz (kod değiştirmeden):

```
assets/img/foto/sektor-fabrika-osb.jpg       önerilen 1200x900
sektor-site-apartman.jpg    sektor-depo-lojistik.jpg
sektor-restoran-otel.jpg    sektor-okul-kres.jpg
sektor-ofis-is-merkezi.jpg  sektor-akaryakit.jpg
sektor-hastane-saglik.jpg
```

Bu dosya varsa o sektörde sizin fotoğrafınız kullanılır.

## Yükledikten sonra yapılacak 3 şey

### 1. İletişim sayfasının şablonunu seçin  (önemli)

Temadaki zengin iletişim sayfası (künye, çalışma saatleri, harita, imza)
ancak şablon atanınca görünür:

**Sayfalar → İletişim → Düzenle → sağ sütunda "Sayfa Özellikleri" →
Şablon → "İletişim sayfası" → Güncelle**

### 2. Firma ve yetkili bilgilerini girin

**Görünüm → Özelleştir → Firma ve Yetkili**

| Alan | Örnek |
|---|---|
| Yetkili adı soyadı | (adınızı yazın) |
| Yetkili ünvanı | Kurucu · Yangın güvenlik sorumlusu |
| Yetkili fotoğrafı | kare, en az 200×200 px |
| Kuruluş yılı | 2016 |
| Açık adres | Hürriyet Mah. 1012 Sok. No:14/A |
| Harita gömme adresi | Google Maps → işletmenizi bulun → Paylaş → "Harita yerleştir" → kodu kopyalayın |

Bu alanlar **boş bırakılırsa hiçbir yerde görünmez**; site yine sorunsuz
çalışır. Doldurdukça imza, künye ve altbilgi kişiselleşir.

### 3. Arama motoru engelini kaldırın

Sitedeki **57 sayfanın tamamında** `noindex, nofollow` etiketi var. Bu tema
kaynaklı değil, WordPress ayarından geliyor:

**Ayarlar → Okuma → "Arama motorlarının bu siteyi indekslemesini engelle"**
kutusunun işaretini kaldırın. İşaretli kaldığı sürece site Google'da çıkmaz.

---

## Sizin tamamlamanız gerekenler (sayfa içeriği)

Bunlar tema dosyasında değil, WordPress sayfa içeriğinde — panelden
düzenlemeniz gerekir:

1. **Belgelerimiz** sayfasındaki *"Belgelerimizin görselleri bu sayfaya
   eklenecektir."* cümlesi. Belge fotoğraflarını yükleyin ya da cümleyi
   kaldırın — "eklenecek" ifadesi siteyi yarım gösterir.
2. **Hakkımızda** sayfasına iki üç cümlelik kişisel giriş: bu işe ne zaman ve
   neden başladınız. Sitedeki en insani metin bu olur.
