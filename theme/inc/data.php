<?php
/**
 * Sektör, hizmet ve ilçe verileri.
 * Sayfa şablonları bu dizileri sayfanın kısa adına (slug) göre okur.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ty_hizmetler() {
	return array(
		'yangin-tupu-dolumu' => array(
			'ikon'    => 'tup',
			'foto'    => 'foto/6kg-kkt.jpg',
			'etiket'  => 'Söndürme cihazı',
			'baslik'  => 'Yangın tüpü dolumu, bakımı ve satışı',
			'ozet'    => 'ABC kuru kimyevi toz, CO₂ ve köpüklü cihazların dolumu ile yıllık yerinde kontrolü. Cihazlarınızı adresinizden alır, dolumunu yapar, aynı gün yerine takarız.',
			'kalemler'=> array( 'Dolum ve hidrostatik test', 'Yıllık yerinde kontrol', 'Etiketleme ve kontrol kaydı', 'Satış ve montaj' ),
		),
		'arac-yangin-tupu' => array(
			'ikon'    => 'arac',
			'foto'    => 'foto/arac-tupu.jpg',
			'etiket'  => 'Araç tüpü',
			'baslik'  => 'Araç yangın tüpü ve dolumu',
			'ozet'    => 'Binek araç, ticari araç, kamyon ve otobüsler için yangın söndürme cihazı satışı ve dolumu. Muayeneye girmeden önce basıncı ve tarihi kontrol ediyoruz.',
			'kalemler'=> array( 'Araç tüpü satışı', 'Dolum ve basınç kontrolü', 'Filo için toplu servis', 'Muayene öncesi kontrol' ),
		),
		'yangin-dolabi-hidrant' => array(
			'ikon'    => 'dolap',
			'foto'    => 'foto/yangin-dolabi.jpg',
			'etiket'  => 'Dolap & hidrant',
			'baslik'  => 'Yangın dolabı ve hidrant sistemleri',
			'ozet'    => 'Sıva altı ve sıva üstü yangın dolabı montajı, mevcut dolapların hortum, lans ve makara yenilemesi, bina içi ve dışı hidrant hatlarının bakımı.',
			'kalemler'=> array( 'Dolap montajı ve yenileme', 'Hortum, lans, vana değişimi', 'Hidrant hattı bakımı', 'Basınç ve debi ölçümü' ),
		),
		'davlumbaz-sondurme' => array(
			'ikon'    => 'ocak',
			'foto'    => 'foto/davlumbaz.jpg',
			'etiket'  => 'Davlumbaz',
			'baslik'  => 'Davlumbaz söndürme sistemi',
			'ozet'    => 'Ticari mutfaklarda davlumbaz ve ocak hattını koruyan otomatik söndürme sistemi. Yangını bacaya ulaşmadan, ocak üzerinde bastırır.',
			'kalemler'=> array( 'Sistem projelendirme ve montaj', 'Nozul yerleşimi', 'Gaz kesme bağlantısı', 'Periyodik kontrol ve dolum' ),
		),
		'pano-ici-sondurme' => array(
			'ikon'    => 'pano',
			'foto'    => 'foto/pano-ici.jpg',
			'etiket'  => 'Pano içi',
			'baslik'  => 'Pano içi otomatik söndürme',
			'ozet'    => 'Elektrik panosu, sunucu kabini ve makine panolarının içine yerleştirilen, elektrik gerektirmeden kendi kendine devreye giren söndürme sistemi.',
			'kalemler'=> array( 'Pano içi tüp montajı', 'Otomatik tetikleme', 'Sunucu kabini koruması', 'Yıllık kontrol' ),
		),
	);
}

/** Panelde ürün tanımlı değilken kullanılan varsayılan vitrin. */
function ty_urun_gruplari_varsayilan() {
	return array(
		array(
			'ad'   => 'Söndürme cihazları',
			'ozet' => 'Kuru kimyevi tozlu, karbondioksitli ve köpüklü tüpler. 1 kg\'dan 50 kg\'a tüm kapasiteler.',
			'link' => 'yangin-tupu-dolumu',
			'urunler' => array(
				array( 'tup',  '6 kg ABC kuru kimyevi toz',  'İşyeri · ofis · apartman katı', 'foto/6kg-kkt.jpg' ),
				array( 'tup',  '12 kg ABC kuru kimyevi toz', 'Depo · üretim alanı · otopark', 'foto/12kg-kkt.jpg' ),
				array( 'pano', '5 kg CO₂ karbondioksit',     'Pano · sunucu odası · mutfak', 'foto/5kg-co2.jpg' ),
				array( 'akaryakit', '50 kg tekerlekli KKT',  'Akaryakıt · açık saha · tank sahası', 'foto/50kg-tekerlekli.jpg' ),
				array( 'ocak', 'Köpüklü ve eko biyolojik',   'Boya · yakıt · gıda üretimi', 'foto/kopuklu.jpg' ),
				array( 'arac', 'Araç yangın tüpü',           'Binek · ticari · ağır vasıta', 'foto/arac-tupu.jpg' ),
			),
		),
		array(
			'ad'   => 'Yangın dolabı ve su hattı',
			'ozet' => 'Sıva altı ve sıva üstü dolaplar, yenileme parçaları ve hidrant bağlantı elemanları.',
			'link' => 'yangin-dolabi-hidrant',
			'urunler' => array(
				array( 'dolap', 'Yangın dolabı',            'Sıva altı · sıva üstü · montajlı', 'foto/yangin-dolabi.jpg' ),
				array( 'dolap', 'Hortum, lans ve makara',   'Dolap yenileme parçaları', 'foto/hortum-lans.jpg' ),
				array( 'dolap', 'Vana, rakor ve hidrant',   'Bina içi ve dışı hat elemanları', 'foto/vana-rakor.jpg' ),
			),
		),
		array(
			'ad'   => 'Otomatik söndürme sistemleri',
			'ozet' => 'İnsan müdahalesi olmadan, yangını çıktığı yerde bastıran sistemler.',
			'link' => 'davlumbaz-sondurme',
			'urunler' => array(
				array( 'ocak', 'Davlumbaz söndürme sistemi', 'Ticari mutfak · ocak hattı', 'foto/davlumbaz.jpg' ),
				array( 'pano', 'Pano içi söndürme tüpü',     'Elektrik panosu · sunucu kabini', 'foto/pano-ici.jpg' ),
			),
		),
		array(
			'ad'   => 'Yardımcı ekipman',
			'ozet' => 'Cihazın yanında lazım olan küçük kalemler.',
			'link' => '',
			'urunler' => array(
				array( 'ocak',  'Yangın battaniyesi',        'Mutfak · kreş · laboratuvar', 'foto/battaniye.jpg' ),
				array( 'belge', 'Duvar aparatı ve etiket',   'Montaj ve kontrol kaydı için', 'foto/aparat.jpg' ),
			),
		),
	);
}

