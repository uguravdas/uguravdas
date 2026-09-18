<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="page-hero">
  <div class="wrap">
    <span class="crumb">404</span>
    <h1>Aradığınız sayfa bulunamadı</h1>
    <p class="page-lead">Bağlantı değişmiş ya da sayfa kaldırılmış olabilir. Aşağıdan devam edebilir veya doğrudan arayabilirsiniz.</p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana sayfaya dön</a>
      <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>"><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>
<section class="sec">
  <div class="wrap">
    <div class="sec-head"><span class="eyebrow">Hizmetler</span><h2>Belki bunlardan birini arıyordunuz</h2></div>
    <div class="grid-4">
      <?php foreach ( ty_hizmetler() as $slug => $h ) : ?>
        <a class="card" href="<?php echo esc_url( ty_url( $slug ) ); ?>">
          <h3><?php echo esc_html( $h['baslik'] ); ?></h3>
          <p><?php echo esc_html( $h['ozet'] ); ?></p>
          <span class="more">Detay &rarr;</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php get_footer();
