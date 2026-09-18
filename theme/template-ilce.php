<?php
/**
 * Template Name: İlçe sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$i  = ty_veri( 'ilce' );
$ad = $i ? $i['ad'] : get_the_title();
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb( array( 'ad' => 'Hizmet bölgesi', 'url' => ty_url( 'hizmet-bolgesi' ) ) ); ?>
    <h1><?php echo esc_html( $ad ); ?>'da yangın tüpü ve yangın güvenliği ekipmanı</h1>
    <p class="page-lead"><?php echo $i ? esc_html( $i['not'] ) : esc_html( get_the_excerpt() ); ?></p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="#teklif"><?php echo esc_html( $ad ); ?> için fiyat al</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-ilce"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
    </div>
    <div class="pills">
      <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Aynı gün fiyat</span>
      <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Yerinde montaj</span>
      <span class="pill"><?php echo ty_ikon( 'onay' ); ?>Ücretsiz keşif</span>
    </div>
  </div>
</section>

<section class="stats">
  <div class="wrap stats-in">
    <div class="stat"><b>Aynı gün</b><span>fiyat ve teslim planı</span></div>
    <div class="stat"><b>1 adet</b><span>minimum sipariş yok</span></div>
    <div class="stat"><b><?php echo esc_html( $ad ); ?></b><span>yerinde teslim ve montaj</span></div>
    <div class="stat"><b>0 ₺</b><span>keşif ücreti</span></div>
  </div>
</section>

<section class="sec" id="urunler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Ürünler</span>
      <h2><?php echo esc_html( $ad ); ?>'a getirdiğimiz ürünler</h2>
      <p>Tek adet de satıyoruz, tesisin tamamını da donatıyoruz. Ürünü seçin ya da yerinizi anlatın — listeyi biz çıkaralım.</p>
    </div>
    <div class="grid-3">
      <?php
      $ilce_urun = array(
          array( 'tup',   'Yangın söndürme tüpü', 'Kuru kimyevi tozlu, karbondioksitli ve köpüklü. 1 kg\'dan 50 kg\'a tüm kapasiteler.', 'yangin-tupu-dolumu' ),
          array( 'dolap', 'Yangın dolabı ve hidrant', 'TS EN 671-1 ve 671-2 dolaplar, hortum, lans, makara ve vana.', 'yangin-dolabi-hidrant' ),
          array( 'arac',  'Araç yangın tüpü', 'Binek, ticari ve ağır vasıta için muayeneden geçen tüp ve sabitleme aparatı.', 'arac-yangin-tupu' ),
      );
      foreach ( $ilce_urun as $u ) : ?>
        <?php
        $ih   = ty_hizmetler();
        $ufoto = ! empty( $ih[ $u[3] ]['foto'] ) ? $ih[ $u[3] ]['foto'] : '';
        ?>
        <a class="card urun" href="<?php echo esc_url( ty_url( $u[3] ) ); ?>">
          <span class="urun-medya">
            <?php echo $ufoto ? ty_gorsel( $ufoto, $u[1] ) : '<span class="chip">' . ty_ikon( $u[0] ) . '</span>'; ?>
          </span>
          <h3><?php echo esc_html( $u[1] ); ?></h3>
          <p><?php echo esc_html( $u[2] ); ?></p>
          <span class="more">Ürünleri gör &rarr;</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-tint" id="hizmetler">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Hizmetler</span>
      <h2><?php echo esc_html( $ad ); ?>'da ne yapıyoruz</h2>
      <p>Satışın yanında montaj, yıllık kontrol ve dolum da bizde. Zamanı gelince siz takip etmiyorsunuz, biz arıyoruz.</p>
    </div>
    <div class="grid-3">
      <?php foreach ( ty_hizmetler() as $slug => $h ) : ?>
        <?php $hfoto = ! empty( $h['foto'] ) ? $h['foto'] : ''; ?>
        <a class="card<?php echo $hfoto ? ' card-foto' : ''; ?>" href="<?php echo esc_url( ty_url( $slug ) ); ?>">
          <?php if ( $hfoto ) : ?>
            <span class="card-medya"><?php echo ty_gorsel( $hfoto, $h['baslik'], 'card-foto-img' ); ?></span>
          <?php else : ?>
            <span class="chip"><?php echo ty_ikon( $h['ikon'] ); ?></span>
          <?php endif; ?>
          <span class="urun-yer"><?php echo esc_html( $h['etiket'] ); ?></span>
          <h3><?php echo esc_html( $h['baslik'] ); ?></h3>
          <p><?php echo esc_html( $h['ozet'] ); ?></p>
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
      <h2><?php echo esc_html( $ad ); ?>'a gelişimiz dört adım</h2>
      <p>Uzun süreç yok, evrak yok. Ne lazım olduğunu söylemeniz yeterli — gerisini biz yürütüyoruz.</p>
    </div>

    <div class="surec-hat">
      <?php
      $adimlar = array(
          array( '01', 'Söyleyin',       'Ne lazım olduğunu biliyorsanız doğrudan yazın. Bilmiyorsanız yerinizi anlatın.', '2 dakika' ),
          array( '02', 'Fiyat gelsin',   'Kalem kalem, adet ve birim fiyat görünür şekilde.',                               'Aynı gün' ),
          array( '03', 'Teslim, montaj', 'Ürünleri ' . $ad . '\'a getirip yerine takıyoruz. Tek adet de olur, tesisin tamamı da.',          'Aynı hafta' ),
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

<?php if ( trim( wp_strip_all_tags( get_the_content() ) ) ) : ?>
<section class="entry sec-tint">
  <div class="wrap entry-grid">
    <div class="entry-body"><?php the_content(); ?></div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>
<?php endif; ?>

<section class="sec">
  <div class="wrap">
    <div class="sec-head" style="margin-bottom:1.6rem">
      <span class="eyebrow">Diğer ilçeler</span>
      <h2>Tekirdağ genelinde hizmet veriyoruz</h2>
    </div>
    <div class="ilce">
      <?php foreach ( ty_ilceler() as $slug => $x ) : ?>
        <a href="<?php echo esc_url( ty_url( $slug ) ); ?>"><?php echo esc_html( $x['ad'] ); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php endwhile;

get_template_part( 'parts/teklif', null, array(
    'baslik' => $ad . ' için ne lazım?',
    'metin'  => 'Ürünü ve adedi yazın, aynı gün fiyat gönderelim. Ne gerektiğinden emin değilseniz yerinizi anlatın — listeyi biz çıkaralım. Keşif ücretsiz.',
) );

$sema = array(
	'@context' => 'https://schema.org',
	'@type'    => 'Service',
	'name'     => $ad . ' yangın güvenliği ekipmanları ve hizmetleri',
	'provider' => array( '@type' => 'LocalBusiness', 'name' => ty_op( 'ty_unvan' ), 'telephone' => ty_op( 'ty_tel_raw' ) ),
	'areaServed' => array( '@type' => 'City', 'name' => $ad ),
);
echo '<script type="application/ld+json">' . wp_json_encode( $sema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';

get_footer();
