<?php
/**
 * Güvence bandı — "bu işi kim, nasıl yapıyor" sözü.
 * Maddeler sitenin başka yerlerinde zaten verilen sözlerdir; yeni iddia eklenmez.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$ty_sozler = array(
	array( 'Keşif ücretsiz',        'Yerinizi görmeden fiyat vermiyoruz.' ),
	array( 'Montaj fiyata dahil',   'Ürünü getirip yerine takıyoruz.' ),
	array( 'Kesinti yok',           'Dolum sırasında yerine ikame cihaz bırakıyoruz.' ),
	array( 'Takip bizde',           'Bakım zamanı gelince siz aramıyorsunuz, biz arıyoruz.' ),
);
?>
<section class="sec sec-tint">
  <div class="wrap guvence">
    <div class="guvence-ust">
      <div>
        <span class="eyebrow">Sözümüz</span>
        <h2 style="margin-top:1rem">Ne <span class="el-alti">söz veriyoruz</span></h2>
        <p class="tek-lead" style="margin-top:1rem;max-width:52ch">
          Aşağıdakiler reklam cümlesi değil, her işte uyduğumuz kurallar.
          Biri tutmazsa arayın, düzeltelim.
        </p>
      </div>
      <span class="damga" aria-hidden="true">
        <b>0 ₺</b>
        <span>Keşif<br>ücretsiz</span>
      </span>
    </div>

    <ul class="guvence-liste">
      <?php foreach ( $ty_sozler as $ty_s ) : ?>
        <li>
          <span class="guvence-isaret"><?php echo ty_ikon( 'onay' ); ?></span>
          <div>
            <b><?php echo esc_html( $ty_s[0] ); ?></b>
            <p><?php echo esc_html( $ty_s[1] ); ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php echo ty_imza(); // panelde ad girilmemişse hiç basılmaz ?>
  </div>
</section>
