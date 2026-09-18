<?php
/**
 * Ürünler — panelden yönetilen içerik türü.
 * Ürün eklemek, silmek, fotoğraf değiştirmek için tema dosyasına dokunmaya gerek yok.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ---------- İçerik türü ve grup taksonomisi ---------- */

add_action( 'init', function () {

	register_post_type( 'ty_urun', array(
		'labels' => array(
			'name'               => 'Ürünler',
			'singular_name'      => 'Ürün',
			'add_new'            => 'Yeni ürün ekle',
			'add_new_item'       => 'Yeni ürün ekle',
			'edit_item'          => 'Ürünü düzenle',
			'new_item'           => 'Yeni ürün',
			'view_item'          => 'Ürünü görüntüle',
			'search_items'       => 'Ürünlerde ara',
			'not_found'          => 'Ürün bulunamadı',
			'not_found_in_trash' => 'Çöpte ürün yok',
			'all_items'          => 'Tüm ürünler',
			'menu_name'          => 'Ürünler',
			'featured_image'     => 'Ürün fotoğrafı',
			'set_featured_image' => 'Ürün fotoğrafı seç',
			'remove_featured_image' => 'Fotoğrafı kaldır',
			'use_featured_image' => 'Ürün fotoğrafı olarak kullan',
		),
		'public'        => true,
		'has_archive'   => false,
		'show_in_rest'  => true,
		'menu_icon'     => 'dashicons-shield-alt',
		'menu_position' => 21,
		'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ),
		'rewrite'       => array( 'slug' => 'urun' ),
	) );

	register_taxonomy( 'ty_urun_grup', 'ty_urun', array(
		'labels' => array(
			'name'          => 'Ürün grupları',
			'singular_name' => 'Ürün grubu',
			'add_new_item'  => 'Yeni grup ekle',
			'edit_item'     => 'Grubu düzenle',
			'menu_name'     => 'Gruplar',
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'urun-grubu' ),
	) );
} );

/* ---------- Alanları REST'e aç (panel + otomasyon için) ---------- */

add_action( 'init', function () {
	foreach ( array( '_ty_nerede', '_ty_one_cikan', '_ty_tip' ) as $ty_anahtar ) {
		register_post_meta( 'ty_urun', $ty_anahtar, array(
			'type'          => 'string',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => function () { return current_user_can( 'edit_posts' ); },
		) );
	}
} );

/* ---------- "Nerede kullanılır" alanı ---------- */

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'ty_urun_bilgi', 'Ürün bilgisi', function ( $post ) {
		wp_nonce_field( 'ty_urun_kaydet', 'ty_urun_nonce' );
		$nerede = get_post_meta( $post->ID, '_ty_nerede', true );
		$sira   = get_post_meta( $post->ID, '_ty_one_cikan', true );
		$tip    = get_post_meta( $post->ID, '_ty_tip', true );
		?>
		<p>
			<label for="ty_nerede"><strong>Nerede kullanılır</strong></label><br>
			<input type="text" id="ty_nerede" name="ty_nerede" value="<?php echo esc_attr( $nerede ); ?>"
			       class="widefat" placeholder="İşyeri · ofis · apartman katı">
			<span class="description">Kartın üzerinde kırmızı küçük yazı olarak çıkar. Kalemleri &middot; ile ayırın.</span>
		</p>
		<p>
			<label for="ty_tip"><strong>Ürün tipi sayfası</strong></label><br>
			<select id="ty_tip" name="ty_tip" class="widefat">
				<option value="">— bağlı değil —</option>
				<optgroup label="Yangın tüpü">
					<?php foreach ( ty_tipler( 'tup' ) as $ty_s => $ty_t ) : ?>
						<option value="<?php echo esc_attr( $ty_s ); ?>" <?php selected( $tip, $ty_s ); ?>><?php echo esc_html( $ty_t['ad'] ); ?></option>
					<?php endforeach; ?>
				</optgroup>
				<optgroup label="Yangın dolabı">
					<?php foreach ( ty_tipler( 'dolap' ) as $ty_s => $ty_t ) : ?>
						<option value="<?php echo esc_attr( $ty_s ); ?>" <?php selected( $tip, $ty_s ); ?>><?php echo esc_html( $ty_t['ad'] ); ?></option>
					<?php endforeach; ?>
				</optgroup>
			</select>
			<span class="description">Seçilirse ürün, o tipin kendi sayfasında listelenir.</span>
		</p>
		<p>
			<label><input type="checkbox" name="ty_one_cikan" value="1" <?php checked( $sira, '1' ); ?>>
			<strong>Ana sayfada hero bölümünde öne çıkar</strong></label><br>
			<span class="description">En fazla 3 ürün işaretleyin.</span>
		</p>
		<?php
	}, 'ty_urun', 'side', 'default' );
} );

