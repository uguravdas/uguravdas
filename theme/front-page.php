<?php
/**
 * Ana sayfa — ürün vitrini.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$one = function_exists( 'ty_one_cikan_urunler' ) ? ty_one_cikan_urunler( 6 ) : array();
?>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Tekirdağ yangın güvenliği ekipmanları</span>
      <h1>Yangın güvenliğinde ne lazımsa, <em>tek adresten</em>.</h1>
      <p class="hero-lead">Söndürme tüpü, yangın dolabı, davlumbaz ve pano içi otomatik söndürme, araç tüpü ve yardımcı ekipman. Tek adet de satarız, tesisin tamamını da donatırız — montaj dahil.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#urunler">Ürünleri gör</a>
        <a class="btn btn-line" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-hero"><?php echo ty_ikon( 'hesap' ); ?>İhtiyacını hesapla</a>
      </div>
      <div class="pills">
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Aynı gün fiyat</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Montaj dahil</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Toplu alımda özel fiyat</span>
      </div>
    </div>

    <div class="hero-iletisim">
      <span class="eyebrow">Aynı gün fiyat</span>
      <h2>Arayın, konuşarak halledelim</h2>
      <p>Ne lazım olduğunu biliyorsanız bir telefon yeter. Bilmiyorsanız yerinizi anlatın, listeyi biz çıkaralım.</p>
      <a class="hero-tel" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-hero"><?php echo ty_ikon( 'telefon' ); ?><span><?php echo esc_html( ty_tel() ); ?></span></a>
      <div class="hero-il-cta">
        <a class="btn btn-primary btn-sm" href="#teklif">Teklif formu</a>
        <a class="btn btn-line btn-sm" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="wa-hero"><?php echo ty_ikon( 'whatsapp' ); ?>WhatsApp</a>
      </div>
      <ul class="hero-il-liste">
        <li><?php echo ty_ikon( 'saat' ); ?><span><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?> · <?php echo esc_html( ty_op( 'ty_saat_cmt' ) ); ?></span></li>
        <li><?php echo ty_ikon( 'onay' ); ?><span>Keşif ücretsiz, montaj fiyata dahil</span></li>
        <li><?php echo ty_ikon( 'harita' ); ?><span>Tekirdağ'ın 11 ilçesine teslim</span></li>
      </ul>
    </div>
  </div>
</section>

<section class="stats">
  <div class="wrap stats-in">
    <?php
    $rakamlar = array(
        array( 'Aynı gün', 'fiyat ve teslim planı' ),
        array( '1 adet', 'minimum sipariş yok' ),
        array( '11', 'ilçeye teslim ve montaj' ),
        array( '0 ₺', 'keşif ücreti' ),
    );
    foreach ( $rakamlar as $r ) : ?>
      <div class="stat">
        <b><?php echo esc_html( $r[0] ); ?></b>
        <span><?php echo esc_html( $r[1] ); ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="sec" id="urunler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ürünler</span>
      <h2>Ne lazımsa buradan alın</h2>
      <p>Kategoriye girin, modelleri ve teknik özellikleri orada göreceksiniz. Fiyatlar kapasite, adet ve montaj durumuna göre değiştiği için sabit liste yayınlamıyoruz — ihtiyacınızı yazın, aynı gün fiyat gönderelim.</p>
    </div>
    <div class="tip-grid tip-grid-4">
      <?php
      $kategoriler = array(
          array( 'yangin-tupu-dolumu',   'Yangın Söndürme Tüpü',   'Kuru kimyevi tozlu · CO₂ · köpüklü · araç', 'foto/6kg-kkt.jpg',        'tup',   'En çok satan' ),
          array( 'yangin-dolabi-hidrant','Yangın Dolabı',          'Bina içi · bina dışı · dekoratif',   'foto/dolap-bina-ici.jpg', 'dolap', '5 kategori' ),
          array( 'davlumbaz-sondurme',   'Davlumbaz Söndürme',     'Ticari mutfak · ocak hattı',         'foto/davlumbaz.jpg',      'ocak',  'Otomatik' ),
          array( 'pano-ici-sondurme',    'Pano İçi Söndürme',      'Elektrik panosu · sunucu kabini',    'foto/pano-ici.jpg',       'pano',  'Otomatik' ),
      );
      foreach ( $kategoriler as $k ) : ?>
        <a class="tip-kart" href="<?php echo esc_url( ty_url( $k[0] ) ); ?>">
          <span class="tip-kart-medya">
            <?php
            $kfoto = ty_gorsel( $k[3], $k[1], 'tip-kart-foto' );
            echo $kfoto ? $kfoto : '<span class="chip chip-buyuk">' . ty_ikon( $k[4] ) . '</span>';
            ?>
            <span class="tip-rozet"><?php echo esc_html( $k[5] ); ?></span>
          </span>
          <span class="tip-kart-alt">
            <h3><?php echo esc_html( $k[1] ); ?></h3>
            <span class="tip-kart-sinif"><?php echo esc_html( $k[2] ); ?></span>
            <span class="more">İncele &rarr;</span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if ( $one ) : ?>
<section class="sec sec-tint" id="one-cikan">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Öne çıkanlar</span>
      <h2>En çok satılan modeller</h2>
      <p>Sahada en çok istenen kalemler. Adedi yazın, aynı gün fiyat gönderelim.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( $one as $o ) { ty_urun_kart( $o ); } ?>
    </div>
    <div class="sec-alt">
      <p><strong>Listede olmayan bir ürün mü arıyorsunuz?</strong> Yangın güvenliği kaleminin tamamını tedarik ediyoruz. Ne aradığınızı yazın, bulup fiyatlayalım.</p>
      <a class="btn btn-primary" href="#teklif">Teklif iste</a>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec<?php echo $one ? '' : ' sec-tint'; ?>" id="hesapla">
  <div class="wrap hesap-serit">
    <div>
      <span class="eyebrow">Ne gerektiğini bilmiyorsanız</span>
      <h2>Yönetmeliğe göre ihtiyacınızı hesaplayalım</h2>
      <p>Yerinizin türünü, kaç m² olduğunu ve kat sayısını girin; hangi üründen kaç adet gerektiğini çıkaralım. İki dakika sürüyor, sonucu doğrudan teklif formuna gönderiyor.</p>
      <a class="btn btn-primary" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-serit"><?php echo ty_ikon( 'hesap' ); ?>İhtiyacını hesapla</a>
    </div>
    <div class="hesap-serit-yan">
      <span class="chip chip-buyuk"><?php echo ty_ikon( 'hesap' ); ?></span>
      <p class="mev-note">Dayanak: Binaların Yangından Korunması Hakkında Yönetmelik Madde 99 — düşük tehlikeli yerlerde her 500 m², orta ve yüksek tehlikeli yerlerde her 250 m² için en az bir adet 6 kg cihaz.</p>
    </div>
  </div>
</section>

<section class="sec sec-tint" id="sektorler">
  <div class="wrap">
    <div class="sec-head orta">
      <span class="eyebrow">Sektörler</span>
      <h2>Ne kadar ve hangi ürün gerektiğini biz çıkaralım</h2>
      <p>Tesisinizi söyleyin, alana ve yangın sınıfına göre listeyi hazırlayıp fiyatlayalım. Fazlasını satmıyoruz, eksik de bırakmıyoruz.</p>
    </div>
    <div class="grid-4">
      <?php foreach ( ty_sektorler() as $slug => $s ) : ?>
        <a class="card" href="<?php echo esc_url( ty_url( $slug ) ); ?>">
          <span class="chip"><?php echo ty_ikon( ty_sektor_ikon( $slug ) ); ?></span>
          <h3><?php echo esc_html( $s['ad'] ); ?></h3>
          <p><?php echo esc_html( $s['ozet'] ); ?></p>
          <span class="more">Detayları gör &rarr;</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="surec">
  <div class="wrap">
    <div class="sec-head orta surec-head">
      <span class="eyebrow">Nasıl ilerliyoruz</span>
      <h2>Telefondan montaja dört adım</h2>
      <p>Uzun süreç yok, evrak yok. Ne lazım olduğunu söylemeniz yeterli — gerisini biz yürütüyoruz.</p>
    </div>

    <div class="surec-hat">
      <?php
      $adimlar = array(
          array( '01', 'Söyleyin',       'Ne lazım olduğunu biliyorsanız doğrudan yazın. Bilmiyorsanız yerinizi anlatın.', '2 dakika' ),
          array( '02', 'Fiyat gelsin',   'Kalem kalem, adet ve birim fiyat görünür şekilde.',                               'Aynı gün' ),
          array( '03', 'Teslim, montaj', 'Ürünleri getirip yerine takıyoruz. Tek adet de olur, tesisin tamamı da.',          'Aynı hafta' ),
          array( '04', 'Takip bizde',    'Kontrol ve dolum zamanı gelince siz takip etmiyorsunuz, biz arıyoruz.',            'Yılda bir' ),
      );
      foreach ( $adimlar as $a ) : ?>
        <div class="surec-adim">
          <span class="surec-no"><?php echo esc_html( $a[0] ); ?></span>
          <h3><?php echo esc_html( $a[1] ); ?></h3>
          <p><?php echo esc_html( $a[2] ); ?></p>
          <span class="surec-sure"><?php echo ty_ikon( 'saat' ); ?><?php echo esc_html( $a[3] ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="surec-alt">
      <p>Keşif ücretsiz, montaj fiyata dahil.</p>
      <div class="surec-cta">
        <a class="btn btn-primary" href="#teklif">Teklif iste</a>
        <a class="btn btn-koyu" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-surec"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="sec sec-tint" id="bolge">
  <div class="wrap bolge-grid">
    <div>
      <span class="eyebrow">Hizmet bölgesi</span>
      <h2 style="font-size:clamp(1.8rem,3.2vw,2.5rem);margin-top:1rem">Tekirdağ'ın 11 ilçesine teslim ve montaj</h2>
      <p style="color:var(--ink-soft);margin-top:1.1rem;font-size:1.05rem">Çorlu, Çerkezköy ve Ergene hattına haftalık düzenli servis yapıyoruz. Diğer ilçelerde randevu ile aynı hafta içinde yerindeyiz.</p>
      <a class="btn btn-primary" href="#teklif" style="margin-top:1.8rem">Bulunduğunuz ilçe için fiyat alın</a>
    </div>
    <div class="ilce">
      <?php foreach ( ty_ilceler() as $slug => $i ) : ?>
        <a href="<?php echo esc_url( ty_url( $slug ) ); ?>"><?php echo esc_html( $i['ad'] ); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_template_part( 'parts/teklif', null, array(
    'baslik' => 'Ne lazım, kaç adet?',
    'metin'  => 'Ürünü ve adedi yazın, aynı gün fiyat gönderelim. Ne gerektiğinden emin değilseniz yerinizi anlatın — listeyi biz çıkaralım.',
) ); ?>

<?php get_footer(); ?>
