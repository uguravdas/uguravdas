<?php
/**
 * Ürün tipleri — yangın tüpü ve yangın dolabı alt sayfalarının verisi.
 * Master sayfa (tüp / dolap) buradan kart üretir, her tipin kendi sayfası da aynı veriden çıkar.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ty_urun_tipleri() {
	return array(

		/* ---------------- YANGIN TÜPLERİ ---------------- */

		'kuru-kimyevi-tozlu-yangin-tupu' => array(
			'grup'   => 'tup',
			'ikon'   => 'tup',
			'ad'     => 'Kuru kimyevi tozlu (ABC)',
			'kisa'   => 'Kuru kimyevi tozlu',
			'rozet'  => 'En çok satan',
			'sinif'  => 'A · B · C sınıfı',
			'ozet'   => 'En yaygın kullanılan tüp. Katı madde, yanıcı sıvı ve gaz yangınlarının üçünde birden iş görür. İşyeri, apartman, ofis ve depoda standart tercih.',
			'nerede' => 'İşyeri · apartman · ofis · depo · araç',
			'gorsel' => 'foto/6kg-kkt.jpg',
			'kap'    => array( '1 kg', '2 kg', '6 kg', '12 kg', '25 kg', '50 kg' ),
			'uzun'   => 'İçinde amonyum fosfat esaslı kuru kimyevi toz bulunur. Toz, yanan yüzeyi kaplayarak oksijenle temasını keser ve alevi bastırır. Tek bir tüple üç yangın sınıfını birden karşıladığı için mevzuatın istediği asgari donanımda çoğunlukla bu tip kullanılır.',
			'teknik' => array(
				array( 'Söndürücü madde', 'Amonyum fosfat esaslı ABC kuru kimyevi toz' ),
				array( 'İtici gaz', 'Azot (N₂)' ),
				array( 'Gövde', 'Çelik, elektrostatik toz boyalı' ),
				array( 'Çalışma basıncı', '15 bar' ),
				array( 'Test basıncı', '25 bar' ),
				array( 'Çalışma sıcaklığı', '−30 °C / +60 °C' ),
				array( 'Boşalma süresi', 'Kapasiteye göre 15–25 saniye' ),
				array( 'Standart', 'TS 862-EN 3-7 · CE' ),
			),
			'siniflar' => array(
				array( 'A', 'Katı yanıcı maddeler', 'Ahşap, kâğıt, kumaş, plastik' ),
				array( 'B', 'Yanıcı sıvılar', 'Benzin, mazot, boya, solvent' ),
				array( 'C', 'Yanıcı gazlar', 'LPG, doğalgaz, asetilen' ),
			),
			'artilar' => array(
				'Tek tüple üç yangın sınıfını karşılar',
				'Birim maliyeti en düşük seçenek',
				'−30 °C\'ye kadar çalışır, dışarıda durabilir',
			),
			'dikkat' => 'Söndürme sonrası toz kalıntısı bırakır. Elektronik cihazın, panonun ya da sunucunun bulunduğu yerde kalıntı zarar verebileceği için oralarda karbondioksitli tüp tercih edilir.',
			'sss' => array(
				array( 'İşyerime kaç kg kuru kimyevi tozlu tüp lazım?', 'Yönetmelik alana ve tehlike sınıfına göre sayı veriyor: düşük tehlikeli yerlerde her 500 m² için, orta ve yüksek tehlikeli yerlerde her 250 m² için en az bir adet 6 kg tüp. Her kat ayrıca en az bir adet istiyor. Yerinizi anlatın, listeyi çıkaralım.' ),
				array( 'ABC ne demek?', 'Tüpün hangi yangın sınıflarında etkili olduğunu gösteriyor. A katı maddeler, B yanıcı sıvılar, C yanıcı gazlar. Kuru kimyevi tozlu tüp üçünde de iş görür.' ),
				array( 'Kaç yılda bir dolum gerekiyor?', 'Yılda bir kez kontrol, dört yılda bir dolum ve hidrostatik test gerekiyor. Zamanı gelince biz arayıp hatırlatıyoruz.' ),
			),
		),

		'karbondioksitli-co2-yangin-tupu' => array(
			'grup'   => 'tup',
			'ikon'   => 'pano',
			'ad'     => 'Karbondioksitli (CO₂)',
			'kisa'   => 'Karbondioksitli',
			'rozet'  => 'Kalıntı bırakmaz',
			'sinif'  => 'B sınıfı + elektrikli ekipman',
			'ozet'   => 'Artık bırakmaz, söndürdüğü cihaza zarar vermez. Elektrik panosu, sunucu odası ve hassas ekipmanın bulunduğu her yerde kuru kimyevi toz yerine bu kullanılır.',
			'nerede' => 'Elektrik panosu · sunucu odası · laboratuvar · mutfak',
			'gorsel' => 'foto/5kg-co2.jpg',
			'kap'    => array( '2 kg', '5 kg', '10 kg', '25 kg', '50 kg' ),
			'uzun'   => 'Basınç altında sıvılaştırılmış karbondioksit içerir. Boşalırken ortamdaki oksijen oranını düşürür ve yüzeyi ani soğutur. Geriye toz, köpük ya da sıvı bırakmadığı için elektronik ekipmanın bulunduğu alanlarda tek makul seçenek genelde budur.',
			'teknik' => array(
				array( 'Söndürücü madde', 'Sıvılaştırılmış karbondioksit (CO₂)' ),
				array( 'İtici gaz', 'Kendi buhar basıncı' ),
				array( 'Gövde', 'Dikişsiz çelik, yüksek basınç tüpü' ),
				array( 'Test basıncı', '250 bar' ),
				array( 'Çalışma sıcaklığı', '−30 °C / +60 °C' ),
				array( 'Boşalma süresi', 'Kapasiteye göre 8–15 saniye' ),
				array( 'Manometre', 'Yok — doluluk tartılarak kontrol edilir' ),
				array( 'Standart', 'TS 862-EN 3-7 · CE' ),
			),
			'siniflar' => array(
				array( 'B', 'Yanıcı sıvılar', 'Boya, solvent, yakıt' ),
				array( 'E', 'Elektrikli ekipman', 'Pano, sunucu, UPS, makine' ),
			),
			'artilar' => array(
				'Kalıntı bırakmaz, cihaza zarar vermez',
				'Elektrik altındaki ekipmanda güvenle kullanılır',
				'Söndürme sonrası temizlik gerektirmez',
			),
			'dikkat' => 'Kapalı ve dar hacimlerde oksijeni düşürdüğü için kullandıktan sonra ortam havalandırılmalıdır. Boşalma sırasında hortum ve borusu aşırı soğur, tutamağından tutulmalıdır.',
			'sss' => array(
				array( 'Panoya kuru kimyevi tozlu tüp koyabilir miyim?', 'Koyabilirsiniz ama tavsiye etmiyoruz. Toz kalıntısı pano içindeki kontakları ve kartları bozabilir; yangını söndürseniz bile panoyu komple değiştirmek zorunda kalabilirsiniz. Pano ve sunucu tarafında karbondioksitli tüp kullanılır.' ),
				array( 'Mutfakta CO₂ yeterli mi?', 'Ocak üstü yağ yangınları için tek başına yeterli değil. Ticari mutfaklarda davlumbaz söndürme sistemi ve yangın battaniyesiyle birlikte düşünülmesi gerekiyor.' ),
				array( 'CO₂ tüpün dolumu nasıl anlaşılır?', 'Karbondioksitli tüpte manometre bulunmaz, doluluk tartılarak kontrol edilir. Yıllık kontrolde tartıp kayda geçiriyoruz.' ),
			),
		),

		'kopuklu-eko-biyolojik-yangin-tupu' => array(
			'grup'   => 'tup',
			'ikon'   => 'ocak',
			'ad'     => 'Köpüklü ve eko biyolojik',
			'kisa'   => 'Köpüklü / eko biyolojik',
			'rozet'  => 'Doğa dostu',
			'sinif'  => 'A · B sınıfı',
			'ozet'   => 'Yanıcı sıvı yangınlarında yüzeyi örterek söndürür. Eko biyolojik seçenek çevreye ve insana zararsız içerikle üretilir, gıda üretim alanlarında tercih edilir.',
			'nerede' => 'Boya · yakıt · gıda üretimi · atölye',
			'gorsel' => 'foto/kopuklu.jpg',
			'kap'    => array( '2 kg', '6 kg', '9 kg', '25 kg', '50 kg' ),
			'uzun'   => 'Su bazlı köpük, yanan sıvının yüzeyinde film oluşturarak buharlaşmayı ve oksijen temasını keser. Eko biyolojik modeller zararsız içerikle üretilir, artık bırakmaz ve yeniden alevlenmeyi önler; gıda üretim alanlarında ve insanın yoğun bulunduğu yerlerde bu yüzden tercih edilir.',
			'teknik' => array(
				array( 'Söndürücü madde', 'Su bazlı köpük / eko biyolojik solüsyon' ),
				array( 'İtici gaz', 'Azot (N₂)' ),
				array( 'Gövde', 'Çelik, elektrostatik toz boyalı' ),
				array( 'Çalışma basıncı', '15 bar' ),
				array( 'Test basıncı', '25 bar' ),
				array( 'Çalışma sıcaklığı', '+5 °C / +60 °C' ),
				array( 'Boşalma süresi', 'Kapasiteye göre 15–25 saniye' ),
				array( 'Standart', 'TS 862-EN 3-7 · CE' ),
			),
			'siniflar' => array(
				array( 'A', 'Katı yanıcı maddeler', 'Ahşap, kâğıt, kumaş' ),
				array( 'B', 'Yanıcı sıvılar', 'Boya, yakıt, alkol' ),
				array( 'F', 'Bitkisel ve hayvansal yağlar', 'Mutfak tipi modellerde' ),
			),
			'artilar' => array(
				'Yeniden alevlenmeyi önler',
				'Hassas ekipmana ve gıdaya zarar vermez',
				'Söndürme sonrası temizliği kolay',
			),
			'dikkat' => 'Su bazlı olduğu için donma riski bulunan açık alanlarda ve soğuk depolarda uygun değildir. F sınıfı mutfak modelleri ayrı üretilir, sipariş verirken belirtin.',
			'sss' => array(
				array( 'Eko biyolojik tüp gerçekten zararsız mı?', 'İçeriği insana ve çevreye zararsız olacak şekilde üretiliyor, artık bırakmıyor. Yine de bir yangın söndürme cihazı; kapalı alanda boşalttıktan sonra ortamı havalandırın.' ),
				array( 'Gıda üretim alanında hangisini kullanmalıyım?', 'Üretim hattında ve depoda eko biyolojik ya da köpüklü tüp, elektrik panolarında karbondioksitli tüp, ocak hattı varsa davlumbaz söndürme sistemi. Yerinizi anlatın, kalem kalem çıkaralım.' ),
				array( 'Köpüklü tüp dışarıda kalabilir mi?', 'Donma riski olan yerlerde kalmamalı. Açık saha ve soğuk depolarda kuru kimyevi tozlu tüp kullanılır.' ),
			),
		),

		'arac-yangin-tupu' => array(
			'grup'   => 'tup',
			'ikon'   => 'arac',
			'ad'     => 'Araç yangın tüpü',
			'kisa'   => 'Araç tüpü',
			'rozet'  => 'Muayenede aranıyor',
			'sinif'  => 'A · B · C sınıfı · araç tipi',
			'ozet'   => 'Araçta bulundurulması kanunen zorunlu. Sürücünün erişebileceği yere sabitlenir, muayenede basıncı ve tarihi kontrol edilir.',
			'nerede' => 'Binek · ticari · minibüs · otobüs · kamyon · iş makinesi',
			'gorsel' => 'foto/arac-tupu.jpg',
			'kap'    => array( '1 kg', '2 kg', '4 kg', '6 kg' ),
			'uzun'   => 'Gövdesi ve tetik mekanizması araç titreşimine dayanacak şekilde üretilir, aparatıyla birlikte satılır. İçeriği ABC kuru kimyevi tozdur; araç yangınlarında hem koltuk ve döşeme (A), hem yakıt (B), hem de gaz hattı (C) devreye girdiği için üç sınıfı birden karşılayan tip kullanılır.',
			'teknik' => array(
				array( 'Söndürücü madde', 'ABC kuru kimyevi toz' ),
				array( 'Gövde', 'Çelik, araç titreşimine dayanıklı' ),
				array( 'Çalışma basıncı', '15 bar' ),
				array( 'Çalışma sıcaklığı', '−30 °C / +60 °C' ),
				array( 'Montaj', 'Sabitleme aparatı ile — aparat fiyata dahil' ),
				array( 'Yasal asgari', 'Toplam doldurma kapasitesi en az 1 kg kuru toz' ),
				array( 'Kontrol', 'Yılda bir kontrol, dört yılda bir dolum ve hidrostatik test' ),
				array( 'Standart', 'TS 862-EN 3-7 · CE' ),
			),
			'siniflar' => array(
				array( 'A', 'Katı yanıcı maddeler', 'Koltuk, döşeme, plastik aksam' ),
				array( 'B', 'Yanıcı sıvılar', 'Yakıt, yağ, hidrolik sıvı' ),
				array( 'C', 'Yanıcı gazlar', 'LPG ve CNG yakıt hattı' ),
			),
			'artilar' => array(
				'Aparatıyla birlikte, montaja hazır',
				'Filo alımında toplu servis ve tek seferde etiketleme',
				'Muayene öncesi basınç ve tarih kontrolünü biz yapıyoruz',
			),
			'dikkat' => 'Bagaj dibine atılan tüp yangında işe yaramaz; sürücünün oturduğu yerden uzanabileceği bir noktaya sabitlenmelidir. Muayenede cihazın sabitlenmiş olması da aranıyor.',
			'sss' => array(
				array( 'Araçta yangın tüpü zorunlu mu?', 'Evet. Karayolları Trafik Kanunu 31/1-a kapsamında araçta yönetmelikte belirtilen gereçlerin bulundurulması zorunlu; yangın söndürme cihazı bunlardan biri. Eksik ya da kullanılamaz durumda olması idari para cezası ve ceza puanı doğuruyor, muayenede de kontrol ediliyor.' ),
				array( 'Kaç kg almalıyım?', 'Yasal asgari şart toplam doldurma kapasitesi en az 1 kg kuru tozlu bir cihaz. Otomobilde 1–2 kg yeterli oluyor; minibüs ve kamyonette 2 kg, otobüs, kamyon ve çekicide 6 kg\'lık cihaz kullanılıyor. Tehlikeli madde taşıyorsanız kapasite ADR şartına göre değişir — arayın, birlikte netleştirelim.' ),
				array( 'Filom var, toplu alabilir miyim?', 'Alabilirsiniz, adet arttıkça birim fiyat düşüyor. Ayrıca filo için toplu servis yapıyoruz: araçları tek tek gezmek yerine belirlenen günde hepsinin kontrolünü ve etiketlemesini birlikte hallediyoruz.' ),
			),
		),

		/* ---------------- YANGIN DOLAPLARI ---------------- */

		'bina-ici-yangin-dolabi' => array(
			'grup'   => 'dolap',
			'ikon'   => 'dolap',
			'ad'     => 'Bina İçi Yangın Dolapları',
			'kisa'   => 'Bina içi dolap',
			'rozet'  => 'En çok satan',
			'sinif'  => 'TS EN 671-1 · 25 mm yarı sert hortum',
			'ozet'   => 'Makaraya sarılı 25 mm yarı sert hortumlu, sıva altı ya da sıva üstü dolap. Tek kişi açıp kullanabilir. Ofis, otel, hastane, okul ve apartmanın standart çözümü.',
			'nerede' => 'Ofis · otel · AVM · hastane · okul · apartman',
			'gorsel' => 'foto/dolap-bina-ici.jpg',
			'kap'    => array( 'Sıva altı', 'Sıva üstü', 'Tüp bölmeli', 'Tek kapılı', 'Çift kapılı' ),
			'uzun'   => 'Hortum bir makaraya sarılıdır ve dönerek açılır. Yarı sert yapısı sayesinde tamamını çekmeden, sadece ihtiyacınız kadarını açarak su verebilirsiniz; bu yüzden tek kişi tarafından kullanılabilir. Yönetmelik bina içlerinde bu tipi işaret eder. Tüp bölmeli modelde söndürme tüpü de aynı dolapta durur.',
			'teknik' => array(
				array( 'Standart', 'TS EN 671-1 · bakım TS EN 671-3' ),
				array( 'Hortum tipi', 'Yarı sert, makaraya sarılı' ),
				array( 'Hortum çapı', '25 mm (19 mm ve 33 mm seçenekli)' ),
				array( 'Hortum uzunluğu', 'Azami 30 m' ),
				array( 'Tasarım debisi', 'En az 100 lt/dakika' ),
				array( 'Tasarım basıncı', 'En az 400 kPa (4 bar)' ),
				array( 'Gövde', 'DKP sac, elektrostatik toz boyalı' ),
				array( 'Montaj', 'Sıva altı · sıva üstü · tüp bölmeli' ),
			),
			'artilar' => array(
				'Tek kişi açıp kullanabilir',
				'Hortumun tamamını çekmeye gerek yok',
				'Tüp bölmeli modelde iki ekipman tek noktada',
			),
			'dikkat' => 'Dolabın önü kapatılmamalı, kapağı her zaman açılabilir durumda olmalı. Yıllık kontrol ve beş yılda bir hortum basınç testi zorunlu.',
			'sss' => array(
				array( 'Binamda yangın dolabı zorunlu mu?', 'Yönetmelik şunları sayıyor: yüksek binalar, toplam kapalı alanı 1.000 m²\'yi geçen imalathane, atölye, depo, konaklama, sağlık, toplanma ve eğitim binaları, toplam alanı 600 m²\'yi geçen kapalı otoparklar ve ısıl kapasitesi 350 kW\'ın üzerindeki kazan daireleri. Bunların dışındaki yerlerde zorunlu değil.' ),
				array( 'Sıva altı mı sıva üstü mü almalıyım?', 'Duvarda yeterli derinlik varsa ve yeni yapı ise sıva altı daha derli toplu duruyor. Mevcut binada duvar kırmak istemiyorsanız sıva üstü takılır, işlevde fark yok.' ),
				array( 'Dolaplar arası mesafe ne kadar olmalı?', 'En fazla 30 metre. Binada yağmurlama sistemi varsa bu mesafe 45 metreye çıkabiliyor. Kat planını gönderin, yerleşimi biz çıkaralım.' ),
			),
		),

		'bina-disi-yangin-dolabi' => array(
			'grup'   => 'dolap',
			'ikon'   => 'fabrika',
			'ad'     => 'Bina Dışı Yangın Dolapları',
			'kisa'   => 'Bina dışı dolap',
			'rozet'  => 'Dış ortama dayanıklı',
			'sinif'  => 'TS EN 671-2 · yassı hortum · hidrant bağlantılı',
			'ozet'   => 'Açık alanda duran, contalı ve kilitli gövdeli dolap. Yassı hortumlu ve hidrant bağlantılı modellerle sanayi tesisi, açık saha ve şantiyede kullanılır.',
			'nerede' => 'Fabrika sahası · depo · şantiye · akaryakıt · tersane',
			'gorsel' => 'foto/dolap-bina-disi.jpg',
			'kap'    => array( 'Tek gözlü', 'Çift gözlü', 'Ayaklı', 'Hidrant bağlantılı', 'Kilitli' ),
			'uzun'   => 'Gövdesi yağmura, toza ve güneşe dayanacak şekilde contalı ve kilitli üretilir; ayaklı modelleri zemine sabitlenir. Genellikle yassı hortumlu (TS EN 671-2) kurulur ve dış hidrant hattına bağlanır — yangın yükünün ağır olduğu açık sahalarda yüksek debi gerektiği için.',
			'teknik' => array(
				array( 'Standart', 'TS EN 671-2 · bakım TS EN 671-3' ),
				array( 'Hortum tipi', 'Yassı, katlanabilir (itfaiye tipi)' ),
				array( 'Hortum çapı', 'Azami 50 mm' ),
				array( 'Hortum uzunluğu', 'Azami 20 m' ),
				array( 'Tasarım debisi', 'En az 400 lt/dakika' ),
				array( 'Tasarım basıncı', 'En az 400 kPa (4 bar)' ),
				array( 'Gövde', 'Contalı, kilitli, dış ortama dayanıklı boya' ),
				array( 'Montaj', 'Duvara sabit · ayaklı · hidrant yanı' ),
			),
			'artilar' => array(
				'Dış ortam koşullarına dayanıklı gövde',
				'Yüksek debi — ağır yangın yükü için yeterli',
				'Hidrant hattıyla birlikte kurulabiliyor',
			),
			'dikkat' => 'Yassı hortumun tamamı serilmeden su verilmemeli. İki kişiyle kullanılması öneriliyor, personelin bunu bilmesi gerekiyor. Donma riski olan bölgelerde hat boşaltma vanası şart.',
			'sss' => array(
				array( '671-1 mi 671-2 mi almalıyım?', 'Bina içi, ofis, otel, hastane gibi yerlerde 671-1 yarı sert hortumlu dolap. Fabrika sahası, depo, açık alan gibi yangın yükü ağır yerlerde 671-2 yassı hortumlu dolap. Emin değilseniz tesisi anlatın, projeye bakalım.' ),
				array( 'İkisi aynı tesiste olur mu?', 'Olur. Üretim alanında ve sahada 671-2, ofis blokunda 671-1 kullanılan tesis çok yaygın.' ),
				array( 'Kışın donma sorunu olur mu?', 'Hat doğru kurulmazsa olur. Bina dışı dolaplarda boşaltma vanası ve gerekiyorsa ısıtma kablosu planlıyoruz; keşifte bunu konuşuyoruz.' ),
			),
		),

		'dekoratif-yangin-dolabi' => array(
			'grup'   => 'dolap',
			'ikon'   => 'ofis',
			'ad'     => 'Dekoratif Yangın Dolapları',
			'kisa'   => 'Dekoratif dolap',
			'rozet'  => 'Özel üretim',
			'sinif'  => 'TS EN 671-1 · paslanmaz, ahşap ya da özel renk',
			'ozet'   => 'Görünürlüğün önemli olduğu yerler için. Paslanmaz, ahşap kaplama ve RAL renk seçenekleriyle mekâna uyum sağlar, standarttan ödün vermez.',
			'nerede' => 'Otel lobisi · AVM · plaza · showroom · restoran',
			'gorsel' => 'foto/dolap-dekoratif.jpg',
			'kap'    => array( 'Paslanmaz', 'Ahşap kaplama', 'RAL özel renk', 'Aynalı', 'Cam kapaklı' ),
			'uzun'   => 'İç aksamı bina içi dolapla aynıdır — 25 mm yarı sert hortum, makara, küresel vana ve lans. Fark gövdede: paslanmaz çelik, ahşap kaplama, mekânın rengine göre RAL boya ya da aynalı kapak. Standarda uygunluk aynen korunur, sadece göze batmaz.',
			'teknik' => array(
				array( 'Standart', 'TS EN 671-1 · bakım TS EN 671-3' ),
				array( 'Hortum tipi', 'Yarı sert, makaraya sarılı' ),
				array( 'Hortum çapı', '25 mm' ),
				array( 'Hortum uzunluğu', 'Azami 30 m' ),
				array( 'Gövde', 'Paslanmaz · ahşap kaplama · RAL özel renk' ),
				array( 'Kapak', 'Cam, ayna ya da tam kapalı panel' ),
				array( 'Ölçü', 'Projeye göre özel ölçü üretilebilir' ),
				array( 'Teslim', 'Özel üretim, teslim süresi teklifte netleşir' ),
			),
			'artilar' => array(
				'Mekâna uyar, standarttan ödün vermez',
				'Projeye göre özel ölçü ve renk',
				'Paslanmaz gövde nemli ortamda pas yapmaz',
			),
			'dikkat' => 'Dekoratif kapak, dolabın acil durumda kolayca açılmasını engellememeli. Kapağın üzerinde yangın dolabı işareti bulunması gerekiyor — dekoratif diye işareti kaldırmak denetimde sorun çıkarır.',
			'sss' => array(
				array( 'Dekoratif dolap denetimden geçer mi?', 'İç aksamı standarda uygunsa ve kapağında yangın dolabı işareti varsa geçer. Biz zaten TS EN 671-1 iç aksamıyla üretiyoruz; fark sadece gövdede.' ),
				array( 'Özel renk ve ölçü mümkün mü?', 'Mümkün. RAL kodunu ya da mekândan bir fotoğraf gönderin, ölçüyü keşifte alalım. Özel üretim olduğu için teslim süresi standart dolaptan uzun.' ),
				array( 'Fiyat farkı ne kadar?', 'Gövde malzemesine göre değişiyor — ahşap kaplama ve paslanmaz en çok fark edeni. Net rakamı ölçü ve malzeme belli olunca veriyoruz.' ),
			),
		),

		'kopuklu-yangin-dolabi' => array(
			'grup'   => 'dolap',
			'ikon'   => 'akaryakit',
			'ad'     => 'Köpüklü Yangın Dolapları',
			'kisa'   => 'Köpüklü dolap',
			'rozet'  => 'Yanıcı sıvı için',
			'sinif'  => 'Köpük tankı ve karıştırıcılı · B sınıfı',
			'ozet'   => 'Su hattına köpük konsantresi karıştıran dolap. Yanıcı sıvı yangınlarında su tek başına işe yaramadığı için akaryakıt, boya ve kimya tesislerinde bu tip kullanılır.',
			'nerede' => 'Akaryakıt · boya · kimya · yağ · yanıcı sıvı deposu',
			'gorsel' => 'foto/dolap-kopuklu.jpg',
			'kap'    => array( 'Tank hacmine göre', 'Sıva üstü', 'Bina dışı', 'Ayaklı', 'Hidrant bağlantılı' ),
			'uzun'   => 'Dolabın içinde köpük konsantresi tankı ve karıştırma ünitesi bulunur; su hattından geçen suya belirli oranda konsantre karışır ve lanstan köpük olarak çıkar. Köpük, yanan sıvının yüzeyini örterek buharlaşmayı ve oksijen temasını keser — yanıcı sıvı yangınında suyun yapamadığı şey budur.',
			'teknik' => array(
				array( 'Standart', 'TS EN 671-1 / 671-2 gövde · bakım TS EN 671-3' ),
				array( 'Söndürücü', 'Su + köpük konsantresi karışımı' ),
				array( 'Karışım oranı', 'Konsantre tipine göre %1 – %6' ),
				array( 'Etkili sınıf', 'B sınıfı (yanıcı sıvı), A sınıfında da etkili' ),
				array( 'Tank', 'Konsantre tankı, hacmi projeye göre' ),
				array( 'Hortum', '25 mm yarı sert ya da 50 mm yassı' ),
				array( 'Gövde', 'DKP sac ya da dış ortam tipi contalı gövde' ),
				array( 'Montaj', 'Sıva üstü · ayaklı · bina dışı' ),
			),
			'artilar' => array(
				'Yanıcı sıvı yangınında su tek başına yetmez, bu yeter',
				'Yeniden alevlenmeyi önler',
				'Mevcut su hattına bağlanabiliyor',
			),
			'dikkat' => 'Köpük konsantresinin de raf ömrü var; yıllık kontrolde konsantre seviyesi ve tarihi kontrol ediliyor. Tesisteki sıvının cinsine göre doğru konsantre tipini seçmek gerekiyor — hangi kimyasalla çalıştığınızı bize söyleyin.',
			'sss' => array(
				array( 'Normal dolap yerine bunu mu almalıyım?', 'Tesiste yanıcı sıvı varsa evet. Benzin, mazot, boya, solvent, yağ gibi maddelerin bulunduğu yerde su yangını söndürmez, hatta yayabilir. Diğer alanlarda normal dolap yeterli.' ),
				array( 'Konsantre bitince ne oluyor?', 'Konsantreyi biz tedarik ediyoruz ve yıllık kontrolde seviyesine bakıyoruz. Bitmeden haber veriyoruz.' ),
				array( 'Mevcut dolabımı köpüklüye çevirebilir misiniz?', 'Çoğu zaman evet — hattın basıncı ve dolabın hacmi uygunsa karıştırma ünitesi ve tank eklenebiliyor. Mevcut dolabın fotoğrafını gönderin, bakalım.' ),
			),
		),

		'yangin-malzeme-dolabi' => array(
			'grup'   => 'dolap',
			'ikon'   => 'belge',
			'ad'     => 'Yangın Malzeme Dolapları',
			'kisa'   => 'Malzeme dolabı',
			'rozet'  => 'Ekipman deposu',
			'sinif'  => 'Müdahale ekipmanı · su hattı bağlantısız',
			'ozet'   => 'Hortum, lans, balta, kanca, battaniye ve solunum setinin tek noktada saklandığı dolap. Su hattına bağlanmaz; yangın ekibinin malzeme deposudur.',
			'nerede' => 'Fabrika · liman · şantiye · depo · tesis yangın ekibi',
			'gorsel' => 'foto/dolap-malzeme.jpg',
			'kap'    => array( 'Tek kapılı', 'Çift kapılı', 'Camlı', 'Raflı', 'Bina dışı' ),
			'uzun'   => 'Yangın ekibinin ihtiyaç duyduğu ekipman dağınık durduğunda müdahale gecikiyor. Malzeme dolabı bunların hepsini müdahale noktasında, camlı ve etiketli şekilde bir arada tutar. İçeriğini tesisin risklerine göre birlikte belirliyoruz.',
			'teknik' => array(
				array( 'Kullanım', 'Müdahale ekipmanı saklama — su bağlantısı yok' ),
				array( 'Gövde', 'DKP sac, elektrostatik toz boyalı' ),
				array( 'Kapak', 'Camlı ya da tam panel, kilitli seçenek' ),
				array( 'İç düzen', 'Raflı, askılı, ekipmana göre bölmeli' ),
				array( 'Tipik içerik', 'Yedek hortum, lans, balta, kanca, battaniye' ),
				array( 'Ek içerik', 'Solunum seti, eldiven, el feneri, ilk yardım' ),
				array( 'Ölçü', 'Standart ve projeye göre özel ölçü' ),
				array( 'Montaj', 'Bina içi · bina dışı contalı gövde' ),
			),
			'artilar' => array(
				'Ekipman müdahale noktasında, dağınık değil',
				'Camlı kapak — ne olduğu dışarıdan görünür',
				'İçeriği tesisin riskine göre seçiliyor',
			),
			'dikkat' => 'Dolabın içindeki malzeme de kontrole tabi. Yıllık kontrolde eksik ve son kullanma tarihi geçmiş malzemeyi çıkarıp listeliyoruz — dolu görünen ama içi eksik dolap, denetimde de yangında da işe yaramıyor.',
			'sss' => array(
				array( 'İçine ne konmalı?', 'Tesisin riskine göre değişiyor. Tipik içerik: yedek hortum, lans, balta, kanca, yangın battaniyesi, eldiven, el feneri. Kimyasal varsa solunum seti de ekleniyor. Keşifte birlikte belirliyoruz.' ),
				array( 'Malzemeyi de siz mi veriyorsunuz?', 'Evet, dolapla birlikte içeriğini de tedarik ediyoruz. İsterseniz sadece dolabı da satın alabilirsiniz.' ),
				array( 'Yangın dolabı yerine geçer mi?', 'Geçmez. Malzeme dolabının su bağlantısı yoktur, yönetmeliğin istediği yangın dolabı yerine sayılmaz. İkisi birbirini tamamlar.' ),
			),
		),
	);
}