add_action( 'save_post_ty_urun', function ( $post_id ) {
	if ( ! isset( $_POST['ty_urun_nonce'] ) || ! wp_verify_nonce( $_POST['ty_urun_nonce'], 'ty_urun_kaydet' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	update_post_meta( $post_id, '_ty_nerede', sanitize_text_field( wp_unslash( $_POST['ty_nerede'] ?? '' ) ) );
	update_post_meta( $post_id, '_ty_tip', sanitize_text_field( wp_unslash( $_POST['ty_tip'] ?? '' ) ) );
	if ( ! empty( $_POST['ty_one_cikan'] ) ) {
		update_post_meta( $post_id, '_ty_one_cikan', '1' );
	} else {
		delete_post_meta( $post_id, '_ty_one_cikan' );
	}
} );

/* ---------- Panelde ürün listesi sütunları ---------- */

add_filter( 'manage_ty_urun_posts_columns', function ( $c ) {
	$yeni = array();
	foreach ( $c as $k => $v ) {
		if ( 'title' === $k ) { $yeni['ty_foto'] = 'Fotoğraf'; }
		$yeni[ $k ] = $v;
		if ( 'title' === $k ) { $yeni['ty_nerede'] = 'Nerede kullanılır'; }
	}
	$yeni['ty_one'] = 'Öne çıkan';
	return $yeni;
} );

add_action( 'manage_ty_urun_posts_custom_column', function ( $col, $post_id ) {
	if ( 'ty_foto' === $col ) {
		echo has_post_thumbnail( $post_id )
			? get_the_post_thumbnail( $post_id, array( 60, 45 ), array( 'style' => 'border-radius:4px;object-fit:cover' ) )
			: '<span style="color:#b32d2e">yok</span>';
	} elseif ( 'ty_nerede' === $col ) {
		echo esc_html( get_post_meta( $post_id, '_ty_nerede', true ) );
	} elseif ( 'ty_one' === $col ) {
		echo get_post_meta( $post_id, '_ty_one_cikan', true ) ? '★' : '';
	}
}, 10, 2 );

add_filter( 'manage_edit-ty_urun_sortable_columns', function ( $c ) {
	$c['menu_order'] = 'menu_order';
	return $c;
} );

/* Ürün listesi varsayılan sıralaması: elle verilen sıra. */
add_action( 'pre_get_posts', function ( $q ) {
	if ( is_admin() && $q->is_main_query() && 'ty_urun' === $q->get( 'post_type' ) && ! $q->get( 'orderby' ) ) {
		$q->set( 'orderby', 'menu_order title' );
		$q->set( 'order', 'ASC' );
	}
} );

/* ---------- Okuma ---------- */

/**
 * Ürünleri gruplarına göre getirir.
 * Panelde ürün tanımlıysa onu, tanımlı değilse temadaki varsayılan listeyi kullanır.
 */
function ty_urun_gruplari() {
	$gruplar = get_terms( array(
		'taxonomy'   => 'ty_urun_grup',
		'hide_empty' => true,
		'orderby'    => 'term_order',
	) );

	if ( is_wp_error( $gruplar ) || empty( $gruplar ) ) {
		return ty_urun_gruplari_varsayilan();
	}

	$cikti = array();
	foreach ( $gruplar as $g ) {
		$urunler = get_posts( array(
			'post_type'      => 'ty_urun',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'tax_query'      => array( array( 'taxonomy' => 'ty_urun_grup', 'field' => 'term_id', 'terms' => $g->term_id ) ),
		) );
		if ( ! $urunler ) { continue; }

		$liste = array();
		foreach ( $urunler as $u ) {
			$liste[] = array(
				'id'     => $u->ID,
				'ad'     => get_the_title( $u ),
				'nerede' => get_post_meta( $u->ID, '_ty_nerede', true ),
				'foto'   => ty_urun_foto( $u->ID, 'large' ),
				'one'    => (bool) get_post_meta( $u->ID, '_ty_one_cikan', true ),
				'link'   => get_permalink( $u ),
			);
		}

		$cikti[] = array(
			'ad'      => $g->name,
			'ozet'    => $g->description,
			'link'    => '',
			'urunler' => $liste,
			'cpt'     => true,
		);
	}

	return $cikti ? $cikti : ty_urun_gruplari_varsayilan();
}

/** Hero'da öne çıkacak ürünler. */
function ty_one_cikan_urunler( $adet = 3 ) {
	$p = get_posts( array(
		'post_type'      => 'ty_urun',
		'posts_per_page' => $adet,
		'meta_key'       => '_ty_one_cikan',
		'meta_value'     => '1',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	) );
	$out = array();
	foreach ( $p as $u ) {
		$out[] = array(
			'ad'     => get_the_title( $u ),
			'nerede' => get_post_meta( $u->ID, '_ty_nerede', true ),
			'foto'   => ty_urun_foto( $u->ID, 'medium' ),
			'link'   => get_permalink( $u ),
		);
	}
	return $out;
}

/* ---------- Panele yardım notu ---------- */

add_action( 'admin_notices', function () {
	$ekran = get_current_screen();
	if ( ! $ekran || 'edit-ty_urun' !== $ekran->id ) { return; }
	$sayi = wp_count_terms( array( 'taxonomy' => 'ty_urun_grup', 'hide_empty' => false ) );
	if ( is_wp_error( $sayi ) || $sayi > 0 ) { return; }
	echo '<div class="notice notice-info ty-not"><p><strong>Henüz ürün grubu yok.</strong> '
	   . 'Önce <a href="' . esc_url( admin_url( 'edit-tags.php?taxonomy=ty_urun_grup&post_type=ty_urun' ) ) . '">Ürünler &rarr; Gruplar</a> '
	   . 'bölümünden grupları oluşturun (örn. Söndürme cihazları, Yangın dolabı ve su hattı), sonra ürünleri o gruplara ekleyin. '
	   . 'Grup açıklaması ana sayfada başlığın altında görünür.</p></div>';
} );

/** Bir ürün tipine (tüp ya da dolap) bağlı ürünleri kart dizisi olarak getirir. */
function ty_tip_urunleri( $tip_slug ) {
	$urunler = get_posts( array(
		'post_type'      => 'ty_urun',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'meta_key'       => '_ty_tip',
		'meta_value'     => $tip_slug,
	) );
	$liste = array();
	foreach ( $urunler as $u ) {
		$liste[] = array(
			'id'     => $u->ID,
			'ad'     => get_the_title( $u ),
			'nerede' => get_post_meta( $u->ID, '_ty_nerede', true ),
			'foto'   => ty_urun_foto( $u->ID, 'large' ),
			'one'    => (bool) get_post_meta( $u->ID, '_ty_one_cikan', true ),
			'link'   => get_permalink( $u ),
		);
	}
	return $liste;
}

/** Bir gruba ('tup' / 'dolap') bağlı tüm ürünler. */
function ty_grup_urunleri( $grup ) {
	$slugs = array_keys( ty_tipler( $grup ) );
	if ( ! $slugs ) { return array(); }
	$urunler = get_posts( array(
		'post_type'      => 'ty_urun',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
		'meta_query'     => array( array( 'key' => '_ty_tip', 'value' => $slugs, 'compare' => 'IN' ) ),
	) );
	$liste = array();
	foreach ( $urunler as $u ) {
		$liste[] = array(
			'id'     => $u->ID,
			'ad'     => get_the_title( $u ),
			'nerede' => get_post_meta( $u->ID, '_ty_nerede', true ),
			'foto'   => ty_urun_foto( $u->ID, 'large' ),
			'one'    => (bool) get_post_meta( $u->ID, '_ty_one_cikan', true ),
			'link'   => get_permalink( $u ),
		);
	}
	return $liste;
}
