<?php
/**
 * Template Name: Yangın dolabı satış sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$dolap_urunler = function_exists( 'ty_grup_urunleri' ) ? ty_grup_urunleri( 'dolap' ) : array();
?>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Yangın dolabı ve su hattı</span>
      <h1>Yangın dolabı satışı, <em>projeye uygun</em>.</h1>
      <p class="hero-lead">Bina içi, bina dışı, dekoratif, köpüklü ve malzeme dolapları. TS EN 671 uyumlu gövde ve iç aksam; hortum, lans, makara ve vanayı tek parça da satıyoruz.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#teklif">Fiyat al</a>
        <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-dolap"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
      </div>
      <div class="pills">
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>TS EN 671 uyumlu</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Montaj dahil</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Tek parça yedek satışı</span>
      </div>
    </div>

    <div class="tip-gorsel">
      <?php
      $dolap_foto = ty_gorsel( 'foto/yangin-dolabi.jpg', 'Yangın dolabı', 'tip-foto' );
      echo $dolap_foto ? $dolap_foto : '<span class="chip chip-buyuk">' . ty_ikon( 'dolap' ) . '</span>';
      ?>
      <div class="tip-secim">
        <span class="secim-baslik">Ne arıyorsunuz?</span>
        <div class="kap-secim">
          <?php foreach ( array( 'Sıva altı', 'Sıva üstü', 'Tüp bölmeli', 'Bina dışı', 'Dekoratif', 'Köpüklü' ) as $m ) : ?>
            <a href="#teklif" data-ty-kap="<?php echo esc_attr( $m ); ?>"><?php echo esc_html( $m ); ?></a>
          <?php endforeach; ?>
        </div>
        <p class="secim-alt">Emin değilseniz duvarın fotoğrafını gönderin, söyleyelim.</p>
      </div>
    </div>

  </div>
</section>

<section class="stats">
  <div class="wrap stats-in">
    <div class="stat"><b>671-1 &amp; 671-2</b><span>her iki standart</span></div>
    <div class="stat"><b>5 kategori</b><span>kullanım yerine göre</span></div>
    <div class="stat"><b>Tek parça</b><span>hortum · lans · vana</span></div>
    <div class="stat"><b>1 adet</b><span>minimum sipariş yok</span></div>
  </div>
</section>

<section class="sec" id="tipler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Dolap çeşitleri</span>
      <h2>Hangi dolabı almalısınız?</h2>
      <p>Seçimi dolabın duracağı yer ve tesisteki yangın yükü belirliyor. Kategoriye girin, teknik özellikleri ve modelleri orada göreceksiniz.</p>
    </div>
    <?php get_template_part( 'parts/tip-kartlari', null, array( 'grup' => 'dolap' ) ); ?>
  </div>
</section>

<?php if ( $dolap_urunler ) : ?>
<section class="sec sec-tint" id="urunler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ürünler</span>
      <h2>Satıştaki dolap ve ekipmanlar</h2>
      <p>Fiyatlar model, ölçü ve montaj durumuna göre değiştiği için sabit liste yayınlamıyoruz. İhtiyacınızı yazın ya da arayın, aynı gün fiyat gönderelim.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( $dolap_urunler as $du ) { ty_urun_kart( $du ); } ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec" id="karsilastirma">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Karşılaştırma</span>
      <h2>671-1 mi, 671-2 mi?</h2>
      <p>İkisi de yangın dolabı ama aynı işi yapmıyor. Aradaki farkı bilmeden alınan dolap, denetimde projeye uymadığı için geri çevrilebiliyor.</p>
    </div>
    <div class="mev-wrap">
      <table class="mev-table">
        <thead>
          <tr><th></th><th>TS EN 671-1</th><th>TS EN 671-2</th></tr>
        </thead>
        <tbody>
          <tr><th>Hortum</th><td>Yarı sert, makaralı</td><td>Yassı, katlanabilir</td></tr>
          <tr><th>Çap</th><td>25 mm</td><td>Azami 50 mm</td></tr>
          <tr><th>Uzunluk</th><td>Azami 30 m</td><td>Azami 20 m</td></tr>
          <tr><th>Debi</th><td>En az 100 lt/dk</td><td>En az 400 lt/dk</td></tr>
          <tr><th>Basınç</th><td colspan="2">En az 400 kPa (4 bar)</td></tr>
          <tr><th>Kullanıcı</th><td>Tek kişi</td><td>İki kişi önerilir</td></tr>
          <tr><th>Nerede</th><td>Ofis, otel, AVM, hastane, okul</td><td>Fabrika, üretim tesisi, depo</td></tr>
        </tbody>
      </table>
    </div>
    <p class="mev-note">Dayanak: Binaların Yangından Korunması Hakkında Yönetmelik Madde 94, TS EN 671-1 ve TS EN 671-2.</p>
  </div>
</section>

<section class="sec sec-tint" id="zorunluluk">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Yasal durum</span>
      <h2>Yangın dolabı hangi binalarda zorunlu?</h2>
      <p>Yönetmelik kapsamı net olarak sayıyor. Aşağıdakilerden birine giriyorsanız dolap zorunlu, girmiyorsanız isteğe bağlı.</p>
    </div>
    <div class="grid-4">
      <?php
      $zorunlu = array(
          array( 'bina',      'Yüksek binalar', 'Yapı yüksekliği 30,50 m\'yi geçen binalarda zorunlu.' ),
          array( 'fabrika',   '1.000 m² üstü', 'İmalathane, atölye, depo, konaklama, sağlık, toplanma ve eğitim binalarında toplam kapalı alan 1.000 m²\'yi geçiyorsa.' ),
          array( 'arac',      '600 m² üstü otopark', 'Toplam alanı 600 m²\'yi geçen kapalı otoparklarda zorunlu.' ),
          array( 'ocak',      '350 kW üstü kazan dairesi', 'Isıl kapasitesi 350 kW\'ın üzerindeki kazan dairelerinde zorunlu.' ),
      );
      foreach ( $zorunlu as $z ) : ?>
        <div class="card">
          <span class="chip"><?php echo ty_ikon( $z[0] ); ?></span>
          <h3><?php echo esc_html( $z[1] ); ?></h3>
          <p><?php echo esc_html( $z[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="sec-alt">
      <p><strong>Dolaplar arası mesafe en fazla 30 metre.</strong> Binada yağmurlama sistemi varsa bu mesafe 45 metreye çıkabiliyor. Kaç adet gerektiğini kat planından çıkarıyoruz.</p>
      <a class="btn btn-primary" href="#teklif">Projeme göre liste iste</a>
    </div>
  </div>
</section>

<section class="sec" id="ekipman">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ekipman ve yedek parça</span>
      <h2>Dolabın tamamını değiştirmeye gerek yok</h2>
      <p>Yıllık kontrolde çıkan eksikler genelde tek parça. Testten geçemeyen hortumu, kırılan lansı, sızdıran vanayı ayrı ayrı tedarik ediyoruz — komple değişimden belirgin şekilde ucuza geliyor.</p>
    </div>
    <div class="grid-3">
      <?php
      $ekipman = array(
          array( 'dolap', 'Hortum', '25 mm yarı sert ya da 50 mm yassı, 20–30 m. TS EN 671 belgeli.', 'foto/hortum-lans.jpg' ),
          array( 'dolap', 'Lans', 'Kapama-püskürtme-jet ayarlı, pirinç ya da ABS gövde.', 'foto/hortum-lans.jpg' ),
          array( 'dolap', 'Makara', 'Sabit ve döner modeller, standart dolap ölçülerine uyumlu.', 'foto/dolap-kopuklu.jpg' ),
          array( 'belge', 'Küresel vana', '1" ve 2" pirinç küresel vana. Sızdıran vana yıllık kontrolde en çok çıkan eksik.', 'foto/vana-rakor.jpg' ),
          array( 'belge', 'Rakor', 'Storz ve vidalı bağlantı elemanları.', 'foto/vana-rakor.jpg' ),
          array( 'belge', 'Dolap camı', 'Kırılabilir dolap camı, standart ölçülerde.', 'foto/dolap-bina-ici.jpg' ),
      );
      foreach ( $ekipman as $e ) :
        $efoto = isset( $e[3] ) ? ty_gorsel( $e[3], $e[1], 'card-foto-img' ) : ''; ?>
        <div class="card<?php echo $efoto ? ' card-foto' : ''; ?>">
          <?php if ( $efoto ) : ?>
            <span class="card-medya"><?php echo $efoto; ?></span>
          <?php else : ?>
            <span class="chip"><?php echo ty_ikon( $e[0] ); ?></span>
          <?php endif; ?>
          <h3><?php echo esc_html( $e[1] ); ?></h3>
          <p><?php echo esc_html( $e[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="sec-alt">
      <p><strong>Tek parça da satıyoruz, minimum sipariş yok.</strong> Ölçüyü söyleyin ya da mevcut dolabın fotoğrafını gönderin, uyanı bulalım.</p>
      <a class="btn btn-primary" href="#teklif">Yedek parça fiyatı iste</a>
    </div>
  </div>
</section>

<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Satın alırken</span>
      <h2>Dolapta fiyatı belirleyen üç şey</h2>
      <p>Aynı görünen iki dolabın fiyatı neden farklı olur, bakılması gerekenler şunlar.</p>
    </div>
    <div class="grid-3">
      <?php
      $dikkat = array(
          array( 'belge', 'Hortumun standardı', 'Hortum TS EN 671-1 ya da 671-2 belgeli olmalı. Belgesiz hortum beş yıllık basınç testinde patlar, ikinci kez para harcatır.' ),
          array( 'onay',  'Sac kalınlığı ve boya', 'Gövde DKP sac ve elektrostatik toz boyalı olmalı. İnce sac ve yaş boya, nemli ortamda bir iki yılda pas yapar.' ),
          array( 'saat',  'Armatür kalitesi', 'Küresel vana, rakor ve lansın pirinç olması gerekir. Plastik armatür ucuzdur ama basınç altında ilk kullanımda kırılır.' ),
      );
      foreach ( $dikkat as $d ) : ?>
        <div class="card">
          <span class="chip chip-safe"><?php echo ty_ikon( $d[0] ); ?></span>
          <h3><?php echo esc_html( $d[1] ); ?></h3>
          <p><?php echo esc_html( $d[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Satış sonrası</span>
      <h2>Kurduğumuz dolabın arkasında duruyoruz</h2>
      <p>Montaj, yıllık kontrol ve beş yılda bir gelen hortum basınç testi bizde. Zamanı geldiğinde siz takip etmiyorsunuz, biz arıyoruz.</p>
    </div>
    <div class="mev-wrap">
      <table class="mev-table">
        <thead><tr><th>Periyot</th><th>İşlem</th><th>Kim yapar</th></tr></thead>
        <tbody>
          <tr><td><span class="mev-rozet">Her ay</span></td><td>Göz kontrolü — dolabın önü açık mı, cam sağlam mı</td><td>Bina yangın ekibi</td></tr>
          <tr><td><span class="mev-rozet">Yılda 1</span></td><td>Hortum, lans, vana ve makara kontrolü, etiketleme</td><td>Biz</td></tr>
          <tr><td><span class="mev-rozet">5 yılda 1</span></td><td>Hortum basınç testi, geçemeyen hortumun değişimi</td><td>Biz</td></tr>
        </tbody>
      </table>
    </div>
    <p class="mev-note">Dayanak: TS EN 671-3 ve Binaların Yangından Korunması Hakkında Yönetmelik Madde 94.</p>
  </div>
</section>

<section class="sec sec-tint">
  <div class="wrap" style="max-width:900px">
    <div class="sec-head orta">
      <span class="eyebrow">Sık sorulanlar</span>
      <h2>Satın almadan önce</h2>
    </div>
    <div class="sss">
      <?php
      $sss = array(
          array( 'Binamda yangın dolabı zorunlu mu?', '<p>Yönetmelik şunları sayıyor: yüksek binalar, toplam kapalı alanı 1.000 m²\'yi geçen imalathane, atölye, depo, konaklama, sağlık, toplanma ve eğitim binaları, toplam alanı 600 m²\'yi geçen kapalı otoparklar ve ısıl kapasitesi 350 kW\'ın üzerindeki kazan daireleri. Bunların dışındaki yerlerde zorunlu değil.</p>' ),
          array( 'Kaç adet dolap gerekiyor?', '<p>Dolaplar arası mesafe 30 metreyi geçemiyor; yağmurlama sistemi varsa 45 metre. Kat planını gönderin, yerleşimi ve adedi çıkarıp fiyatlandıralım. Keşif ücretsiz.</p>' ),
          array( 'Sıva altı mı sıva üstü mü?', '<p>Duvarda yeterli derinlik varsa ve yeni yapı ise sıva altı daha derli toplu duruyor. Mevcut binada duvar kırmak istemiyorsanız sıva üstü takılır, işlevde fark yok.</p>' ),
          array( 'Sadece hortum ya da lans alabilir miyim?', '<p>Alabilirsiniz. Hortum, lans, makara, küresel vana, rakor ve dolap camını tek parça satıyoruz, minimum sipariş yok. Ölçüyü söyleyin ya da mevcut dolabın fotoğrafını gönderin.</p>' ),
          array( 'Montaj ve su hattı bağlantısı dahil mi?', '<p>Dolabın montajı fiyata dahil. Tesisat hattının çekilmesi ayrı bir iş; projesi varsa birlikte fiyatlandırıyoruz, yoksa keşifte konuşalım.</p>' ),
          array( 'Mevcut dolabımı yenileyebilir misiniz?', '<p>Çoğu zaman evet. Dolabın gövdesi sağlamsa hortumu, lansı, vanayı ve camını yenileyip standarda uygun hale getiriyoruz — komple değişimden belirgin şekilde ucuza geliyor.</p>' ),
      );
      foreach ( $sss as $s ) : ?>
        <details>
          <summary><?php echo esc_html( $s[0] ); ?></summary>
          <div><?php echo wp_kses_post( $s[1] ); ?></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
get_template_part( 'parts/teklif', null, array(
    'baslik' => 'Hangi dolap, kaç adet?',
    'metin'  => 'Modeli ve adedi yazın, aynı gün fiyat gönderelim. Ne gerektiğinden emin değilseniz kat planını ya da duvarın fotoğrafını gönderin — listeyi biz çıkaralım.',
) );

$sss_sema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
foreach ( $sss as $s ) {
	$sss_sema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $s[0],
		'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $s[1] ) ),
	);
}
echo '<script type="application/ld+json">' . wp_json_encode( $sss_sema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';

?>
<script>
(function(){
  var k = document.querySelectorAll('[data-ty-kap]');
  if(!k.length) return;
  for (var i=0;i<k.length;i++){
    k[i].addEventListener('click', function(){
      var a = document.querySelector('#teklif textarea');
      if (a) {
        a.value = 'Yangın dolabı — ' + this.getAttribute('data-ty-kap') + ', adet: ';
        setTimeout(function(){ a.focus(); }, 400);
      }
    });
  }
})();
</script>
<?php
get_footer();
