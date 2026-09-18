<?php
/**
 * Tekirdağ Yangın teması.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'TY_VER', '5.0.1' );

require_once get_theme_file_path( 'inc/data.php' );
require_once get_theme_file_path( 'inc/tipler.php' );
require_once get_theme_file_path( 'inc/customizer.php' );
require_once get_theme_file_path( 'inc/admin.php' );
require_once get_theme_file_path( 'inc/urunler.php' );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 220, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );

	// Üst menü tema tarafından kuruluyor (header.php + inc/tipler.php), konum kaydı yok.
	register_nav_menus( array(
		'footer_hizmetler' => 'Altbilgi — Hizmetler',
		'footer_kurumsal'  => 'Altbilgi — Kurumsal',
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'ty-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap',
		array(),
		null
	);

	$app = get_theme_file_path( 'assets/css/app.css' );
	wp_enqueue_style(
		'ty-app',
		get_theme_file_uri( 'assets/css/app.css' ),
		array( 'ty-fonts' ),
		file_exists( $app ) ? filemtime( $app ) : TY_VER
	);

	// Tema kök style.css'i sadece tema başlığı için var, yüklemeye gerek yok.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

/* Menüyü aç/kapa — küçük ve satır içi, ayrı istek yok. */
add_action( 'wp_footer', function () { ?>
<script>
(function(){
  var b=document.querySelector('.menu-toggle'),n=document.getElementById('ty-nav');
  if(b&&n){
    b.addEventListener('click',function(){
      var o=n.classList.toggle('is-open');
      b.setAttribute('aria-expanded',o?'true':'false');
      if(!o){n.querySelectorAll('.acik').forEach(function(x){x.classList.remove('acik');});}
    });
  }
  /* mobilde alt menü aç/kapa */
  var ust=document.querySelectorAll('#ty-nav .menu-item-has-children > a');
  ust.forEach(function(a){
    a.addEventListener('click',function(e){
      if(window.innerWidth>940)return;
      e.preventDefault();
      a.parentNode.classList.toggle('acik');
    });
  });
})();
</script>
<?php } );

/* ---------- Yardımcılar ---------- */

/** Marka yazısı. */
function ty_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	printf(
		'<a class="brand" href="%s">TEKİRDAĞ<span>YANGIN</span></a>',
		esc_url( home_url( '/' ) )
	);
}

/** Slug'a göre sayfa bağlantısı; sayfa yoksa ana sayfaya düşer. */
function ty_url( $slug ) {
	$sayfa = get_page_by_path( $slug );
	return $sayfa ? get_permalink( $sayfa ) : home_url( '/' . $slug . '/' );
}

/** Teklif formu: kısa kod tanımlıysa onu, değilse yedek HTML formu basar. */
function ty_form() {
	$kod = trim( ty_op( 'ty_form_kod' ) );
	if ( $kod ) {
		echo '<div class="ff-acik">' . do_shortcode( $kod ) . '</div>';
		return;
	}
	get_template_part( 'parts/form', 'yedek' );
}

/** Basit breadcrumb. */
function ty_crumb( $ust = null ) {
	echo '<span class="crumb"><a href="' . esc_url( home_url( '/' ) ) . '">Ana sayfa</a>';
	if ( $ust ) {
		echo ' / <a href="' . esc_url( $ust['url'] ) . '">' . esc_html( $ust['ad'] ) . '</a>';
	}
	echo ' / ' . esc_html( get_the_title() ) . '</span>';
}

/**
 * Satır içi ikon seti. Stroke tabanlı, currentColor kullanır.
 */
