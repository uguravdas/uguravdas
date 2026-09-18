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

### Fotoğrafsız kart kalmadı

Temada 18 fotoğraf vardı ama sitede yalnızca 12'si görünüyordu. Sebep koddaydı:
ürün kartı, WordPress "öne çıkan görsel" ayarlı değilse ikona düşüyordu ve 13
ürünün hiçbirinde ayarlı değildi.

Eklenen `ty_urun_foto()` önce öne çıkan görsele bakar, yoksa ürünün
adına/slug'ına göre temadaki fotoğrafı bulur. **13 ürünün 13'ü** doğru
fotoğrafa eşleşiyor. Panelden öne çıkan görsel seçerseniz her zaman o kazanır.

Üç ürünün (yangın battaniyesi, duvar aparatı, vana-rakor) temada yalnızca
"fotoğraf bekleniyor" yazan yer tutucusu vardı. Bunlar **yeni üretilen ürün
fotoğraflarıyla değiştirildi** — mevcut çekimlerin tarzına (krem zemin, stüdyo
ışığı, 800×600) uyacak şekilde hazırlandı. Kendi çekimleriniz olduğunda aynı
dosya adlarının üzerine yazmanız yeterli:

```
assets/img/foto/battaniye.jpg
assets/img/foto/aparat.jpg
assets/img/foto/vana-rakor.jpg
```

### Sayfa başına fotoğraf sayısı

| Sayfa | Fotoğraf | İkon yedeği |
|---|---|---|
| Ana sayfa | 12 | 0 |
| Sektör sayfaları (8 adet) | 5 | 0 |
| İlçe sayfaları (11 adet) | 8 | 0 |
| Ürünler | 13 | 0 |
| Tüp sayfaları | 9 | 0 |
| Dolap sayfaları | 11 | 4 |
| Ürün detay | 1 | 1 |

Kalan ikonlar bilinçli: hesaplayıcı kartı, iletişim kartları ve soyut
yönetmelik eşikleri ("1.000 m² üstü", "350 kW üstü kazan dairesi") — bunlara
fotoğraf koymak yanıltıcı olurdu.

### Nereye ne eklendi

- **Ana sayfa:** kategori kartları ince 4'lü sıradan büyük fotoğraflı 2×2
  düzene alındı; 8 sektör kartının tamamı fotoğraflandı.
- **Sektör sayfaları:** sayfa başlığına o sektöre ait fotoğraf, hizmet
  kartlarına ürün fotoğrafı eklendi.
- **İlçe sayfaları:** ürün ve hizmet kartları fotoğraflandı.
- **Tüp/dolap sayfaları:** toplu alım ve yedek parça kartları fotoğraflandı.
- **Ürün detay sayfaları:** artık ürün fotoğrafı gösteriyor.

### Sektör fotoğrafını değiştirmek

Her sektörün fotoğrafı `inc/data.php` içinde `'foto' =>` satırında tanımlı.
Kendi fotoğrafınızı koymak isterseniz kod değiştirmenize gerek yok; şu adla
bir dosya bırakmanız yeterli, o dosya önceliklidir:

```
assets/img/foto/sektor-<slug>.jpg      önerilen 1200x900 (4:3)
```

Slug listesi: `fabrika-osb`, `site-apartman`, `depo-lojistik`,
`restoran-otel`, `okul-kres`, `ofis-is-merkezi`, `akaryakit`,
`hastane-saglik`.

### Mevcut fotoğrafların sınırı

Fotoğrafların tamamı **800×600**. Kart içinde nettir ama hero gibi tam genişlik
alanlarda yumuşak kalır; bu yüzden ana sayfa hero'suna fotoğraf koymadım.
Geniş görsel için en az **1600 piksel** genişliğinde dosya gerekir.

---

## 7. İnsan yapımı hissi ("hümanist" katman)

Bir sitenin "otomatik üretilmiş" görünmesinin en güçlü sebepleri şunlardır:
yarım kalmış sayfalar, hiç kimseye ait olmayan bir ses, kusursuz simetri ve
arkasında insan olduğunu gösteren hiçbir iz bulunmaması. Aşağıdakiler bunları
kırmak için yapıldı.

