<?php
/**
 * Varsayılan sayfa şablonu.
 * Kısa adı bir ürün tipiyle (tüp ya da dolap) eşleşiyorsa zengin ürün sayfası çıkar.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

while ( have_posts() ) : the_post();

$ty_slug = get_post_field( 'post_name', get_the_ID() );
$ty_tip  = function_exists( 'ty_urun_tipi' ) ? ty_urun_tipi( $ty_slug ) : null;

if ( $ty_tip ) :
	$ty_urunler   = function_exists( 'ty_tip_urunleri' ) ? ty_tip_urunleri( $ty_slug ) : array();
	$ty_kardesler = ty_tip_kardesler( $ty_slug );
	$ty_master    = ty_tip_master( $ty_tip['grup'] );
	$ty_dolap     = ( 'dolap' === $ty_tip['grup'] );
	$ty_secim_bas = $ty_dolap ? 'Hangi montaj tipi?' : 'Kaç kg lazım?';
	?>

<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <?php ty_crumb( array( 'ad' => $ty_master['ad'], 'url' => ty_url( $ty_master['slug'] ) ) ); ?>
      <?php if ( ! empty( $ty_tip['rozet'] ) ) : ?>
        <span class="eyebrow"><?php echo esc_html( $ty_tip['rozet'] ); ?></span>
      <?php endif; ?>
      <h1><?php echo esc_html( $ty_tip['ad'] ); ?></h1>
      <p class="hero-lead"><?php echo esc_html( $ty_tip['ozet'] ); ?></p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="#teklif">Fiyat al</a>
        <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-tip"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
      </div>
      <div class="pills">
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?><?php echo esc_html( $ty_tip['sinif'] ); ?></span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Montaj dahil</span>
        <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Tek adet de satılır</span>
      </div>
    </div>

    <div class="tip-gorsel">
      <?php
      $ty_foto = ty_gorsel( $ty_tip['gorsel'], $ty_tip['ad'], 'tip-foto' );
      echo $ty_foto ? $ty_foto : '<span class="chip chip-buyuk">' . ty_ikon( $ty_tip['ikon'] ) . '</span>';
      ?>
      <div class="tip-secim">
        <span class="secim-baslik"><?php echo esc_html( $ty_secim_bas ); ?></span>
        <div class="kap-secim">
          <?php foreach ( $ty_tip['kap'] as $ty_k ) : ?>
            <a href="#teklif" data-ty-kap="<?php echo esc_attr( $ty_k ); ?>"><?php echo esc_html( $ty_k ); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec" id="teknik">
  <div class="wrap tek-grid">
    <div>
      <span class="eyebrow">Teknik özellikler</span>
      <h2><?php echo esc_html( $ty_tip['kisa'] ); ?></h2>
      <p class="tek-lead"><?php echo esc_html( $ty_tip['uzun'] ); ?></p>
      <ul class="arti">
        <?php foreach ( $ty_tip['artilar'] as $ty_a ) : ?>
          <li><?php echo ty_ikon( 'onay' ); ?><span><?php echo esc_html( $ty_a ); ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="tek-tablo">
      <table>
        <tbody>
          <?php foreach ( $ty_tip['teknik'] as $ty_t ) : ?>
            <tr><th><?php echo esc_html( $ty_t[0] ); ?></th><td><?php echo esc_html( $ty_t[1] ); ?></td></tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <p class="tek-not">Değerler ilgili standardın genel şartlarıdır. Sipariş öncesi ürünün etiketindeki değerleri birlikte teyit ediyoruz.</p>
    </div>
  </div>
</section>

<?php if ( ! empty( $ty_tip['siniflar'] ) ) : ?>
<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Yangın sınıfları</span>
      <h2>Hangi yangında işe yarıyor</h2>
      <p>Yanlış tüp yangını söndürmez, bazı durumlarda büyütür. Bu tip şu sınıflarda etkili:</p>
    </div>
    <div class="sinif-grid">
      <?php foreach ( $ty_tip['siniflar'] as $ty_c ) : ?>
        <div class="sinif-kart">
          <span class="sinif-harf"><?php echo esc_html( $ty_c[0] ); ?></span>
          <h3><?php echo esc_html( $ty_c[1] ); ?></h3>
          <p><?php echo esc_html( $ty_c[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( $ty_urunler ) : ?>
<section class="sec" id="urunler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ürünler</span>
      <h2><?php echo esc_html( $ty_tip['kisa'] ); ?> modelleri</h2>
      <p>Fiyatlar kapasite, adet ve montaj durumuna göre değiştiği için sabit liste yayınlamıyoruz. İhtiyacınızı yazın ya da arayın, aynı gün fiyat gönderelim.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( $ty_urunler as $ty_u ) { ty_urun_kart( $ty_u ); } ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec<?php echo $ty_urunler ? ' sec-tint' : ''; ?>">
  <div class="wrap uyari-grid">
    <div class="uyari-kutu">
      <span class="chip chip-uyari"><?php echo ty_ikon( 'uyari' ); ?></span>
      <h3>Neye dikkat etmek lazım</h3>
      <p><?php echo esc_html( $ty_tip['dikkat'] ); ?></p>
    </div>
    <div class="uyari-kutu">
      <span class="chip"><?php echo ty_ikon( 'harita' ); ?></span>
      <h3>Nerede kullanılır</h3>
      <p><?php echo esc_html( $ty_tip['nerede'] ); ?></p>
      <a class="more" href="#teklif">Yeriniz için liste çıkaralım &rarr;</a>
    </div>
  </div>
</section>

<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) ) : ?>
<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body"><?php the_content(); ?></div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>
<?php endif; ?>

<?php if ( $ty_kardesler ) : ?>
<section class="sec">
  <div class="wrap">
    <div class="sec-head orta">
      <span class="eyebrow">Diğer seçenekler</span>
      <h2>Aradığınız bu değilse</h2>
      <p>Hangisinin gerektiğinden emin değilseniz arayın, iki soruyla netleştirelim.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( $ty_kardesler as $ty_s => $ty_d ) : ?>
        <a class="card urun" href="<?php echo esc_url( ty_url( $ty_s ) ); ?>">
          <span class="urun-medya"><?php echo ty_gorsel( $ty_d['gorsel'], $ty_d['ad'] ) ?: ty_ikon( $ty_d['ikon'] ); ?></span>
          <h3><?php echo esc_html( $ty_d['ad'] ); ?></h3>
          <span class="urun-yer"><?php echo esc_html( $ty_d['sinif'] ); ?></span>
          <p><?php echo esc_html( $ty_d['ozet'] ); ?></p>
          <span class="more">İncele &rarr;</span>
        </a>
      <?php endforeach; ?>
      <a class="card urun kart-hesap" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>">
        <span class="chip"><?php echo ty_ikon( 'hesap' ); ?></span>
        <h3>Ne gerektiğini bilmiyorum</h3>
        <span class="urun-yer">Yönetmeliğe göre hesapla</span>
        <p>Yerinizin türünü, m²'sini ve kat sayısını girin; hangi üründen kaç adet gerektiğini çıkaralım.</p>
        <span class="more">Hesapla &rarr;</span>
      </a>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Sık sorulanlar</span>
      <h2><?php echo esc_html( $ty_tip['kisa'] ); ?> hakkında</h2>
    </div>
    <div class="sss">
      <?php foreach ( $ty_tip['sss'] as $ty_q ) : ?>
        <details>
          <summary><?php echo esc_html( $ty_q[0] ); ?></summary>
          <p><?php echo esc_html( $ty_q[1] ); ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script type="application/ld+json"><?php
$ty_ld = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
foreach ( $ty_tip['sss'] as $ty_q ) {
	$ty_ld['mainEntity'][] = array(
		'@type' => 'Question', 'name' => $ty_q[0],
		'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $ty_q[1] ),
	);
}
echo wp_json_encode( $ty_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?></script>

<script>
(function(){
  var k = document.querySelectorAll('[data-ty-kap]');
  if(!k.length) return;
  var ad = <?php echo wp_json_encode( $ty_tip['kisa'] ); ?>;
  for (var i=0;i<k.length;i++){
    k[i].addEventListener('click', function(){
      var a = document.querySelector('#teklif textarea');
      if (a) {
        a.value = ad + ' — ' + this.getAttribute('data-ty-kap') + ', adet: ';
        setTimeout(function(){ a.focus(); }, 400);
      }
    });
  }
})();
</script>

<?php else : ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?>
      <p class="page-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
    <?php endif; ?>
  </div>
</section>

<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body"><?php the_content(); ?></div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>

<?php endif;

endwhile;

if ( $ty_tip ) {
	get_template_part( 'parts/teklif', null, array(
		'baslik' => 'Hangi üründen kaç adet?',
		'metin'  => 'Modeli ve adedi yazın, aynı gün fiyat gönderelim. Emin değilseniz yerinizi anlatın — listeyi biz çıkaralım.',
	) );
} else {
	get_template_part( 'parts/teklif' );
}
get_footer();
