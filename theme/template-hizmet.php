<?php
/**
 * Template Name: Hizmet sayfası
 * Sayfanın kısa adı (slug) inc/data.php içindeki hizmet anahtarıyla aynı olmalı.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$h = ty_veri( 'hizmet' );
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb( array( 'ad' => 'Hizmetler', 'url' => ty_url( 'hizmetler' ) ) ); ?>
    <h1><?php echo $h ? esc_html( $h['baslik'] ) : get_the_title(); ?></h1>
    <p class="page-lead"><?php echo $h ? esc_html( $h['ozet'] ) : esc_html( get_the_excerpt() ); ?></p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="#teklif">Ücretsiz keşif talep et</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-hizmet"><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>

<?php if ( $h ) : ?>
<section class="sec" style="padding-bottom:0">
  <div class="wrap">
    <div class="sec-head"><span class="eyebrow">Kapsam</span><h2>Bu hizmet neleri içeriyor</h2></div>
    <div class="grid-3">
      <?php foreach ( $h['kalemler'] as $k ) : ?>
        <div class="card"><h3><?php echo esc_html( $k ); ?></h3></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body"><?php the_content(); ?></div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>

<?php endwhile;
get_template_part( 'parts/teklif' );
get_footer();
