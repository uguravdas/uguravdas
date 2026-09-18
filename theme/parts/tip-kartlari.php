<?php
/**
 * Bir gruba ait ürün tipi kartları — master sayfalarda kullanılır.
 * Fotoğraf ağırlıklı, sade kart.
 * $args['grup'] : 'tup' | 'dolap'
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$ty_grup  = isset( $args['grup'] ) ? $args['grup'] : 'tup';
$ty_liste = ty_tipler( $ty_grup );
if ( ! $ty_liste ) { return; }
?>
<div class="tip-grid">
  <?php foreach ( $ty_liste as $ty_s => $ty_t ) : ?>
    <a class="tip-kart" href="<?php echo esc_url( ty_url( $ty_s ) ); ?>">
      <span class="tip-kart-medya">
        <?php
        $ty_foto = ty_gorsel( $ty_t['gorsel'], $ty_t['ad'], 'tip-kart-foto' );
        echo $ty_foto ? $ty_foto : '<span class="chip chip-buyuk">' . ty_ikon( $ty_t['ikon'] ) . '</span>';
        ?>
        <?php if ( ! empty( $ty_t['rozet'] ) ) : ?>
          <span class="tip-rozet"><?php echo esc_html( $ty_t['rozet'] ); ?></span>
        <?php endif; ?>
      </span>
      <span class="tip-kart-alt">
        <h3><?php echo esc_html( $ty_t['ad'] ); ?></h3>
        <span class="tip-kart-sinif"><?php echo esc_html( $ty_t['sinif'] ); ?></span>
        <span class="more">İncele &rarr;</span>
      </span>
    </a>
  <?php endforeach; ?>
</div>
