<?php
/**
 * Template Name: Sektör sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$s   = ty_veri( 'sektor' );
$ad  = $s ? $s['ad'] : get_the_title();
$hiz = ty_hizmetler();
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb( array( 'ad' => 'Sektörler', 'url' => ty_url( 'sektorler' ) ) ); ?>
    <h1><?php echo esc_html( $ad ); ?> için yangın güvenliği</h1>
    <p class="page-lead"><?php echo $s ? esc_html( $s['ozet'] ) : esc_html( get_the_excerpt() ); ?></p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="#teklif">Ücretsiz keşif talep et</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-sektor"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>

<?php if ( $s && ! empty( $s['mevzuat'] ) ) : ?>
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Yasal durum</span>
      <h2><?php echo esc_html( $ad ); ?> için mevzuat ne diyor</h2>
      <p>Binaların Yangından Korunması Hakkında Yönetmelik ve ilgili TS standartları çerçevesinde, bu tesis türünde denetimde en çok sorulan başlıklar.</p>
    </div>
    <div class="mevz">
      <?php foreach ( $s['mevzuat'] as $m ) : ?>
        <div class="mevz-item">
          <span class="mevz-ikon"><?php echo ty_ikon( 'belge' ); ?></span>
          <div>
            <h3><?php echo esc_html( $m[0] ); ?></h3>
            <p><?php echo esc_html( $m[1] ); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="mev-note">Bu başlıklar genel bilgilendirme amaçlıdır; tesisinizin yapısına göre kapsam değişir. Keşifte hangi yükümlülüklerin sizde olduğunu tek tek çıkarıyoruz.</p>
  </div>
</section>
<?php endif; ?>

<?php if ( $s && ! empty( $s['riskler'] ) ) : ?>
<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head orta">
      <span class="eyebrow">Sahada gördüklerimiz</span>
      <h2>Bu tesislerde en sık karşılaştığımız riskler</h2>
    </div>
    <div class="grid-4">
      <?php foreach ( $s['riskler'] as $r ) : ?>
        <div class="card">
          <span class="chip chip-uyari"><?php echo ty_ikon( 'uyari' ); ?></span>
          <h3><?php echo esc_html( $r[0] ); ?></h3>
          <p><?php echo esc_html( $r[1] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( trim( get_the_content() ) ) : ?>
<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body"><?php the_content(); ?></div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>
<?php endif; ?>

<section class="sec<?php echo trim( get_the_content() ) ? ' sec-tint' : ''; ?>">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Hizmetler</span>
      <h2><?php echo esc_html( $ad ); ?> için kurduğumuz sistemler</h2>
      <p>Bu tesis türünde en çok ihtiyaç duyulan başlıklar. Hepsini aynı ekip yürütüyor, tek rapor teslim ediyoruz.</p>
    </div>
    <div class="grid-4">
      <?php
      $liste = ( $s && ! empty( $s['hizmetler'] ) ) ? $s['hizmetler'] : array_keys( $hiz );
      foreach ( $liste as $slug ) :
          if ( ! isset( $hiz[ $slug ] ) ) { continue; }
          $h = $hiz[ $slug ]; ?>
        <a class="card" href="<?php echo esc_url( ty_url( $slug ) ); ?>">
          <span class="chip"><?php echo ty_ikon( $h['ikon'] ); ?></span>
          <h3><?php echo esc_html( $h['baslik'] ); ?></h3>
          <p><?php echo esc_html( $h['ozet'] ); ?></p>
          <span class="more">Detayları gör &rarr;</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head orta">
      <span class="eyebrow">Nasıl ilerliyoruz</span>
      <h2>Keşiften periyodik takibe</h2>
    </div>
    <div class="adim">
      <?php
      $adimlar = array(
          array( '1', 'Keşif',           'Tesisinizi gezer, mevcut cihaz ve sistemleri sayar, eksikleri çıkarırız. Keşif ücretsizdir.' ),
          array( '2', 'Teklif',          'Kalem kalem, adet ve birim fiyat görünür şekilde. Aynı gün içinde elinizde olur.' ),
          array( '3', 'Uygulama',        'Montaj, dolum veya revizyonu işinizi aksatmayacak saatlerde yaparız.' ),
          array( '4', 'Periyodik takip', 'Her cihaz ve sistem kayda geçer. Bakım zamanı gelince biz arayıp hatırlatırız.' ),
      );
      foreach ( $adimlar as $a ) : ?>
        <div class="adim-item">
          <span class="adim-no"><?php echo esc_html( $a[0] ); ?></span>
          <h3><?php echo esc_html( $a[1] ); ?></h3>
          <p><?php echo esc_html( $a[2] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if ( $s && ! empty( $s['sss'] ) ) : ?>
<section class="sec sec-tint">
  <div class="wrap" style="max-width:900px">
    <div class="sec-head orta">
      <span class="eyebrow">Sık sorulanlar</span>
      <h2><?php echo esc_html( $ad ); ?> için merak edilenler</h2>
    </div>
    <div class="sss">
      <?php foreach ( $s['sss'] as $q ) : ?>
        <details>
          <summary><?php echo esc_html( $q[0] ); ?></summary>
          <div><p><?php echo esc_html( $q[1] ); ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endwhile;

get_template_part( 'parts/teklif', null, array(
    'baslik' => $ad . ' için keşif planlayalım',
    'metin'  => 'Tesisinizde kaç cihaz var, en son ne zaman kontrol edildi? Bu iki bilgiyi yazın, aynı gün keşif günü ve fiyat dönelim.',
) );

if ( $s && ! empty( $s['sss'] ) ) {
	$sema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
	foreach ( $s['sss'] as $q ) {
		$sema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $q[0],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $q[1] ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $sema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';
}

get_footer();
