<?php
/**
 * Template Name: Yangın tüpü satış sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$tipler    = ty_tup_tipleri();
$kapasite  = ty_tup_kapasite();
?>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Yangın söndürme tüpü</span>
      <h1>Yangın tüpü satışı, <em>Tekirdağ'dan aynı gün</em>.</h1>
      <p class="hero-lead">Kuru kimyevi tozlu, karbondioksitli, köpüklü ve araç tüpleri. 1 kg'dan 50 kg'a kadar tüm kapasiteler. Tek adet de satarız, tesisin tamamını da donatırız — montaj dahil.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#urunler">Ürünleri gör</a>
        <a class="btn btn-line" href="#kapasite">Kapasite seç</a>
      </div>
      <div class="pills">
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>TSE belgeli gövde ve dolum</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Montaj ve aparat dahil</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Toplu alımda özel fiyat</span>
      </div>
    </div>

    <div class="hero-iletisim">
      <span class="eyebrow">Aynı gün fiyat</span>
      <h2>Arayın, konuşarak halledelim</h2>
      <p>Ne lazım olduğunu biliyorsanız bir telefon yeter. Bilmiyorsanız yerinizi anlatın, listeyi biz çıkaralım.</p>
      <a class="hero-tel" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-tup"><?php echo ty_ikon( 'telefon' ); ?><span><?php echo esc_html( ty_tel() ); ?></span></a>
      <div class="hero-il-cta">
        <a class="btn btn-primary btn-sm" href="#teklif">Teklif formu</a>
        <a class="btn btn-line btn-sm" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="wa-tup"><?php echo ty_ikon( 'whatsapp' ); ?>WhatsApp</a>
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
    <div class="stat"><b>1&nbsp;–&nbsp;50 kg</b><span>tüm kapasiteler</span></div>
    <div class="stat"><b>4 tip</b><span>KKT · CO₂ · köpüklü · araç</span></div>
    <div class="stat"><b>Aynı gün</b><span>fiyat ve teslim planı</span></div>
    <div class="stat"><b>1 adet</b><span>minimum sipariş yok</span></div>
  </div>
</section>

<section class="sec" id="tipler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Tüp çeşitleri</span>
      <h2>Hangi tüpü satın almalısınız?</h2>
      <p>Yangının cinsi hangi tüpü alacağınızı belirler. Yanlış tüp yangını söndürmez, bazı durumlarda büyütür. Dört tip satıyoruz — detay için kartlara girin.</p>
    </div>
    <?php get_template_part( 'parts/tip-kartlari', null, array( 'grup' => 'tup' ) ); ?>
  </div>
</section>

<?php $tup_urunler = function_exists( 'ty_grup_urunleri' ) ? ty_grup_urunleri( 'tup' ) : array(); ?>
<?php if ( $tup_urunler ) : ?>
<section class="sec sec-tint" id="urunler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ürünler</span>
      <h2>Satıştaki tüp modelleri</h2>
      <p>Fiyatlar kapasite, adet ve montaj durumuna göre değiştiği için sabit liste yayınlamıyoruz. İhtiyacınızı yazın ya da arayın, aynı gün fiyat gönderelim.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( $tup_urunler as $tu ) { ty_urun_kart( $tu ); } ?>
    </div>
    <div class="sec-alt">
      <p><strong>Listede olmayan bir kapasite mi arıyorsunuz?</strong> 1 kg'dan 50 kg'a kadar tüm boylar tedarik ediliyor.</p>
      <a class="btn btn-primary" href="#teklif">Teklif iste</a>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec sec-tint" id="kapasite">
  <div class="wrap kap-grid">
    <div class="kap-foto">
      <?php
      $kap_foto = ty_gorsel( 'foto/6kg-kkt.jpg', 'Yangın söndürme tüpü kapasiteleri', 'tip-foto' );
      echo $kap_foto ? $kap_foto : '<span class="chip chip-buyuk">' . ty_ikon( 'tup' ) . '</span>';
      ?>
    </div>
    <div>
      <span class="eyebrow">Kapasite seçimi</span>
      <h2>Kaç kg lazım?</h2>
      <p class="tek-lead">Kapasite seçimi korunacak alanın büyüklüğüne göre yapılır. Boyu seçin, teklif formuna yazılsın — emin değilseniz alttaki tabloya bakın ya da arayın.</p>
      <div class="secim-grid">
        <?php foreach ( array( '1 kg', '2 kg', '6 kg', '12 kg', '25 kg', '50 kg' ) as $k ) : ?>
          <a class="secim-kutu" href="#teklif" data-ty-kap="<?php echo esc_attr( $k ); ?>">
            <b><?php echo esc_html( $k ); ?></b>
            <span>Fiyat al</span>
          </a>
        <?php endforeach; ?>
      </div>
      <p class="secim-not">Hangi boyun size uygun olduğundan emin değilseniz arayın, alanınıza göre söyleyelim.</p>
    </div>
  </div>
</section>

<section class="sec" id="kapasite-tablo">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Kapasite rehberi</span>
      <h2>Hangi boy nerede kullanılır</h2>
      <p>Aşağıdaki tablo pratikte en çok tercih edilen eşleşmeleri gösteriyor.</p>
    </div>
    <div class="mev-wrap">
      <table class="mev-table kap-table">
        <thead>
          <tr><th>Kapasite</th><th>Nerede kullanılır</th><th>Not</th><th></th></tr>
        </thead>
        <tbody>
          <?php foreach ( $kapasite as $k ) : ?>
            <tr>
              <td><span class="mev-rozet"><?php echo esc_html( $k[0] ); ?></span></td>
              <td><?php echo esc_html( $k[1] ); ?></td>
              <td><?php echo esc_html( $k[2] ); ?></td>
              <td class="sag"><a class="btn btn-line btn-sm" href="#teklif" data-ty-kap="<?php echo esc_attr( $k[0] ); ?>">Fiyat al</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head orta">
      <span class="eyebrow">Toplu alım</span>
      <h2>Tesisin tamamını donatıyor musunuz?</h2>
      <p>Kaç adet gerektiğini bilmenize gerek yok. Alanı ve kullanım amacını söyleyin, yangın sınıfına göre listeyi biz çıkaralım — adet, kapasite ve yerleşim önerisiyle birlikte fiyatlandıralım.</p>
    </div>
    <div class="grid-4">
      <?php
      $toplu = array(
          array( 'fabrika', 'Fabrika ve OSB', 'Yüzlerce cihazlık listeyi kat planı üzerinden çıkarıyoruz.', 'foto/pano-ici.jpg' ),
          array( 'bina',    'Site ve apartman', 'Blok blok fiyat, tek seferde alımda birim maliyet düşüyor.', 'foto/dolap-bina-ici.jpg' ),
          array( 'restoran','Restoran ve otel', 'Mutfakta CO₂, salonda KKT — hattı doğru kuruyoruz.', 'foto/davlumbaz.jpg' ),
          array( 'arac',    'Filo araçları',    'Araç sayısına göre toplu tüp ve sabitleme aparatı.', 'foto/arac-tupu.jpg' ),
      );
      foreach ( $toplu as $t ) :
        $tfoto = isset( $t[3] ) ? ty_gorsel( $t[3], $t[1], 'card-foto-img' ) : ''; ?>
        <div class="card<?php echo $tfoto ? ' card-foto' : ''; ?>">
          <?php if ( $tfoto ) : ?>
            <span class="card-medya"><?php echo $tfoto; ?></span>
          <?php else : ?>
            <span class="chip"><?php echo ty_ikon( $t[0] ); ?></span>
          <?php endif; ?>
          <h3><?php echo esc_html( $t[1] ); ?></h3>
          <p><?php echo esc_html( $t[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="sec-alt">
      <p><strong>Adet arttıkça birim fiyat düşüyor.</strong> 20 adet üzeri alımlarda özel fiyat veriyoruz; montaj ve etiketleme fiyata dahil.</p>
      <a class="btn btn-primary" href="#teklif">Toplu alım fiyatı iste</a>
    </div>
  </div>
</section>

<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Satın alırken</span>
      <h2>Ucuz tüp diye bir şey yok, uygun tüp var</h2>
      <p>Fiyat karşılaştırırken bakılması gereken üç şey var. Bunlar tutmuyorsa aradaki fark size ucuza gelmez.</p>
    </div>
    <div class="grid-3">
      <?php
      $dikkat = array(
          array( 'belge', 'Gövde belgesi', 'Cihazın TS 862-EN 3 belgeli olması gerekir. Belgesiz gövde denetimde kabul edilmez, sigortada da sorun çıkarır.' ),
          array( 'onay',  'Dolum yeterliliği', 'Dolumu yapan firmanın yeterlilik belgesi olmalı. İstediğinizde belgeyi göstermek zorundadır — biz de gösteriyoruz.' ),
          array( 'saat',  'Etiket ve kayıt', 'Her cihazın üzerinde dolum tarihi ve sonraki kontrol tarihi yazan etiket bulunmalı. Etiketsiz cihaz denetimde yok sayılır.' ),
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
      <h2>Aldığınız tüpün arkasında duruyoruz</h2>
      <p>Cihazın montajı, yıllık kontrolü ve dört yılda bir gelen dolumu bizde. Zamanı geldiğinde siz takip etmiyorsunuz, biz arıyoruz.</p>
    </div>
    <div class="mev-wrap">
      <table class="mev-table">
        <thead><tr><th>Periyot</th><th>İşlem</th><th>Kim yapar</th></tr></thead>
        <tbody>
          <tr><td><span class="mev-rozet">Her ay</span></td><td>Göz kontrolü — manometre yeşil bölgede mi</td><td>Bina yangın ekibi</td></tr>
          <tr><td><span class="mev-rozet">Yılda 1</span></td><td>Yerinde genel kontrol, tartım ve etiketleme</td><td>Biz</td></tr>
          <tr><td><span class="mev-rozet">4 yılda 1</span></td><td>Dolum ve hidrostatik test</td><td>Biz</td></tr>
        </tbody>
      </table>
    </div>
    <p class="mev-note">Dayanak: Binaların Yangından Korunması Hakkında Yönetmelik Madde 99 ve TS ISO 11602-2.</p>
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
          array( 'Fiyat neye göre değişiyor?', '<p>Kapasite, tüp tipi ve adet. Bir de montaj gerekip gerekmediği. 20 adet üzeri alımlarda birim fiyat belirgin şekilde düşüyor. İhtiyacınızı yazın, aynı gün net fiyat gönderelim.</p>' ),
          array( 'Kaç adet gerektiğini bilmiyorum.', '<p>Sorun değil, hesaplaması bizde. Alanın metrekaresini ve ne iş yapıldığını söyleyin; yangın sınıfına göre adet, kapasite ve yerleşim önerisini çıkarıp teklifle birlikte gönderiyoruz. Keşif ücretsiz.</p>' ),
          array( 'Montaj dahil mi?', '<p>Evet. Duvar aparatı, montaj ve yönlendirme levhası fiyata dahil. Cihazı getirip yerine takıyoruz, kutusunu bırakıp gitmiyoruz.</p>' ),
          array( 'Ne kadar sürede teslim edilir?', '<p>Tekirdağ merkez ve Çorlu hattında genelde aynı gün, diğer ilçelerde aynı hafta içinde. Büyük adetli siparişlerde tarihi teklifte netleştiriyoruz.</p>' ),
          array( 'Fatura ve belge veriyor musunuz?', '<p>Evet. Fatura, cihaz gövde belgeleri ve dolum yeterlilik belgemiz talep ettiğinizde paylaşılır. Her cihaz etiketli teslim edilir.</p>' ),
          array( 'Elimdeki eski tüpleri ne yapacağım?', '<p>Kullanılabilir durumdaysa dolumunu yapıp geri veriyoruz — yenisini almanıza gerek kalmaz. Gövdesi ömrünü doldurmuşsa söyleriz, yenisiyle değişimde eski cihazı biz alıyoruz.</p>' ),
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
    'baslik' => 'Hangi tüp, kaç adet?',
    'metin'  => 'Kapasiteyi ve adedi yazın, aynı gün fiyat gönderelim. Ne gerektiğinden emin değilseniz alanınızı anlatın — listeyi biz çıkaralım.',
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
        a.value = 'Yangın söndürme tüpü — ' + this.getAttribute('data-ty-kap') + ', adet: ';
        setTimeout(function(){ a.focus(); }, 400);
      }
    });
  }
})();
</script>
<?php
get_footer();
