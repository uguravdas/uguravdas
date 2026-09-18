<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="page-hero">
  <div class="wrap">
    <span class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana sayfa</a></span>
    <h1><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
    <?php if ( get_the_archive_description() ) : ?>
      <p class="page-lead"><?php echo esc_html( wp_strip_all_tags( get_the_archive_description() ) ); ?></p>
    <?php endif; ?>
  </div>
</section>
<section class="sec">
  <div class="wrap">
    <?php if ( have_posts() ) : ?>
      <?php
      $ty_urun_arsiv = ( is_tax( 'ty_urun_grup' ) || 'ty_urun' === get_post_type() );
      echo $ty_urun_arsiv ? '<div class="grid-3">' : '<div class="yazi-grid">';
      while ( have_posts() ) : the_post();
        if ( $ty_urun_arsiv ) {
            ty_urun_kart( array(
                'ad'     => get_the_title(),
                'nerede' => get_post_meta( get_the_ID(), '_ty_nerede', true ),
                'foto'   => ty_urun_foto( get_the_ID(), 'large' ),
                'link'   => get_permalink(),
            ) );
        } else {
            ty_yazi_kart();
        }
      endwhile;
      echo '</div>';
      ?>

      <?php
      $ty_sayfalar = paginate_links( array(
          'type'      => 'array',
          'prev_text' => '&larr; Önceki',
          'next_text' => 'Sonraki &rarr;',
      ) );
      if ( $ty_sayfalar ) : ?>
        <nav class="sayfalama" aria-label="Sayfalar">
          <?php foreach ( $ty_sayfalar as $ty_b ) { echo wp_kses_post( $ty_b ); } ?>
        </nav>
      <?php endif; ?>

    <?php else : ?>
      <div class="sec-head orta">
        <h2>Burada henüz içerik yok</h2>
        <p>Aradığınızı bulamadıysanız arayın, telefonda halledelim.</p>
        <a class="btn btn-primary" href="<?php echo esc_attr( ty_tel_link() ); ?>"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part( 'parts/teklif' ); get_footer();
