<?php
/**
 * Template Name: Ürünler sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$gruplar = ty_urun_gruplari();
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?><p class="page-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
    <div class="hero-cta">
      <a class="btn btn-primary" href="#teklif">Fiyat al</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-urunler"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>

<?php if ( trim( get_the_content() ) ) : ?>
<section class="sec" style="padding-bottom:0">
  <div class="wrap" style="max-width:70ch"><div class="entry-body"><?php the_content(); ?></div></div>
</section>
<?php endif; ?>

<section class="sec" id="urunler">
  <div class="wrap">
    <?php foreach ( $gruplar as $i => $g ) : ?>
      <div class="vitrin<?php echo $i ? ' vitrin-ara' : ''; ?>">
        <div class="vitrin-ust">
          <div>
            <h3><?php echo esc_html( $g['ad'] ); ?></h3>
            <?php if ( ! empty( $g['ozet'] ) ) : ?><p><?php echo esc_html( $g['ozet'] ); ?></p><?php endif; ?>
          </div>
        </div>
        <div class="grid-3">
          <?php foreach ( $g['urunler'] as $u ) { ty_urun_kart( $u ); } ?>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="sec-alt">
      <p><strong>Listede olmayan bir ürün mü arıyorsunuz?</strong> Yangın güvenliği kaleminin tamamını tedarik ediyoruz.</p>
      <a class="btn btn-primary" href="#teklif">Teklif iste</a>
    </div>
  </div>
</section>

<?php endwhile;
get_template_part( 'parts/teklif', null, array( 'baslik' => 'Ne lazım, kaç adet?', 'metin' => 'Ürünü ve adedi yazın, aynı gün fiyat gönderelim.' ) );
get_footer();
