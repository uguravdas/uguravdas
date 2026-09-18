<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$ty_kategoriler = array(
	'yangin-tupu-dolumu'    => 'Yangın söndürme tüpü',
	'yangin-dolabi-hidrant' => 'Yangın dolabı',
	'davlumbaz-sondurme'    => 'Davlumbaz söndürme',
	'pano-ici-sondurme'     => 'Pano içi söndürme',
);
?>
<aside class="aside">

  <div class="aside-card vurgu">
    <h3>Aynı gün fiyat</h3>
    <p>Ürünü ve adedi söyleyin, aynı gün fiyat gönderelim. Ne gerektiğinden emin değilseniz keşif ücretsiz.</p>
    <a class="aside-tel num" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-yan"><?php echo esc_html( ty_tel() ); ?></a>
    <p class="aside-saat"><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?></p>
    <div class="aside-cta">
      <a class="btn btn-primary btn-sm" href="#teklif">Teklif iste</a>
      <a class="btn btn-line btn-sm" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="wa-yan"><?php echo ty_ikon( 'whatsapp' ); ?>WhatsApp</a>
    </div>
  </div>

  <div class="aside-card">
    <h3>Ürünler</h3>
    <div class="aside-list">
      <?php foreach ( $ty_kategoriler as $ty_s => $ty_ad ) : ?>
        <a href="<?php echo esc_url( ty_url( $ty_s ) ); ?>"><?php echo esc_html( $ty_ad ); ?> <span>&rarr;</span></a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url( ty_url( 'urunler' ) ); ?>">Tüm ürünler <span>&rarr;</span></a>
    </div>
  </div>

  <a class="aside-card aside-hesap" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-yan">
    <span class="chip"><?php echo ty_ikon( 'hesap' ); ?></span>
    <h3>Ne gerektiğini bilmiyor musunuz?</h3>
    <p>Yerinizin türünü ve m²'sini girin, yönetmeliğe göre listeyi çıkaralım. İki dakika sürüyor.</p>
    <span class="more">İhtiyacını hesapla &rarr;</span>
  </a>

  <div class="aside-card">
    <h3>Hizmet bölgesi</h3>
    <div class="aside-list">
      <?php
      $ty_sayac = 0;
      foreach ( ty_ilceler() as $ty_s => $ty_i ) {
          if ( $ty_sayac++ >= 4 ) { break; }
          echo '<a href="' . esc_url( ty_url( $ty_s ) ) . '">' . esc_html( $ty_i['ad'] ) . ' <span>&rarr;</span></a>';
      }
      ?>
      <a href="<?php echo esc_url( ty_url( 'hizmet-bolgesi' ) ); ?>">Tüm ilçeler <span>&rarr;</span></a>
    </div>
  </div>

</aside>
