<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$baslik = isset( $args['baslik'] ) ? $args['baslik'] : 'Neyiniz var, ne zaman kontrol edildi?';
$metin  = isset( $args['metin'] )  ? $args['metin']  : 'Bu iki bilgiyi yazmanız yeterli. Aynı gün içinde keşif günü ve fiyat dönüyoruz. Keşif ücretsizdir.';
?>
<section class="teklif" id="teklif">
  <div class="wrap teklif-grid">
    <div>
      <span class="eyebrow">Teklif al</span>
      <h2><?php echo esc_html( $baslik ); ?></h2>
      <p><?php echo esc_html( $metin ); ?></p>
      <div class="teklif-tel">
        <small>Telefonla daha hızlı</small>
        <a class="num" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-teklif"><?php echo esc_html( ty_tel() ); ?></a>
        <p><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?> · <?php echo esc_html( ty_op( 'ty_saat_cmt' ) ); ?></p>
      </div>
    </div>
    <?php ty_form(); ?>
  </div>
</section>
