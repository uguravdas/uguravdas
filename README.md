# Tekirdağ Yangın — UI/UX yenileme

[tekirdagyangin.com](https://tekirdagyangin.com/) için hazırlanmış **arayüz yenileme paketi**.

`theme/` klasörü, sitede çalışan `tekirdagyangin` temasının **değiştirilmiş tam
hâlidir**. Depodaki ilk kayıt (commit) temanın dokunulmamış hâli olduğu için
her değişiklik tek tek görülebilir.

Menüler, hesaplayıcı, form mantığı ve içerik aynen korunmuştur.

---

## 1. Kurulum

### Adım 1 — Yedek alın

Sunucuda şu dosyanın bir kopyasını saklayın:

```
/wp-content/themes/tekirdagyangin/assets/css/app.css
```

Geri dönmek isterseniz tek yapmanız gereken bu yedeği geri koymak.

### Adım 2 — Yeni CSS'i yükleyin

`theme/assets/css/app.css` dosyasını aynı yola kopyalayın:

```
/wp-content/themes/tekirdagyangin/assets/css/app.css
```

Tema dosyayı `?ver=` parametresiyle çağırdığı için, değişikliğin görünmesi
adına `functions.php` içindeki sürüm numarasını artırın ya da
`filemtime()` kullanın. LiteSpeed Cache kuruluysa önbelleği temizleyin.

Bu kadar. Site yeni tasarımla çalışır.

### Adım 3 — (İsteğe bağlı) JavaScript

`theme/assets/js/app.js` şunları ekler:

- sayfa kaydırılınca başlığın küçülmesi ve gölge alması,
- bölümlerin kaydırmayla yumuşakça belirmesi,
- mobilde aşağı kaydırırken alt çağrı çubuğunun gizlenmesi,
- mobil menünün `Esc` ile ve dışına tıklanınca kapanması.

Dosyayı `assets/js/app.js` olarak kopyalayın ve `functions.php` içindeki
enqueue fonksiyonuna ekleyin:

```php
wp_enqueue_script(
    'ty-app',
    get_template_directory_uri() . '/assets/js/app.js',
    array(),
    filemtime( get_template_directory() . '/assets/js/app.js' ),
    true
);
```

**Yüklemezseniz de site tam olarak çalışır.** Bu dosya yalnızca hareket ekler;
içeriğin görünmesi ona bağlı değildir.

---

## 2. Koyu tema

Yeni CSS koyu temayı destekliyor. Varsayılan davranış: ziyaretçinin
**cihazı koyu moddaysa** site de koyu görünür (`prefers-color-scheme`).

Bunu istemiyorsanız `header.php` içindeki `<html>` etiketine tek bir öznitelik
eklemek yeterli — site her zaman açık temada kalır:

```php
<html <?php language_attributes(); ?> data-theme="light">
```

Tersi de mümkün: `data-theme="dark"` her zaman koyu tema demektir.

---

## 3. Nelerin değiştiği

### Renk ve okunabilirlik
- Nötr renk basamağı yeniden kuruldu; `--muted` tonu WCAG AA'yı geçecek
  şekilde koyulaştırıldı (beyaz üzerinde 3.81 → **5.36** kontrast).
- Açık zemin üzerinde kırmızı metin kullanılan yerlerde (`.ilce a:hover`,
  aktif menü, filtre etiketleri) `--accent-deep` tonuna geçildi — 4.47 → **6.90**.
- Açık temadaki tüm gövde ve yardımcı metinler artık AA eşiğini geçiyor.

### Tipografi
- Tüm ölçek `clamp()` ile akışkan hâle getirildi; başlıklarda daha sıkı
  harf aralığı, gövdede daha rahat satır yüksekliği.
- Rakamlar `tabular-nums` ile hizalanıyor (telefon numaraları, ölçüler).

### Derinlik ve hareket
- Katmanlı gölge sistemi; kart, buton ve açılır menülerde yumuşak yay eğrileri.
- Kaydırmayla beliren bölümler, butonlarda ince parıltı, kart ve ikonlarda
  hover hareketi.
- `prefers-reduced-motion` açık olan ziyaretçilerde tüm hareket kapanır.

### Bölüm bazlı
- **Hero:** ince nokta dokusu ve iki katmanlı degrade ile derinlik; dikey
  ritim sıkılaştırıldı, iletişim kartının üst kenarına vurgu şeridi eklendi.
- **Fotoğrafsız ürün kartları:** eskiden düz pembe boş kutu olarak görünüyordu.
  Artık degrade zemin, çapraz güvenlik şeridi dokusu ve ortada cam görünümlü
  ikon rozeti var; fotoğraf olmayan kartlar daha az yer kaplıyor.
- **Rakam şeridi ve süreç bölümü:** koyu zeminde kırmızı ışık huzmesi,
  adımları birleştiren ince bağlantı hattı.
- **Formlar:** 48px minimum yükseklik, belirgin odak halkası, özel `select` oku.
- **Mobil:** menü ögeleri 52px, alt çağrı çubuğu `safe-area` uyumlu ve
  aşağı kaydırırken gizleniyor.

### Erişilebilirlik
- Her etkileşimli ögede görünür odak halkası.
- Dokunma hedefleri en az 44–48px.
- Baskı (print) stil sayfası eklendi.

---

## 4. Uyumluluk

`color-mix()` ve `:has()` gibi yeni CSS özellikleri kullanıldı; hepsi
**yedekli** yazıldı — desteklemeyen tarayıcıda düz renge düşer, hiçbir
bölüm kaybolmaz. `:has()` ayrıca `@supports` ile korumaya alındı.

Doğrulama: yeni sayfa Chromium'da **542 kuralın tamamı hatasız** ayrıştırıldı;
temanın eski `app.css` dosyasındaki **236 sınıfın tamamı** ve canlı sitenin
57 sayfasında geçen sınıfların tamamı karşılanıyor.

---

## 5. Tasarım dışında öne çıkan bulgular

Bunlar bu paketin kapsamı dışında ama sitenin işine doğrudan etki ediyor:

1. **Site arama motorlarına kapalı.** 57 sayfanın tamamında
   `<meta name="robots" content="noindex, nofollow">` var. Bu, WordPress'teki
   *Ayarlar → Okuma → "Arama motorlarının siteyi indekslemesini engelle"*
   kutusundan geliyor. Kutu işaretli kaldığı sürece site Google'da çıkmaz.
2. **Hiçbir sayfada `<meta name="description">` yok**, Open Graph / Twitter
   etiketi de yok. WhatsApp'ta link paylaşıldığında önizleme çıkmıyor.
3. **13 ürün sayfasının hiçbirinde görsel yok.** Oysa temada
   `assets/img/foto/` altında 12 hazır fotoğraf duruyor — örneğin ana sayfadaki
   "En çok satılan modeller" kartları için `6kg-kkt.jpg`, `davlumbaz.jpg` ve
   `yangin-dolabi.jpg` zaten mevcut. Bunları bağlamak en büyük görsel kazanç olur.
4. **Görsellerde `srcset` yok**; hepsi 800×600 tek boyut servis ediliyor.
5. `/rehber/` bölümünde hiç yazı yok — menüde duran boş bir bölüm.

---

## 6. Görseller

### Ürün fotoğrafları artık kendiliğinden geliyor

Temada `assets/img/foto/` altında 18 fotoğraf duruyordu ama sitede yalnızca
12'si görünüyordu. Sebep: `ty_urun_kart()` fonksiyonu, üründe WordPress
"öne çıkan görsel" ayarlı değilse ikona düşüyordu — 13 ürünün hiçbirinde
ayarlı olmadığı için bütün ürün kartları boş renkli kutu olarak çıkıyordu.

Eklenen `ty_urun_foto()` fonksiyonu önce öne çıkan görsele bakar, yoksa
ürünün adına/slug'ına göre temadaki uygun fotoğrafı bulur. 13 canlı ürün
adıyla test edildi: **10'u doğru fotoğrafa eşleşiyor**. Kalan üçünün
(battaniye, aparat, vana-rakor) temada yalnızca "fotoğraf bekleniyor"
yer tutucusu olduğu için ikon yedeğinde bırakıldı — yangın ekipmanında
yanlış ürün fotoğrafı, fotoğrafsızlıktan kötüdür.

Panelden bir ürüne öne çıkan görsel seçerseniz her zaman o kazanır.

### Sektör kartlarına fotoğraf ekleme

Sektör kartları şu an sade ve ikonlu. Fotoğraf eklemek için kod
değiştirmeye gerek yok — şu adla bir dosya bırakmanız yeterli:

```
assets/img/foto/sektor-<slug>.jpg      önerilen boyut 1200x900 (4:3)
```

Slug listesi:

```
sektor-fabrika-osb.jpg        sektor-okul-kres.jpg
sektor-site-apartman.jpg      sektor-ofis-is-merkezi.jpg
sektor-depo-lojistik.jpg      sektor-akaryakit.jpg
sektor-restoran-otel.jpg      sektor-hastane-saglik.jpg
```

Dosyayı koyduğunuz an o kart fotoğraflı hâle geçer; koymadığınız kartlar
mevcut sade görünümünü korur, hiçbir şey bozulmaz.

### Mevcut fotoğrafların sınırı

Temadaki fotoğrafların tamamı **800×600**. Kart içinde nettir, ama hero
gibi geniş alanlarda büyütülünce yumuşak kalır. Bu yüzden hero'yu
fotoğrafa taşımadım. Geniş görsel kullanmak isterseniz en az **1600 piksel
genişliğinde** dosya gerekir.
