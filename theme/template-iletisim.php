<?php
/**
 * Template Name: İletişim sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?><p class="page-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="grid-3">
      <a class="card" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-iletisim">
        <span class="chip"><?php echo ty_ikon( 'telefon' ); ?></span>
        <h3>Telefon</h3>
        <p class="num" style="font-size:1.1rem;color:var(--ink);font-weight:600"><?php echo esc_html( ty_tel() ); ?></p>
        <span class="urun-yer"><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?></span>
      </a>
      <a class="card" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="whatsapp-iletisim">
        <span class="chip chip-safe"><?php echo ty_ikon( 'whatsapp' ); ?></span>
        <h3>WhatsApp</h3>
        <p>Fotoğraf gönderin, ne gerektiğini söyleyelim.</p>
        <span class="more">Mesaj gönder &rarr;</span>
      </a>
      <a class="card" href="mailto:<?php echo esc_attr( ty_op( 'ty_email' ) ); ?>">
        <span class="chip"><?php echo ty_ikon( 'belge' ); ?></span>
        <h3>E-posta</h3>
        <p><?php echo esc_html( ty_op( 'ty_email' ) ); ?></p>
        <span class="urun-yer">Teklif ve fatura yazışmaları</span>
      </a>
    </div>

    <?php if ( trim( get_the_content() ) ) : ?>
      <div class="entry-body" style="max-width:70ch;margin-top:48px"><?php the_content(); ?></div>
    <?php endif; ?>
  </div>
</section>

<?php endwhile;
get_template_part( 'parts/teklif' );
get_footer();
