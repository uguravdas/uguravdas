<?php
/**
 * Fluent Forms kısa kodu tanımlanana kadar gösterilen yedek form.
 * Özelleştirici → İletişim Bilgileri → "Teklif formu kısa kodu" doldurulunca bu form devre dışı kalır.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$eposta = ty_op( 'ty_email' );
?>
<form class="form" action="mailto:<?php echo esc_attr( $eposta ); ?>" method="post" enctype="text/plain">
  <div class="row2">
    <div class="field">
      <label for="ty-ad">Ad soyad</label>
      <input id="ty-ad" name="ad" type="text" placeholder="Adınız" required>
    </div>
    <div class="field">
      <label for="ty-tel">Telefon</label>
      <input id="ty-tel" name="telefon" type="tel" placeholder="05XX XXX XX XX" required>
    </div>
  </div>
  <div class="row2">
    <div class="field">
      <label for="ty-ilce">İlçe</label>
      <select id="ty-ilce" name="ilce">
        <?php foreach ( ty_ilceler() as $i ) : ?>
          <option><?php echo esc_html( $i['ad'] ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="field">
      <label for="ty-tesis">Tesis türü</label>
      <select id="ty-tesis" name="tesis">
        <?php foreach ( ty_sektorler() as $s ) : ?>
          <option><?php echo esc_html( $s['ad'] ); ?></option>
        <?php endforeach; ?>
        <option>Diğer</option>
      </select>
    </div>
  </div>
  <div class="field">
    <label for="ty-konu">Neye ihtiyacınız var</label>
    <textarea id="ty-konu" name="konu" placeholder="Örn: Çorlu'da fabrika. 40 tüp ve 6 yangın dolabı var, son kontrol 2023. Panolara koruma da düşünüyoruz."></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Keşif ve teklif iste</button>
  <p class="form-note">Bilgileriniz yalnızca teklif için kullanılır, üçüncü kişilerle paylaşılmaz.</p>
</form>