/** Bir gruba ait tipleri getirir: 'tup' ya da 'dolap'. */
function ty_tipler( $grup ) {
	$cikti = array();
	foreach ( ty_urun_tipleri() as $slug => $tip ) {
		if ( $grup === $tip['grup'] ) { $cikti[ $slug ] = $tip; }
	}
	return $cikti;
}

/** Eski isim — tüp satış sayfası bunu kullanıyor. */
function ty_tup_tipleri() {
	return ty_tipler( 'tup' );
}

function ty_dolap_tipleri() {
	return ty_tipler( 'dolap' );
}

/** Sayfanın kısa adına göre tip verisi. */
function ty_urun_tipi( $slug = null ) {
	if ( null === $slug ) {
		global $post;
		$slug = $post ? $post->post_name : '';
	}
	$tipler = ty_urun_tipleri();
	return isset( $tipler[ $slug ] ) ? $tipler[ $slug ] : null;
}

/** Bir tip sayfasının kardeşleri (aynı gruptaki diğer tipler). */
function ty_tip_kardesler( $slug ) {
	$tip = ty_urun_tipi( $slug );
	if ( ! $tip ) { return array(); }
	$liste = ty_tipler( $tip['grup'] );
	unset( $liste[ $slug ] );
	return $liste;
}

/** Master sayfa bilgisi — tip sayfalarındaki kırıntı yolu için. */
function ty_tip_master( $grup ) {
	return 'dolap' === $grup
		? array( 'ad' => 'Yangın dolabı', 'slug' => 'yangin-dolabi-hidrant' )
		: array( 'ad' => 'Yangın tüpü', 'slug' => 'yangin-tupu-dolumu' );
}