/** Kapasite rehberi — hangi boy nerede kullanılır. */
function ty_tup_kapasite() {
	return array(
		array( '1 kg',  'Binek araç, küçük ofis, ev',                 'Araçta yönetmelik gereği bulundurulması zorunlu asgari boy.' ),
		array( '2 kg',  'Ticari araç, küçük işyeri, kasa önü',        'Dükkân ve minibüs için en çok satan boy.' ),
		array( '6 kg',  'İşyeri, apartman katı, ofis, restoran',      'Türkiye\'de en yaygın kullanılan kapasite.' ),
		array( '12 kg', 'Depo, üretim alanı, otopark, kazan dairesi', 'Geniş hacimlerde tek cihazla daha fazla alan korunur.' ),
		array( '25 kg', 'Büyük depo, sanayi tesisi',                  'Tekerlekli gövde ile hareket ettirilir.' ),
		array( '50 kg', 'Akaryakıt istasyonu, açık saha, tank sahası','Yüksek kapasiteli tekerlekli cihaz, hortumlu.' ),
	);
}

function ty_sektorler() {
	return array(

		'fabrika-osb' => array(
			'ad'   => 'Fabrika ve OSB tesisleri',
			'ozet' => 'Hidrant kapsamı, pano koruması ve yüzlerce cihazın periyodik takibi',
			'ikon' => 'fabrika',
			'foto' => 'foto/pano-ici.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'yangin-dolabi-hidrant', 'pano-ici-sondurme', 'arac-yangin-tupu' ),
			'mevzuat' => array(
				array( 'Tehlike sınıfı ve cihaz sayısı', 'Üretim tesislerinde söndürme cihazı sayısı ve kapasitesi, alanın büyüklüğüne ve tehlike sınıfına göre belirlenir. Aynı metrekare için tekstil atölyesi ile boya hattı aynı korumayı gerektirmez.' ),
				array( 'Yangın dolabı ve hidrant', 'Bina içi yangın dolapları ve dış hidrant hattı, alan ve tehlike sınıfına göre zorunludur. Hattın gerçekten iş görüp görmediği ancak basınç ve debi ölçümüyle belgelenir.' ),
				array( 'Söndürme cihazı periyodu', 'Her cihazın yılda bir kez yerinde kontrolü, dört yılda bir dolumu ve hidrostatik testi gerekir. Denetimde cihaz cihaz kayıt sorulur.' ),
			),
			'riskler' => array(
				array( 'Elektrik panoları', 'Üretim tesislerinde yangınların önemli bölümü pano içinde başlar. Pano içi otomatik söndürme, olay büyümeden bastırır.' ),
				array( 'Hat düzeni değişimi', 'Üretim hattı veya depo düzeni değiştiğinde mevcut cihaz yerleşimi erişim mesafesini karşılamaz hale gelir.' ),
				array( 'Cihaz takibinin kaybolması', 'Yüzlerce cihazın hangisinin ne zaman kontrol edildiği elle takip edilemez. Numaralandırma ve kayıt şart.' ),
				array( 'Erişimin kapanması', 'Hat düzeni değiştikçe cihaz ve dolap önleri palet, makine veya malzemeyle kapanır.' ),
			),
			'sss' => array(
				array( 'Üretimi durdurmak gerekiyor mu?', 'Hayır. Cihaz değişimini vardiya aralarında veya hafta sonu yapıyoruz. Dolum için aldığımız her cihazın yerine aynı sınıfta ikame cihaz bırakıyoruz.' ),
				array( 'Yüzlerce cihazı nasıl takip ediyorsunuz?', 'Her cihazı numaralandırıp kayda geçiriyoruz: hangi cihaz nerede, en son ne zaman kontrol edildi, dolumu ne zaman gelecek. Bakım zamanı yaklaşınca sizi biz arıyoruz.' ),
				array( 'Denetim dosyası hazırlıyor musunuz?', 'Evet. Cihaz kayıtları, dolum ve bakım raporları, sistem test sonuçları dosya halinde teslim edilir.' ),
			),
		),

		'site-apartman' => array(
			'ad'   => 'Site ve apartman yönetimleri',
			'ozet' => 'Kat başına cihaz, yangın dolabı ve yıllık kontrol raporu',
			'ikon' => 'bina',
			'foto' => 'foto/dolap-bina-ici.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'yangin-dolabi-hidrant', 'pano-ici-sondurme' ),
			'mevzuat' => array(
				array( 'Yıllık kontrol', 'Söndürme cihazlarının yılda bir kez yetkili servis tarafından yerinde kontrol edilmesi zorunludur. Bu, yönetimin sorumluluğundadır.' ),
				array( 'Dört yılda bir dolum', 'Cihazlar dört yılda bir yeniden doldurulur ve hidrostatik testi yapılır. Yönetim değişse de bu takvim işlemeye devam eder.' ),
				array( 'Aylık göz kontrolü', 'Manometrenin yeşil bölgede olup olmadığına bakmak bina görevlisinin aylık görevidir; servis gerektirmez.' ),
			),
			'riskler' => array(
				array( 'Yönetim değişimi', 'Yeni yönetim cihazların geçmişini bilmiyor, elde belge olmuyor. Kayıt bizde durduğu için geçmişi çıkarabiliyoruz.' ),
				array( 'Kazan dairesi ve jeneratör', 'Bu alanlar farklı yangın sınıfına girer; genel amaçlı cihaz yeterli olmayabilir.' ),
				array( 'Otopark', 'Kapalı otoparklarda cihaz sayısı ve yerleşimi ayrı hesaplanır, çoğu binada eksiktir.' ),
				array( 'Asansör ve elektrik panosu', 'Pano içi yangınlar sitelerde en sık görülen elektrik kaynaklı olaylardandır.' ),
			),
			'sss' => array(
				array( 'Kaç tüp gerekiyor?', 'Kat alanına, kullanım amacına ve yangın sınıfına göre hesaplanır. Keşifte kat planı üzerinde noktaları işaretleyip teklifle gönderiyoruz.' ),
				array( 'Tüm blokları birden yaptırırsak avantaj olur mu?', 'Olur. Tek seferde yapıldığında birim maliyet düşüyor. Kaç blok ve kaç daire olduğunu söyleyin, blok blok teklif çıkaralım.' ),
				array( 'Kat maliklerine gösterecek belge veriyor musunuz?', 'Evet. Her cihaz için etiketli kontrol kaydı ve toplu bakım raporu düzenliyoruz.' ),
			),
		),

		'depo-lojistik' => array(
			'ad'   => 'Depo ve lojistik tesisleri',
			'ozet' => 'Yüksek raflı depolarda cihaz yerleşimi ve hidrant bağlantısı',
			'ikon' => 'depo',
			'foto' => 'foto/50kg-tekerlekli.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'yangin-dolabi-hidrant', 'arac-yangin-tupu', 'pano-ici-sondurme' ),
			'mevzuat' => array(
				array( 'Depolanan malzemenin cinsi', 'Koruma ihtiyacı depolanan malzemenin cinsine ve istif yüksekliğine göre değişir. Aynı alanda karton ile plastik hammadde aynı korumayı gerektirmez.' ),
				array( 'Hidrant hattı', 'Belirli büyüklüğü aşan yapılarda bina dışı hidrant sistemi aranır; basınç ve debi ölçümle belgelenmelidir.' ),
				array( 'Söndürme cihazı periyodu', 'Yılda bir yerinde kontrol, dört yılda bir dolum ve hidrostatik test.' ),
			),
			'riskler' => array(
				array( 'İstif yüksekliği', 'Malzeme tavana kadar istiflendiğinde yangın hızla yayılır ve müdahale mesafesi kapanır.' ),
				array( 'Forklift şarj alanı', 'Akü şarj bölgesi yüksek riskli olmasına rağmen çoğu depoda uygun söndürücü bulunmaz.' ),
				array( 'Palet ile kapanan erişim', 'Yangın dolabı ve cihaz önleri sevkiyat yoğunluğunda kapanır.' ),
				array( 'Filo araçları', 'Depo filosundaki araçlarda yangın tüpü zorunludur; muayenede ve denetimde sorulur.' ),
			),
			'sss' => array(
				array( 'Depo düzenimiz değişti, koruma hâlâ yeterli mi?', 'Muhtemelen değil. Raf eklendiğinde veya yükseklik artırıldığında cihaz sayısı ve yerleşimi yeniden hesaplanmalı. Keşifte bunu ölçüyoruz.' ),
				array( 'Operasyonu durdurmak gerekiyor mu?', 'Hayır. Cihaz değişimini sevkiyat saatleri dışında planlıyor, aldığımız her cihazın yerine ikame bırakıyoruz.' ),
				array( 'Filodaki araçlara da bakıyor musunuz?', 'Evet. Araç tüplerinin dolumunu ve basınç kontrolünü aynı serviste yapıyoruz.' ),
			),
		),

		'restoran-otel' => array(
			'ad'   => 'Restoran, kafe ve otel',
			'ozet' => 'Davlumbaz söndürme sistemi, mutfak hattı için CO₂ ve kat dolapları',
			'ikon' => 'restoran',
			'foto' => 'foto/davlumbaz.jpg',
			'hizmetler' => array( 'davlumbaz-sondurme', 'yangin-tupu-dolumu', 'yangin-dolabi-hidrant', 'pano-ici-sondurme' ),
			'mevzuat' => array(
				array( 'Davlumbaz otomatik söndürme', 'Yönetmelik, yüksek binalardaki mutfaklar ile anında 100 kişiden fazlasına hizmet veren mutfakların davlumbazlarına otomatik söndürme sistemi kurulmasını zorunlu tutar (Madde 41). Ayrıca gaz algılama, gaz kesme ve uyarı tesisatı aranır.' ),
				array( 'Yangın dolabı', 'Otellerde kat koridorlarında yangın dolabı ve yönlendirme işaretlemesi gerekir.' ),
				array( 'Söndürme cihazı periyodu', 'Yılda bir yerinde kontrol, dört yılda bir dolum ve hidrostatik test.' ),
			),
			'riskler' => array(
				array( 'Yağ yangını', 'Restoran yangınlarının büyük bölümü ocakta, yağ kaynaklı çıkar. Suyla veya kuru kimyevi tozla müdahale yangını büyütür.' ),
				array( 'Baca ve davlumbaz yağı', 'Bacada biriken yağ, yangının mutfaktan çatıya taşınmasının ana yoludur.' ),
				array( 'Tüp gaz ve doğalgaz hattı', 'Gaz kesme mekanizması söndürme sistemiyle birlikte çalışmıyorsa yangın beslenmeye devam eder.' ),
				array( 'Sezonluk personel', 'Ekip değiştiğinde cihazı kullanmayı bilen kimse kalmayabiliyor.' ),
			),
			'sss' => array(
				array( 'Davlumbaz sistemi bize zorunlu mu?', 'Mutfağınızın kapasitesine ve binanın türüne bağlı. Keşifte kapsamda olup olmadığınızı net söylüyoruz; zorunlu olmasa bile yağ yangını riski nedeniyle öneriyoruz.' ),
				array( 'Mutfakta hangi tüp olmalı?', 'Ocak ve elektrikli ekipman hattında CO₂, ayrıca yangın battaniyesi. Salon ve depoda ABC kuru kimyevi toz.' ),
				array( 'Sezon öncesi toplu kontrol yapıyor musunuz?', 'Evet. Şarköy ve Marmaraereğlisi gibi sahil ilçelerinde nisan-mayıs döneminde randevu alan işletmelere sezon açılmadan tüm kontrolü tamamlıyoruz.' ),
			),
		),

		'okul-kres' => array(
			'ad'   => 'Okul, kreş ve yurt',
			'ozet' => 'Tahliye güzergâhına uygun cihaz yerleşimi ve yıllık kontrol',
			'ikon' => 'okul',
			'foto' => 'foto/hortum-lans.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'yangin-dolabi-hidrant', 'davlumbaz-sondurme', 'pano-ici-sondurme' ),
			'mevzuat' => array(
				array( 'Tahliye önceliği', 'Eğitim yapılarında yangın güvenliğinin esası söndürmek değil, güvenli tahliyedir. Cihaz ve dolap yerleşimi tahliye güzergâhını daraltmayacak şekilde planlanır.' ),
				array( 'Yıllık kontrol', 'Söndürme cihazlarının yılda bir kez yetkili servis tarafından yerinde kontrolü zorunludur.' ),
				array( 'Yurt ve pansiyon mutfağı', 'Toplu yemek çıkaran mutfaklar, kapasiteye göre davlumbaz otomatik söndürme kapsamına girebilir.' ),
			),
			'riskler' => array(
				array( 'Cihaz yüksekliği', 'Çocukların ulaşamayacağı, personelin tek hamlede alabileceği yükseklik dengesi çoğu binada kurulmamış oluyor.' ),
				array( 'Kapanan koridorlar', 'Dolap ve pano önleri malzeme, oyuncak veya mobilyayla kapanıyor.' ),
				array( 'Isıtma bölümü', 'Kazan dairesi ve kalorifer bölümü ayrı yangın sınıfı gerektirir.' ),
				array( 'Tatbikat eksikliği', 'Cihaz var ama kimse kullanmayı bilmiyorsa cihaz yok sayılır.' ),
			),
			'sss' => array(
				array( 'Kontrolü ne zaman yapıyorsunuz?', 'Okullarda yaz tatilinde veya dönem arasında yapmayı tercih ediyoruz; ders düzeni bozulmuyor. Tarihi eğitim takviminize göre planlayabiliriz.' ),
				array( 'Kreşte hangi ekipman gerekiyor?', 'Katlarda ABC kuru kimyevi toz, mutfakta CO₂ ve yangın battaniyesi, ısıtma bölümünde ayrı cihaz. Uyku odalarına yakın koridorda mutlaka cihaz bulunmalı.' ),
				array( 'Belge ve rapor veriyor musunuz?', 'Evet. Her cihaz için etiketli kontrol kaydı ve kuruma sunulabilecek bakım raporu düzenliyoruz.' ),
			),
		),

		'ofis-is-merkezi' => array(
			'ad'   => 'Ofis ve iş merkezleri',
			'ozet' => 'Kat planına göre cihaz sayısı, pano ve sunucu odası koruması',
			'ikon' => 'ofis',
			'foto' => 'foto/dolap-dekoratif.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'pano-ici-sondurme', 'yangin-dolabi-hidrant' ),
			'mevzuat' => array(
				array( 'Cihaz sayısı ve erişim mesafesi', 'Cihaz sayısı kat alanına göre belirlenir; her noktadan en yakın cihaza erişim mesafesi sınırlıdır. Bölmeli ofiste bu mesafe uzar, cihaz sayısı artar.' ),
				array( 'Yangın dolabı', 'Kat alanı ve bina yüksekliğine göre kat dolapları aranır.' ),
				array( 'Yıllık kontrol', 'Söndürme cihazlarının yılda bir kez yerinde kontrolü zorunludur.' ),
			),
			'riskler' => array(
				array( 'Sunucu ve pano odası', 'Kuru kimyevi toz hassas cihazlara kalıcı zarar verir; bu alanlarda CO₂ veya pano içi otomatik sistem gerekir.' ),
				array( 'Sorumluluk sınırı', 'Çok kiracılı binalarda ortak alan ile kiracı alanı sorumluluğu belirsiz kalır, kimse kontrol yaptırmaz.' ),
				array( 'Bölme değişikliği', 'Ofis düzeni değiştiğinde mevcut cihaz yerleşimi erişim mesafesini karşılamaz hale gelir.' ),
				array( 'Kesintisiz çalışan cihazlar', 'Şarj istasyonları ve UPS odaları çoğu ofiste korumasızdır.' ),
			),
			'sss' => array(
				array( 'Sunucu odasına ne koymalıyız?', 'Kuru kimyevi toz değil. CO₂ cihazı ya da kabin içine pano içi otomatik söndürme sistemi öneriyoruz; ikisi de artık bırakmaz.' ),
				array( 'Ortak alan kimin sorumluluğunda?', 'Genelde yönetimin, kat içi cihazlar kiracının. Keşif raporunda hangi cihazın hangi tarafta olduğunu ayrı ayrı listeliyoruz.' ),
				array( 'Kat planı üzerinde yerleşim veriyor musunuz?', 'Evet. Keşifte cihaz noktalarını kat planına işaretleyip teklifle birlikte gönderiyoruz.' ),
			),
		),

		'akaryakit' => array(
			'ad'   => 'Akaryakıt istasyonları',
			'ozet' => 'Yüksek kapasiteli tekerlekli cihazlar ve sıkı kontrol periyodu',
			'ikon' => 'akaryakit',
			'foto' => 'foto/kopuklu.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'arac-yangin-tupu', 'davlumbaz-sondurme', 'pano-ici-sondurme' ),
			'mevzuat' => array(
				array( 'Parlayıcı sıvı tehlike sınıfı', 'Akaryakıt istasyonları yüksek tehlike sınıfındadır; cihaz kapasitesi ve sayısı buna göre artar.' ),
				array( 'Pompa adası koruması', 'Dolum noktalarında yüksek kapasiteli tekerlekli kuru kimyevi toz cihazları bulundurulur.' ),
				array( 'Söndürme cihazı periyodu', 'Yılda bir yerinde kontrol, dört yılda bir dolum ve hidrostatik test. Dış ortamda duran cihazlarda daha sık kontrol öneriyoruz.' ),
			),
			'riskler' => array(
				array( 'Dış ortam korozyonu', 'Cihazlar yıl boyu dışarıda durur; güneş ve nem gövdede korozyona, manometrede sapmaya yol açar.' ),
				array( 'Tekerlekli cihaz mekanizması', '50 kg cihazlarda hortum ve tetik mekanizması ayrı kontrol ister, standart tüp bakımı yeterli değildir.' ),
				array( 'Market ve mutfak bölümü', 'İstasyon marketi ve varsa mutfağı ayrı yangın sınıfına girer.' ),
				array( 'Elektrik panoları', 'Pompa ve aydınlatma panoları sürekli yük altındadır.' ),
			),
			'sss' => array(
				array( 'Ne sıklıkla kontrol öneriyorsunuz?', 'Yasal periyot yılda bir olsa da dış ortamda duran cihazlar için altı ayda bir gözden geçirme öneriyoruz. Korozyon ve basınç kaybı burada daha hızlı gelişiyor.' ),
				array( '50 kg tekerlekli cihazın dolumunu yapıyor musunuz?', 'Evet. Tekerlekli cihazların dolumu, hortum ve tetik mekanizması kontrolü dahil yapılıyor.' ),
				array( 'Servis sırasında istasyon kapanıyor mu?', 'Hayır. Cihazları sırayla alıyor, yerlerine ikame bırakıyoruz.' ),
			),
		),

		'hastane-saglik' => array(
			'ad'   => 'Hastane ve sağlık tesisleri',
			'ozet' => 'Bölüm bazlı cihaz seçimi ve kesintisiz alanlarda planlı bakım',
			'ikon' => 'hastane',
			'foto' => 'foto/5kg-co2.jpg',
			'hizmetler' => array( 'yangin-tupu-dolumu', 'pano-ici-sondurme', 'yangin-dolabi-hidrant', 'davlumbaz-sondurme' ),
			'mevzuat' => array(
				array( 'Kullanıcı yükü ve tahliye', 'Sağlık yapıları, kendi başına tahliye olamayan kullanıcı barındırdığı için özel değerlendirilir; koruma ağırlığı erken müdahaleye kayar.' ),
				array( 'Yangın dolabı ve hidrant', 'Kat alanı ve bina yüksekliğine göre kat dolapları ve dış hidrant hattı aranır.' ),
				array( 'Söndürme cihazı periyodu', 'Yılda bir yerinde kontrol, dört yılda bir dolum ve hidrostatik test.' ),
			),
			'riskler' => array(
				array( 'Görüntüleme ve sunucu alanları', 'Kuru kimyevi toz hassas cihazlara kalıcı zarar verir; bu alanlarda CO₂ veya pano içi sistem gerekir.' ),
				array( 'Oksijen hattı', 'Oksijen bulunan alanlarda yangın çok hızlı büyür; müdahale ekipmanının hemen yakında olması kritiktir.' ),
				array( 'Tahliyesi zor hastalar', 'Yoğun bakım ve yatan hasta katlarında tahliye hızlı yapılamaz; cihaz hemşire deskine yakın olmalıdır.' ),
				array( 'Jeneratör ve kazan dairesi', 'Kesintisiz güç kaynağı bulunan teknik hacimler ayrı koruma ister.' ),
			),
			'sss' => array(
				array( 'Hastane çalışırken nasıl bakım yapıyorsunuz?', 'Bölüm bölüm planlıyoruz. Hangi gün hangi katta olacağımızı önceden bildiriyor, teknik müdürlükle koordineli ilerliyoruz.' ),
				array( 'Görüntüleme odasına hangi cihaz uygun?', 'Kuru kimyevi toz değil. CO₂ cihazı ya da kabin içi otomatik söndürme sistemi; ikisi de cihazlara zarar vermez.' ),
				array( 'Her bölüm için ayrı rapor veriyor musunuz?', 'Evet. Cihaz kayıtları bölüm bazında tutuluyor, raporlar bölüm bölüm teslim ediliyor.' ),
			),
		),
	);
}