### Boş sayfalar dolduruldu

| Sayfa | Önce | Sonra |
|---|---|---|
| Rehber | "Henüz yazı yok" | **51 soru-cevap**, 3 grupta, her biri kaynağına bağlı |
| İletişim | 2 cümle + form | Künye bloğu, çalışma saatleri, hizmet bölgesi, harita, imza |

Rehber'deki sorular uydurulmadı: ürün ve sektör sayfalarınızda zaten yazılı
olan içerik tek yerde toplandı. Yazı eklediğinizde sayfa normal blog listesine
döner, bu derleme kendiliğinden devreye girmez.

### Arkasında insan olduğunu gösteren izler

- **İmza bloğu** — el yazısı görünümlü imza, ad, ünvan ve isteğe bağlı fotoğraf.
  Hakkımızda, Belgelerimiz ve İletişim sayfalarının altında çıkar.
- **Güvence bandı** — "Ne söz veriyoruz": dört somut söz ve elle basılmış
  görünümlü damga. Maddeler sitenizde zaten geçen sözler, yeni iddia eklenmedi.
- **Altbilgi** — her sayfada çalışma saatleri, açık adres, kaç yıldır çalıştığınız
  ve sorumlu kişi.
- **Künye** — "Kiminle konuşuyorsunuz" başlığı altında firma, adres, telefon,
  saatler ve hizmet bölgesi; "Pazar kapalıyız", "Aramaya cevap veremezsek geri
  döneriz" gibi gerçek notlarla.

### Tasarımdaki el işi detayları

- Başlıkların altına **elle çizilmiş, düzensiz kırmızı çizgi** (düz cetvel çizgisi değil).
- Renkli bölümlerde **kâğıt taneciği dokusu** — düz dijital zemin yerine.
- **Eğik basılmış damga**, tam hizalı değil.
- Uzun metinlerde **ilk harf büyütmesi** ve **asılı tırnaklı alıntı** — matbaa işi detayları.

### Panelden doldurulacak alanlar

**Görünüm → Özelleştir → Firma ve Yetkili**

| Alan | Örnek | Nerede görünür |
|---|---|---|
| Yetkili adı soyadı | (adınız) | İmza, altbilgi |
| Yetkili ünvanı | Kurucu · Yangın güvenlik sorumlusu | İmza |
| Yetkili fotoğrafı | kare, en az 200×200 | İmza |
| Kuruluş yılı | 2016 | "10 yıldır Tekirdağ'da" |
| Açık adres | Hürriyet Mah. 1012 Sok. No:14/A | Künye, altbilgi |
| Harita gömme adresi | Google Maps "embed" kodu | İletişim sayfası |

**Bu alanlar boşken hiçbir şey basılmaz** — yarım görünen bir blok kalmaz.
Yani tema şimdi de sorunsuz çalışır; doldurdukça site daha da kişiselleşir.

### Bunu mutlaka yapın: İletişim sayfasının şablonu

Temada zengin bir **"İletişim sayfası"** şablonu var ama canlı sitede İletişim
sayfasına atanmamış; bu yüzden künye ve harita görünmez.

**Sayfalar → İletişim → Düzenle → (sağ sütun) Sayfa Özellikleri → Şablon →
"İletişim sayfası" → Güncelle**

### Sizin tamamlamanız gerekenler

Bunlar sayfa içeriğinde (veritabanında) olduğu için temadan değiştirilemez:

1. **Belgelerimiz** sayfasındaki *"Belgelerimizin görselleri bu sayfaya
   eklenecektir."* cümlesi. Belge fotoğraflarını yükleyin ya da bu cümleyi
   kaldırın — "eklenecek" demek siteyi yarım gösterir.
2. **Hakkımızda** sayfasına iki üç cümlelik kişisel bir giriş: bu işe ne zaman,
   neden başladınız. Sitedeki en insani metin bu olur.
