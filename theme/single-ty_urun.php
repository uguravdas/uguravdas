<?php
/** Tek ürün sayfası. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
$nerede = get_post_meta( get_the_ID(), '_ty_nerede', true );
$grup   = get_the_terms( get_the_ID(), 'ty_urun_grup' );
?>
<section class="page-hero">
  <div class="wrap">
    <span class="crumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana sayfa</a> /
      <a href="<?php echo esc_url( ty_url( 'urunler' ) ); ?>">Ürünler</a> /
      <?php echo esc_html( get_the_title() ); ?>
    </span>
    <h1><?php the_title(); ?></h1>
    <?php if ( $nerede ) : ?><p class="page-lead"><?php echo esc_html( $nerede ); ?></p><?php endif; ?>
    <div class="hero-cta">
      <a class="btn btn-primary" href="#teklif">Bu ürün için fiyat al</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-urun"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>

<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body">
      <?php
      // Öne çıkan görsel yoksa temadaki eşleşen fotoğrafa düşer.
      $ty_tek_foto = ty_urun_foto( get_the_ID(), 'large' );
      if ( $ty_tek_foto ) : ?>
        <figure class="urun-tek-foto">
          <img src="<?php echo esc_url( $ty_tek_foto ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="800" height="600" decoding="async">
        </figure>
      <?php endif; ?>
      <?php the_content(); ?>
      <?php if ( $grup && ! is_wp_error( $grup ) ) : ?>
        <p><strong>Grup:</strong> <?php echo esc_html( $grup[0]->name ); ?></p>
      <?php endif; ?>
    </div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>

<?php
$benzer = get_posts( array(
	'post_type' => 'ty_urun', 'posts_per_page' => 4, 'post__not_in' => array( get_the_ID() ),
	'orderby' => 'rand',
) );
if ( $benzer ) : ?>
<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head"><span class="eyebrow">Diğer ürünler</span><h2>Bunlar da ilginizi çekebilir</h2></div>
    <div class="grid-4">
      <?php foreach ( $benzer as $b ) {
          ty_urun_kart( array(
              'ad' => get_the_title( $b ), 'nerede' => get_post_meta( $b->ID, '_ty_nerede', true ),
              'foto' => ty_urun_foto( $b->ID, 'large' ), 'link' => get_permalink( $b ),
          ) );
      } ?>
    </div>
  </div>
</section>
<?php endif;
endwhile;
get_template_part( 'parts/teklif', null, array( 'baslik' => 'Bu ürün için fiyat alın', 'metin' => 'Adedi yazın, aynı gün fiyat gönderelim. Montaj gerekiyorsa onu da ekleyelim.' ) );
get_footer();