function ty_ilceler() {
	return array(
		'suleymanpasa'     => array( 'ad' => 'Süleymanpaşa',     'not' => 'Tekirdağ merkez. Sahil hattındaki otel, restoran ve iş merkezleri ile kamu binalarına düzenli servis veriyoruz.' ),
		'corlu'            => array( 'ad' => 'Çorlu',            'not' => 'İlin sanayi merkezi. Çorlu ve çevresindeki üretim tesislerine haftalık düzenli servis yapıyoruz.' ),
		'cerkezkoy'        => array( 'ad' => 'Çerkezköy',        'not' => 'Çerkezköy Organize Sanayi Bölgesi ve çevresindeki fabrikalara hidrant, dolap ve cihaz bakımı.' ),
		'kapakli'          => array( 'ad' => 'Kapaklı',          'not' => 'Hızla büyüyen site ve konut projelerinde yangın dolabı ve cihaz kontrolü.' ),
		'ergene'           => array( 'ad' => 'Ergene',           'not' => 'Ergene OSB ve Velimeşe hattındaki tesislere yerinde servis.' ),
		'muratli'          => array( 'ad' => 'Muratlı',          'not' => 'Sanayi tesisleri ve tarımsal işletmelere yangın güvenliği hizmeti.' ),
		'malkara'          => array( 'ad' => 'Malkara',          'not' => 'İlçe merkezi ve köylerindeki işletmelere randevulu servis.' ),
		'hayrabolu'        => array( 'ad' => 'Hayrabolu',        'not' => 'Tarımsal işletmeler, depolar ve ilçe merkezindeki işyerlerine servis.' ),
		'saray'            => array( 'ad' => 'Saray',            'not' => 'Saray ve çevresindeki sanayi tesisleri ile işyerlerine yerinde bakım.' ),
		'sarkoy'           => array( 'ad' => 'Şarköy',           'not' => 'Otel, pansiyon ve restoranlara sezon öncesi kontrol ve dolum.' ),
		'marmaraereglisi'  => array( 'ad' => 'Marmaraereğlisi',  'not' => 'Sahil işletmeleri ve konut sitelerine yangın güvenliği hizmeti.' ),
	);
}

/** Sayfanın slug'ına göre veri getir. */
function ty_veri( $tur, $slug = null ) {
	if ( null === $slug ) {
		global $post;
		$slug = $post ? $post->post_name : '';
	}
	$liste = 'hizmet' === $tur ? ty_hizmetler() : ( 'sektor' === $tur ? ty_sektorler() : ty_ilceler() );
	return isset( $liste[ $slug ] ) ? $liste[ $slug ] : null;
}