function ty_ikon( $ad, $sinif = '' ) {
	$p = array(
		'tup'        => '<path d="M9 8h6v11a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2V8z"/><path d="M12 8V5"/><path d="M10 5h4"/><path d="M15 9h3"/>',
		'dolap'      => '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="M12 4v16"/><path d="M10 11v2"/><path d="M14 11v2"/>',
		'fabrika'    => '<path d="M3 21V10l6 4V10l6 4V6l6 3v12z"/><path d="M7 17h2"/><path d="M13 17h2"/>',
		'bina'       => '<rect x="5" y="3" width="14" height="18" rx="1.5"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2"/>',
		'depo'       => '<path d="M3 10l9-6 9 6v11H3z"/><path d="M7 21v-6h10v6"/><path d="M7 18h10"/>',
		'restoran'   => '<path d="M6 3v8a2 2 0 0 0 4 0V3"/><path d="M8 11v10"/><path d="M17 3c-1.5 1.5-2 3-2 5s.5 2.5 2 2.5V21"/>',
		'okul'       => '<path d="M3 9l9-5 9 5-9 5z"/><path d="M7 11.5V17c0 1.5 2.5 3 5 3s5-1.5 5-3v-5.5"/>',
		'ofis'       => '<rect x="3" y="7" width="18" height="14" rx="1.5"/><path d="M8 7V4h8v3"/><path d="M3 12h18"/>',
		'akaryakit'  => '<path d="M4 21V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v16"/><path d="M3 21h12"/><path d="M14 9h3a2 2 0 0 1 2 2v6a1.5 1.5 0 0 0 3 0V9l-3-3"/>',
		'hastane'    => '<rect x="4" y="4" width="16" height="17" rx="2"/><path d="M12 9v6"/><path d="M9 12h6"/>',
		'arac'       => '<path d="M5 17h14"/><path d="M4 17v-4l2-5h12l2 5v4"/><circle cx="7.5" cy="17.5" r="1.8"/><circle cx="16.5" cy="17.5" r="1.8"/><path d="M6 13h12"/>',
		'ocak'       => '<path d="M4 9h16l-2-4H6z"/><path d="M6 9v3a6 6 0 0 0 12 0V9"/><path d="M12 15v5"/><path d="M9 20h6"/>',
		'pano'       => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8"/><path d="M8 11h5"/><path d="M15.5 11.5l-2 3h3l-2 3"/>',
		'uyari'      => '<path d="M10.3 4.3 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 4.3a2 2 0 0 0-3.4 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>',
		'hesap'      => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M8 7h8"/><path d="M8.5 12h.01M12 12h.01M15.5 12h.01M8.5 16h.01M12 16h.01M15.5 16h.01"/>',
		'onay'       => '<path d="M20 6L9 17l-5-5"/>',
		'telefon'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 1.9.6 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.8.6a2 2 0 0 1 1.7 2z"/>',
		'whatsapp'   => '<path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 8.5 8.5 0 0 1-3.8-.9L3 21l1.9-5.1A8.4 8.4 0 0 1 4 11.5a8.4 8.4 0 0 1 8.5-8.5 8.4 8.4 0 0 1 8.5 8.5z"/>',
		'saat'       => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'belge'      => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5"/><path d="M9 14l2 2 4-4"/>',
		'harita'     => '<path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
	);
	if ( ! isset( $p[ $ad ] ) ) { return ''; }
	return '<svg class="' . esc_attr( $sinif ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p[ $ad ] . '</svg>';
}

/**
 * Ürün görseli. assets/img/ altında dosya varsa <img>, yoksa boş döner.
 * Böylece fotoğraf geldikçe tek tek eklenebiliyor, gelmeyende ikon gösteriliyor.
 */
function ty_gorsel( $dosya, $alt = '', $sinif = 'urun-foto' ) {
	if ( ! $dosya ) { return ''; }

	// Tam URL (medya kütüphanesi) doğrudan kullanılır.
	if ( preg_match( '#^https?://#', $dosya ) ) {
		$src = $dosya;
	} else {
		$yol = get_theme_file_path( 'assets/img/' . $dosya );
		if ( ! file_exists( $yol ) ) { return ''; }
		$src = get_theme_file_uri( 'assets/img/' . $dosya );
	}

	return sprintf(
		'<img class="%s" src="%s" alt="%s" loading="lazy" decoding="async" width="800" height="600">',
		esc_attr( $sinif ),
		esc_url( $src ),
		esc_attr( $alt )
	);
}

/**
 * Ürün görseli — panelde öne çıkan görsel yoksa temadaki hazır fotoğrafa düşer.
 *
 * Panelde "Ürün fotoğrafı" seçilmişse her zaman o kazanır. Seçilmemişse
 * ürünün başlığına/slug'ına bakıp assets/img/foto/ altındaki uygun fotoğrafı
 * kullanırız; böylece yeni ürün eklendiğinde kart boş kalmaz.
 *
 * Sırası önemli: en özel eşleşme en üstte olmalı.
 */
function ty_urun_yedek_foto( $metin ) {
	$m = strtolower( $metin );
	// "dolabı / dolabi" çekimini "dolap" ile aynı sepete koy
	$m = str_replace( array( 'dolab', 'dolabi' ), 'dolap', $m );

	$kurallar = array(
		// dolaplar — önce özel tipler
		array( array( 'dolap', 'dekoratif' ), 'foto/dolap-dekoratif.jpg' ),
		array( array( 'dolap', 'kopuk' ),     'foto/dolap-kopuklu.jpg' ),
		array( array( 'dolap', 'malzeme' ),   'foto/dolap-malzeme.jpg' ),
		array( array( 'dolap', 'bina-disi' ), 'foto/dolap-bina-disi.jpg' ),
		array( array( 'dolap', 'bina disi' ), 'foto/dolap-bina-disi.jpg' ),
		array( array( 'dolap', 'bina' ),      'foto/dolap-bina-ici.jpg' ),
		array( array( 'dolap' ),              'foto/yangin-dolabi.jpg' ),

		// otomatik sistemler
		array( array( 'davlumbaz' ),          'foto/davlumbaz.jpg' ),
		array( array( 'pano' ),               'foto/pano-ici.jpg' ),

		// yardımcı ekipman
		array( array( 'hortum' ),             'foto/hortum-lans.jpg' ),
		array( array( 'lans' ),               'foto/hortum-lans.jpg' ),
		array( array( 'makara' ),             'foto/hortum-lans.jpg' ),
		array( array( 'battaniye' ),          'foto/battaniye.jpg' ),
		array( array( 'aparat' ),             'foto/aparat.jpg' ),
		array( array( 'etiket' ),             'foto/aparat.jpg' ),
		array( array( 'vana' ),               'foto/vana-rakor.jpg' ),
		array( array( 'rakor' ),              'foto/vana-rakor.jpg' ),
		array( array( 'hidrant' ),            'foto/vana-rakor.jpg' ),

		// tüpler — kapasite ve tipe göre
		array( array( '50', 'tekerlek' ),     'foto/50kg-tekerlekli.jpg' ),
		array( array( 'tekerlek' ),           'foto/50kg-tekerlekli.jpg' ),
		array( array( 'co2' ),                'foto/5kg-co2.jpg' ),
		array( array( 'karbondioksit' ),      'foto/5kg-co2.jpg' ),
		array( array( 'kopuk' ),              'foto/kopuklu.jpg' ),
		array( array( 'eko' ),                'foto/kopuklu.jpg' ),
		array( array( 'biyolojik' ),          'foto/kopuklu.jpg' ),
		array( array( 'arac' ),               'foto/arac-tupu.jpg' ),
		array( array( '12' ),                 'foto/12kg-kkt.jpg' ),
		array( array( 'tup' ),                'foto/6kg-kkt.jpg' ),
	);

	foreach ( $kurallar as $kural ) {
		$tumu = true;
		foreach ( $kural[0] as $kelime ) {
			if ( false === strpos( $m, $kelime ) ) { $tumu = false; break; }
		}
		if ( $tumu && file_exists( get_theme_file_path( 'assets/img/' . $kural[1] ) ) ) {
			return $kural[1];
		}
	}
	return '';
}

/**
 * Bir ürün gönderisinin görsel adresi: önce öne çıkan görsel, sonra yedek fotoğraf.
 */
function ty_urun_foto( $post_id, $boyut = 'large' ) {
	$foto = get_the_post_thumbnail_url( $post_id, $boyut );
	if ( $foto ) { return $foto; }

	$gonderi = get_post( $post_id );
	if ( ! $gonderi ) { return ''; }

	$yedek = ty_urun_yedek_foto( $gonderi->post_name . ' ' . $gonderi->post_title );
	return $yedek ? get_theme_file_uri( 'assets/img/' . $yedek ) : '';
}

/**
 * Ürün kartı. Hem panelden gelen ürünü hem temadaki varsayılan diziyi basar.
 */
function ty_urun_kart( $u ) {
	if ( isset( $u['ad'] ) ) {           // panelden (CPT)
		$ad     = $u['ad'];
		$nerede = $u['nerede'];
		$foto   = $u['foto'] ? ty_gorsel( $u['foto'], $ad ) : '';
		$link   = ! empty( $u['link'] ) ? $u['link'] : '#teklif';
		$ikon   = 'tup';
	} else {                              // varsayılan dizi
		$ikon   = $u[0];
		$ad     = $u[1];
		$nerede = $u[2];
		$foto   = isset( $u[3] ) ? ty_gorsel( $u[3], $ad ) : '';
		$link   = '#teklif';
	}
	?>
	<a class="card urun" href="<?php echo esc_url( $link ); ?>">
		<span class="urun-medya">
			<?php echo $foto ? $foto : '<span class="chip">' . ty_ikon( $ikon ) . '</span>'; ?>
		</span>
		<h3><?php echo wp_kses_post( $ad ); ?></h3>
		<?php if ( $nerede ) : ?>
			<span class="urun-yer"><?php echo esc_html( $nerede ); ?></span>
		<?php endif; ?>
		<span class="more">Fiyat al &rarr;</span>
	</a>
	<?php
}

/**
 * İmza bloğu — sayfanın altında "bunu kim yazdı / kiminle konuşacaksınız".
 *
 * Panelden ad girilmemişse hiçbir şey basılmaz; yarım bir blok görünmez.
 * Görünüm → Özelleştir → Firma ve Yetkili
 */
function ty_imza() {
	$ad = trim( ty_op( 'ty_yetkili_ad' ) );
	if ( ! $ad ) { return ''; }

	$unvan = trim( ty_op( 'ty_yetkili_unvan' ) );
	$foto  = get_theme_mod( 'ty_yetkili_foto', '' );

	/* Elle atılmış imza görünümü — adın baş harfleri değil, tek hamlelik bir çizgi. */
	$cizgi = '<svg class="imza-cizgi" viewBox="0 0 150 34" fill="none" aria-hidden="true">'
	       . '<path d="M4 25c8-9 14-14 18-15 3-.7 4 .7 3 4-1.6 5.3-5 9.6-5 11 0 1.2 1 1.4 2.4.4'
	       . ' 3-2 6.4-6.4 9-10 2-2.7 3.4-3.6 4-2.6.5.9 0 2.9-1 5.4-1 2.4-1.4 3.9-.7 4.4.8.6 2.4-.2 4.4-2'
	       . ' 3.4-3 6-6.4 8.6-10.4 1.3-2 2.3-2.6 2.8-1.8.4.7 0 2.4-1 4.6-1.2 2.6-1.6 4.2-.8 4.8.9.7 2.8-.3 5-2.6'
	       . ' 2.8-2.9 5-5.8 7.4-9 1.2-1.6 2-2 2.4-1.3.3.6 0 2-.8 3.8-1 2.2-1.2 3.6-.4 4.2 1 .8 3 0 5.4-2'
	       . ' 4.6-4 9-8.6 14.6-11.4 6-3 11-3.4 15-1.6 3 1.4 4 3.6 3 5.6-1.2 2.4-4.6 3.8-9.6 4.2-6 .5-12-.6-18-2.4"'
	       . ' stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>';

	$out  = '<div class="imza">';
	if ( $foto ) {
		$out .= sprintf(
			'<img class="imza-foto" src="%s" alt="%s" width="64" height="64" loading="lazy" decoding="async">',
			esc_url( $foto ),
			esc_attr( $ad )
		);
	}
	$out .= '<div>' . $cizgi
	      . '<div class="imza-ad">' . esc_html( $ad ) . '</div>';
	if ( $unvan ) {
		$out .= '<div class="imza-unvan">' . esc_html( $unvan ) . '</div>';
	}
	$out .= '</div></div>';

	return $out;
}

/**
 * Kaç yıldır bu işi yaptığımızı kuruluş yılından hesaplar.
 * Yıl girilmemişse boş döner, hiçbir yerde "0 yıl" yazmaz.
 */
function ty_kac_yil() {
	$yil = (int) ty_op( 'ty_kurulus' );
	if ( $yil < 1900 || $yil > (int) date( 'Y' ) ) { return 0; }
	return (int) date( 'Y' ) - $yil;
}

/**
 * Rehber sayfası için soru-cevap derlemesi.
 *
 * Yeni içerik yazmıyoruz: ürün tipi ve sektör sayfalarında zaten yazılı olan
 * sorular tek yerde toplanıyor. Böylece Rehber sayfası boş kalmıyor ve
 * ziyaretçi aradığı cevabı gerçekten bulabiliyor.
 */
function ty_rehber_sorular() {
	$gruplar = array();

	// Ürün tipleri (tüpler, dolaplar)
	foreach ( ty_urun_tipleri() as $slug => $tip ) {
		if ( empty( $tip['sss'] ) ) { continue; }
		$baslik = 'dolap' === $tip['grup'] ? 'Yangın dolabı' : 'Yangın söndürme tüpü';
		foreach ( $tip['sss'] as $q ) {
			if ( empty( $q[0] ) || empty( $q[1] ) ) { continue; }
			$gruplar[ $baslik ][] = array(
				's'      => $q[0],
				'c'      => $q[1],
				'url'    => ty_url( $slug ),
				'kaynak' => $tip['ad'],
			);
		}
	}

	// Sektörler
	foreach ( ty_sektorler() as $slug => $sektor ) {
		if ( empty( $sektor['sss'] ) ) { continue; }
		foreach ( $sektor['sss'] as $q ) {
			if ( empty( $q[0] ) || empty( $q[1] ) ) { continue; }
			$gruplar['Tesis ve işletmeler'][] = array(
				's'      => $q[0],
				'c'      => $q[1],
				'url'    => ty_url( $slug ),
				'kaynak' => $sektor['ad'],
			);
		}
	}

	// Aynı soru birden çok sayfada geçiyorsa bir kez göster.
	foreach ( $gruplar as $ad => $liste ) {
		$gorulen = array();
		$temiz   = array();
		foreach ( $liste as $q ) {
			$anahtar = mb_strtolower( trim( $q['s'] ) );
			if ( isset( $gorulen[ $anahtar ] ) ) { continue; }
			$gorulen[ $anahtar ] = true;
			$temiz[] = $q;
		}
		$gruplar[ $ad ] = $temiz;
	}

	return $gruplar;
}

/**
 * Sektör fotoğrafı — varsa kullanılır, yoksa kart ikonlu sade hâlinde kalır.
 *
 * Fotoğraf eklemek için tema dosyasına dokunmaya gerek yok:
 * assets/img/foto/ klasörüne sektor-<slug>.jpg adıyla bir dosya bırakmak yeterli.
 * Örnek: sektor-fabrika-osb.jpg, sektor-restoran-otel.jpg
 * Önerilen boyut: 1200x900 (4:3).
 */
function ty_sektor_foto( $slug ) {
	// 1) Kendi fotoğrafınızı koyduysanız o kazanır.
	$ozel = 'foto/sektor-' . $slug . '.jpg';
	if ( file_exists( get_theme_file_path( 'assets/img/' . $ozel ) ) ) {
		return $ozel;
	}
	// 2) Yoksa data.php'de o sektör için tanımlı fotoğraf.
	$s = ty_sektorler();
	if ( ! empty( $s[ $slug ]['foto'] ) && file_exists( get_theme_file_path( 'assets/img/' . $s[ $slug ]['foto'] ) ) ) {
		return $s[ $slug ]['foto'];
	}
	return '';
}

/** Sektör slug'ına göre ikon adı. */
function ty_sektor_ikon( $slug ) {
	$s = ty_sektorler();
	return isset( $s[ $slug ]['ikon'] ) ? $s[ $slug ]['ikon'] : 'bina';
}

/** Hizmet slug'ına göre ikon adı. */
function ty_hizmet_ikon( $slug ) {
	$h = ty_hizmetler();
	return isset( $h[ $slug ]['ikon'] ) ? $h[ $slug ]['ikon'] : 'tup';
}

/* ---------- SEO / şema ---------- */

add_action( 'wp_head', function () {
	if ( ! is_front_page() ) { return; }
	$sema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'LocalBusiness',
		'name'       => ty_op( 'ty_unvan' ),
		'url'        => home_url( '/' ),
		'telephone'  => ty_op( 'ty_tel_raw' ),
		'email'      => ty_op( 'ty_email' ),
		'address'    => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => ty_op( 'ty_adres' ),
			'addressLocality' => 'Tekirdağ',
			'addressCountry'  => 'TR',
		),
		'areaServed' => array_values( wp_list_pluck( ty_ilceler(), 'ad' ) ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $sema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 5 );

/* Arşiv/arama başlıklarını sadeleştir. */
add_filter( 'document_title_separator', function () { return '·'; } );

/* ---------- Blog yardımcıları ---------- */

/** Yaklaşık okuma süresi (dakika). */
function ty_okuma_suresi( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$kelime  = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
	return max( 1, (int) round( $kelime / 190 ) );
}

/** Yazının ilk kategorisi. */
function ty_yazi_kategori( $post_id = null ) {
	$k = get_the_category( $post_id ? $post_id : get_the_ID() );
	return ( ! is_wp_error( $k ) && ! empty( $k ) ) ? $k[0] : null;
}

/** Blog kartı. $buyuk = true ise geniş öne çıkan kart. */
function ty_yazi_kart( $buyuk = false ) {
	$kat  = ty_yazi_kategori();
	$foto = get_the_post_thumbnail_url( get_the_ID(), $buyuk ? 'large' : 'medium_large' );
	?>
	<a class="yazi-kart<?php echo $buyuk ? ' yazi-kart-buyuk' : ''; ?>" href="<?php the_permalink(); ?>">
		<span class="yazi-medya">
			<?php if ( $foto ) : ?>
				<img src="<?php echo esc_url( $foto ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" decoding="async" width="800" height="600">
			<?php else : ?>
				<span class="chip chip-buyuk"><?php echo ty_ikon( 'belge' ); ?></span>
			<?php endif; ?>
			<?php if ( $kat ) : ?><span class="yazi-kat"><?php echo esc_html( $kat->name ); ?></span><?php endif; ?>
		</span>
		<span class="yazi-alt">
			<h3><?php the_title(); ?></h3>
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), $buyuk ? 34 : 20 ) ); ?></p>
			<span class="yazi-meta">
				<?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
				<i>·</i>
				<?php echo esc_html( ty_okuma_suresi() ); ?> dk okuma
			</span>
		</span>
	</a>
	<?php
}
