<?php
/**
 * Template Name: İhtiyaç hesaplayıcı
 * Dallanan akış: bina / ticari mutfak / araç / pano.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1>Yangın güvenliği ihtiyaç hesaplama</h1>
    <p class="page-lead">Ne için hesapladığınızı seçin, sorular ona göre değişsin. Binaların Yangından Korunması Hakkında Yönetmelik ve Karayolları Trafik Kanunu'na göre hangi üründen kaç adet gerektiğini çıkarıyoruz. Sonucu tek tuşla teklif formuna gönderebilirsiniz.</p>
  </div>
</section>

<section class="sec" id="hesap">
  <div class="wrap" style="max-width:880px">

    <div class="hesap" id="hesapKutu">
      <div class="hesap-ust">
        <span class="hesap-sayac"><b id="hAdim">1</b> / <b id="hTop">4</b> · <span id="hYolAd">Başlangıç</span></span>
        <div class="hesap-bar"><i id="hBar" style="width:25%"></i></div>
      </div>

      <div id="hIcerik"></div>

      <div class="hesap-alt">
        <button type="button" class="hesap-geri" id="hGeri" hidden>&larr; Geri</button>
      </div>
    </div>

    <div class="sonuc" id="sonucKutu" hidden></div>

  </div>
</section>

<?php get_template_part( 'parts/teklif', null, array(
    'baslik' => 'Listeyi gönderin, fiyatlayalım',
    'metin'  => 'Hesaplayıcının çıkardığı liste aşağıdaki forma yazılır. Adınızı ve telefonunuzu ekleyip gönderin, aynı gün fiyat dönelim.',
) ); ?>

<script>
(function(){
  "use strict";

  var C = { ek: {} };
  var gecmis = [];
  var icerik = document.getElementById('hIcerik');
  var geriBtn = document.getElementById('hGeri');

  /* ---------------- Akış tanımları ---------------- */

  var YOLLAR = {
    bina:   { ad: 'Bina / işyeri',    adimlar: ['yer','olcu','riskler'] },
    mutfak: { ad: 'Ticari mutfak',    adimlar: ['mutfakTur','mutfakOlcek','mutfakEk'] },
    arac:   { ad: 'Araç / filo',      adimlar: ['aracTur','aracAdet'] },
    pano:   { ad: 'Pano / sunucu',    adimlar: ['panoTur','panoAdet'] }
  };

  var ADIMLAR = {

    yol: {
      baslik: 'Ne için hesaplıyorsunuz?',
      yardim: 'Seçiminize göre sorular değişiyor — her yol kendi mevzuatından ilerliyor.',
      tip: 'tek', anahtar: 'yol', sutun: 2,
      secenekler: [
        { d:'bina',   a:'Bina / işyeri',    n:'Ofis, fabrika, depo, otel, okul, site' },
        { d:'mutfak', a:'Ticari mutfak',    n:'Restoran, otel mutfağı, yemekhane' },
        { d:'arac',   a:'Araç / filo',      n:'Otomobil, minibüs, kamyon, otobüs' },
        { d:'pano',   a:'Pano / sunucu',    n:'Elektrik panosu, sistem odası' }
      ]
    },

    /* ---- BİNA ---- */
    yer: {
      baslik: 'Yerin kullanım amacı ne?',
      yardim: 'Kullanım amacı tehlike sınıfını belirliyor; cihaz sayısı buradan çıkıyor.',
      tip: 'tek', anahtar: 'yer', sutun: 3,
      secenekler: [
        { d:'ofis',      a:'Ofis / dükkân',        sinif:'dusuk' },
        { d:'apartman',  a:'Site / apartman',      sinif:'dusuk' },
        { d:'okul',      a:'Okul / kreş',          sinif:'dusuk', dolapTur:true },
        { d:'saglik',    a:'Sağlık kuruluşu',      sinif:'dusuk', dolapTur:true },
        { d:'avm',       a:'Mağaza / AVM',         sinif:'orta',  dolapTur:true },
        { d:'otel',      a:'Otel / konaklama',     sinif:'orta',  dolapTur:true },
        { d:'restoran',  a:'Restoran / kafe',      sinif:'orta' },
        { d:'atolye',    a:'Atölye / imalathane',  sinif:'orta',  dolapTur:true },
        { d:'depo',      a:'Depo / lojistik',      sinif:'orta',  dolapTur:true, tekerlekli:true },
        { d:'fabrika',   a:'Fabrika / üretim',     sinif:'yuksek',dolapTur:true, tekerlekli:true },
        { d:'akaryakit', a:'Akaryakıt / kimya',    sinif:'yuksek',dolapTur:true, tekerlekli:true },
        { d:'otopark',   a:'Kapalı otopark',       sinif:'orta',  tekerlekli:true }
      ]
    },
    olcu: {
      baslik: 'Alan, kat ve yükseklik',
      yardim: 'Kapalı kullanım alanının toplamını yazın, yaklaşık olması yeterli.',
      tip: 'olcu'
    },
    riskler: {
      baslik: 'Bunlardan hangileri var?',
      yardim: 'Birden fazla seçebilirsiniz. Yoksa boş bırakıp devam edin.',
      tip: 'coklu', anahtar: 'ek', sutun: 2,
      secenekler: [
        { d:'mutfak',  a:'Ticari mutfak / ocak hattı' },
        { d:'pano',    a:'Elektrik panosu / sistem odası' },
        { d:'sivi',    a:'Yanıcı sıvı (boya, yakıt, solvent)' },
        { d:'kazan',   a:'Kazan dairesi (350 kW üstü)' },
        { d:'otopark', a:'Kapalı otopark (600 m² üstü)' },
        { d:'filo',    a:'Şirket aracı / filo' }
      ]
    },

    /* ---- MUTFAK ---- */
    mutfakTur: {
      baslik: 'Ne tür bir mutfak?',
      yardim: 'İşletme türü, davlumbaz sisteminin zorunlu olup olmadığını belirliyor.',
      tip: 'tek', anahtar: 'mutfakTur', sutun: 2,
      secenekler: [
        { d:'restoran', a:'Restoran / kafe',        n:'Bağımsız işletme' },
        { d:'otel',     a:'Otel mutfağı',           n:'Konaklama tesisi' },
        { d:'avm',      a:'AVM / food court',       n:'Alışveriş merkezi içinde', avm:true },
        { d:'yemekhane',a:'Yemekhane / catering',   n:'Okul, hastane, fabrika' }
      ]
    },
    mutfakOlcek: {
      baslik: 'Aynı anda kaç kişiye hizmet veriyor?',
      yardim: 'Yönetmelik 100 kişiyi eşik kabul ediyor; bunun üstünde davlumbaz söndürme zorunlu hale geliyor.',
      tip: 'tek', anahtar: 'kisi', sutun: 3,
      secenekler: [
        { d:'az',  a:'100 kişiden az' },
        { d:'cok', a:'100 kişi ve üzeri', yuz:true },
        { d:'bilmiyorum', a:'Emin değilim' }
      ]
    },
    mutfakEk: {
      baslik: 'Mutfakla ilgili durum',
      yardim: 'Birden fazla seçebilirsiniz.',
      tip: 'coklu', anahtar: 'ek', sutun: 2,
      secenekler: [
        { d:'yuksekBina', a:'Yüksek binada (30,50 m üstü)' },
        { d:'tupYok',     a:'Mutfakta hiç söndürme tüpü yok' },
        { d:'salon',      a:'Salon / servis alanı da var' },
        { d:'pano',       a:'Mutfakta elektrik panosu var' }
      ]
    },

    /* ---- ARAÇ ---- */
    aracTur: {
      baslik: 'Hangi sınıf araç?',
      yardim: 'Kapasite ve adet araç sınıfına göre değişiyor.',
      tip: 'tek', anahtar: 'aracTur', sutun: 2,
      secenekler: [
        { d:'otomobil', a:'Otomobil',              n:'Binek araç', kg:'1–2 kg', ad:1 },
        { d:'hafif',    a:'Minibüs / kamyonet',    n:'Ticari hafif araç', kg:'2 kg', ad:1 },
        { d:'otobus',   a:'Otobüs',                n:'Yolcu taşıma', kg:'6 kg', ad:2 },
        { d:'kamyon',   a:'Kamyon / çekici',       n:'Ağır vasıta', kg:'6 kg', ad:2 },
        { d:'adr',      a:'Tehlikeli madde (ADR)', n:'Akaryakıt, kimyasal', kg:'ADR şartına göre', ad:2, adr:true },
        { d:'is',       a:'İş makinesi',           n:'Forklift, vinç, kepçe', kg:'6 kg', ad:1 }
      ]
    },
    aracAdet: {
      baslik: 'Kaç araç?',
      yardim: 'Filo ise toplam araç sayısını yazın.',
      tip: 'sayi', anahtar: 'aracSayi', birim: 'araç',
      hizli: [1, 3, 5, 10, 25]
    },

    /* ---- PANO ---- */
    panoTur: {
      baslik: 'Neyi korumak istiyorsunuz?',
      yardim: 'Hacim ve içerik, sistemin tipini belirliyor.',
      tip: 'tek', anahtar: 'panoTur', sutun: 2,
      secenekler: [
        { d:'pano',   a:'Elektrik panosu',   n:'Dağıtım, kompanzasyon, kumanda' },
        { d:'sunucu', a:'Sunucu kabini',     n:'Rack, sistem odası' },
        { d:'ups',    a:'UPS / akü odası',   n:'Kesintisiz güç' },
        { d:'jenerator', a:'Jeneratör',      n:'Yedek güç ünitesi' }
      ]
    },
    panoAdet: {
      baslik: 'Kaç adet?',
      yardim: 'Korunacak pano ya da kabin sayısını yazın.',
      tip: 'sayi', anahtar: 'panoSayi', birim: 'adet',
      hizli: [1, 2, 4, 8, 15]
    }
  };

  /* ---------------- Akış yönetimi ---------------- */

  function suankiAkis(){
    if (!C.yol) { return ['yol']; }
    return ['yol'].concat(YOLLAR[C.yol].adimlar);
  }

  function ciz(id){
    var a = ADIMLAR[id];
    var akis = suankiAkis();
    var no = akis.indexOf(id) + 1;

    document.getElementById('hAdim').textContent = no;
    document.getElementById('hTop').textContent = akis.length;
    document.getElementById('hYolAd').textContent = C.yol ? YOLLAR[C.yol].ad : 'Başlangıç';
    document.getElementById('hBar').style.width = Math.round(no / akis.length * 100) + '%';
    geriBtn.hidden = gecmis.length === 0;

    var h = '<div class="hesap-adim"><h2>' + a.baslik + '</h2>';
    if (a.yardim) { h += '<p class="hesap-yardim">' + a.yardim + '</p>'; }

    if (a.tip === 'tek' || a.tip === 'coklu') {
      h += '<div class="secenekler' + (a.tip === 'coklu' ? ' coklu' : '') + '" style="grid-template-columns:repeat(' + (a.sutun || 3) + ',1fr)">';
      a.secenekler.forEach(function(s, i){
        var secili = (a.tip === 'coklu' && C.ek[s.d]) ? ' secili' : '';
        h += '<button type="button" data-i="' + i + '"' + secili + ' class="' + secili.trim() + '">'
           + '<b>' + s.a + '</b>' + (s.n ? '<span>' + s.n + '</span>' : '') + '</button>';
      });
      h += '</div>';
      if (a.tip === 'coklu') {
        h += '<div class="hesap-ileri"><button type="button" class="btn btn-primary" data-ileri="1">Devam et</button></div>';
      }
    }

    if (a.tip === 'sayi') {
      h += '<div class="alan-giris"><input type="number" id="hSayi" min="1" step="1" placeholder="Örn: 3" inputmode="numeric"><span>' + a.birim + '</span></div>';
      h += '<div class="hizli">';
      a.hizli.forEach(function(v){ h += '<button type="button" data-sayi="' + v + '">' + v + '</button>'; });
      h += '</div><div class="hesap-ileri"><button type="button" class="btn btn-primary" data-ileri="1">Devam et</button></div>';
    }

    if (a.tip === 'olcu') {
      h += '<label class="olcu-etiket">Kapalı alan</label>'
         + '<div class="alan-giris"><input type="number" id="hAlan" min="1" step="10" placeholder="Örn: 250" inputmode="numeric"><span>m²</span></div>'
         + '<div class="hizli">';
      [80,150,300,600,1200,3000].forEach(function(v){ h += '<button type="button" data-alan="' + v + '">' + v.toLocaleString('tr-TR') + ' m²</button>'; });
      h += '</div>'
         + '<label class="olcu-etiket">Kat sayısı</label>'
         + '<div class="hizli" id="hKat">';
      [1,2,3,4,'5+'].forEach(function(v){ h += '<button type="button" data-kat="' + (v === '5+' ? 5 : v) + '">' + v + '</button>'; });
      h += '</div>'
         + '<label class="olcu-etiket">Yapı yüksekliği 30,50 m\'yi geçiyor mu?</label>'
         + '<div class="hizli" id="hYuksek">'
         + '<button type="button" data-yuksek="0">Hayır</button>'
         + '<button type="button" data-yuksek="1">Evet, yüksek bina</button>'
         + '</div>'
         + '<div class="hesap-ileri"><button type="button" class="btn btn-primary" data-ileri="1">Devam et</button></div>';
    }

    h += '</div>';
    icerik.innerHTML = h;
    baglantilar(id, a);
    icerik.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function baglantilar(id, a){
    if (a.tip === 'tek') {
      icerik.querySelectorAll('.secenekler button').forEach(function(b){
        b.addEventListener('click', function(){
          var s = a.secenekler[+b.dataset.i];
          C[a.anahtar] = s.d;
          C[a.anahtar + 'Veri'] = s;
          ileri(id);
        });
      });
    }
    if (a.tip === 'coklu') {
      icerik.querySelectorAll('.secenekler button').forEach(function(b){
        b.addEventListener('click', function(){
          var s = a.secenekler[+b.dataset.i];
          C.ek[s.d] = !C.ek[s.d];
          b.classList.toggle('secili', !!C.ek[s.d]);
        });
      });
    }
    if (a.tip === 'sayi') {
      var inp = icerik.querySelector('#hSayi');
      icerik.querySelectorAll('[data-sayi]').forEach(function(b){
        b.addEventListener('click', function(){
          inp.value = b.dataset.sayi;
          icerik.querySelectorAll('[data-sayi]').forEach(function(x){ x.classList.remove('secili'); });
          b.classList.add('secili');
        });
      });
    }
    if (a.tip === 'olcu') {
      var al = icerik.querySelector('#hAlan');
      icerik.querySelectorAll('[data-alan]').forEach(function(b){
        b.addEventListener('click', function(){
          al.value = b.dataset.alan;
          icerik.querySelectorAll('[data-alan]').forEach(function(x){ x.classList.remove('secili'); });
          b.classList.add('secili');
        });
      });
      icerik.querySelectorAll('[data-kat]').forEach(function(b){
        b.addEventListener('click', function(){
          C.kat = +b.dataset.kat;
          icerik.querySelectorAll('[data-kat]').forEach(function(x){ x.classList.remove('secili'); });
          b.classList.add('secili');
        });
      });
      icerik.querySelectorAll('[data-yuksek]').forEach(function(b){
        b.addEventListener('click', function(){
          C.yuksek = b.dataset.yuksek === '1';
          icerik.querySelectorAll('[data-yuksek]').forEach(function(x){ x.classList.remove('secili'); });
          b.classList.add('secili');
        });
      });
    }
    var ileriBtn = icerik.querySelector('[data-ileri]');
    if (ileriBtn) {
      ileriBtn.addEventListener('click', function(){
        if (a.tip === 'sayi') {
          var v = +icerik.querySelector('#hSayi').value;
          if (!v || v < 1) { icerik.querySelector('#hSayi').focus(); return; }
          C[a.anahtar] = v;
        }
        if (a.tip === 'olcu') {
          var alan = +icerik.querySelector('#hAlan').value;
          if (!alan || alan < 1) { icerik.querySelector('#hAlan').focus(); return; }
          C.alan = alan;
          if (!C.kat) { C.kat = 1; }
        }
        ileri(id);
      });
    }
  }

  function ileri(id){
    gecmis.push(id);
    var akis = suankiAkis();
    var i = akis.indexOf(id);
    if (i === akis.length - 1) { sonuc(); }
    else { ciz(akis[i + 1]); }
  }

  geriBtn.addEventListener('click', function(){
    var onceki = gecmis.pop();
    if (!onceki) { return; }
    document.getElementById('sonucKutu').hidden = true;
    document.getElementById('hesapKutu').hidden = false;
    ciz(onceki);
  });

  /* ---------------- Hesap ---------------- */

  function kalem(ad, adet, aciklama, dayanak, zorunlu){
    return { ad: ad, adet: adet, aciklama: aciklama, dayanak: dayanak, zorunlu: zorunlu !== false };
  }

  function hesapBina(){
    var L = [], notlar = [];
    var veri = C.yerVeri || {};
    var bolen = veri.sinif === 'dusuk' ? 500 : 250;
    var alanAdet = Math.ceil(C.alan / bolen);
    var adet = Math.max(alanAdet, C.kat, 1);

    L.push(kalem('6 kg ABC kuru kimyevi tozlu söndürme cihazı', adet + ' adet',
      veri.sinif === 'dusuk'
        ? 'Düşük tehlike sınıfı: her 500 m² için en az 1 adet. Kat sayısı bundan fazlaysa her kata en az 1 adet.'
        : 'Orta/yüksek tehlike sınıfı: her 250 m² için en az 1 adet. Kat sayısı bundan fazlaysa her kata en az 1 adet.',
      'BYKHY Madde 99'));

    notlar.push('Cihazlara ulaşma mesafesi 25 metreyi geçmemeli; 4–12 kg cihazlar zeminden en fazla 90 cm yüksekliğe monte edilir.');

    if (veri.tekerlekli || C.ek.otopark) {
      L.push(kalem('50 kg tekerlekli kuru kimyevi tozlu cihaz', '1 adet',
        'Otopark, depo ve tesisat dairelerinde tekerlekli tip cihaz bulundurulması gerekiyor.',
        'BYKHY Madde 99'));
    }
    if (C.ek.pano) {
      L.push(kalem('5 kg karbondioksitli (CO₂) cihaz', Math.max(1, Math.ceil(C.kat / 2)) + ' adet',
        'Elektrik panosu ve sistem odasında kuru kimyevi toz kalıntı bırakıp cihaza zarar verdiği için CO₂ kullanılır.',
        'BYKHY Madde 99 — C sınıfı ve elektrikli ekipman'));
      L.push(kalem('Pano içi otomatik söndürme tüpü', 'Pano başına 1 adet',
        'Panonun içine monte edilir, sıcaklıkla kendiliğinden boşalır. Yönetmelikte adıyla zorunlu tutulmuyor; elektrik kaynaklı yangının en sık başladığı yer olduğu için öneriyoruz.',
        'Öneri — zorunlu değil', false));
    }
    if (C.ek.sivi) {
      L.push(kalem('6 kg köpüklü / eko biyolojik cihaz', Math.max(1, Math.ceil(adet / 3)) + ' adet',
        'Yanıcı sıvı (B sınıfı) yangınında yüzeyi örterek söndürür, yeniden alevlenmeyi önler.',
        'BYKHY Madde 99 — B sınıfı'));
    }
    if (C.ek.mutfak) {
      L.push(kalem('5 kg karbondioksitli cihaz (mutfak)', '1 adet', 'Ocak hattı ve mutfak elektriği için.', 'BYKHY Madde 99'));
      L.push(kalem('Yangın battaniyesi', '1 adet', 'Ocak üstü küçük yağ yangınına ilk müdahale için.', 'Öneri', false));
      if (C.yuksek) {
        L.push(kalem('Davlumbaz otomatik söndürme sistemi', 'Davlumbaz hattına göre',
          'Yüksek binalarda yer alan mutfaklarda ve aynı anda 100\'den fazla kişiye hizmet veren mutfaklarda davlumbaza otomatik söndürme sistemi kurulması zorunlu.',
          'BYKHY Madde 41'));
      } else {
        notlar.push('Mutfak aynı anda 100\'den fazla kişiye hizmet veriyorsa davlumbaz otomatik söndürme sistemi zorunlu hale geliyor (Madde 41). Emin değilseniz arayın.');
      }
    }
    if (C.ek.kazan) {
      L.push(kalem('6 kg çok maksatlı kuru kimyevi tozlu cihaz (kazan dairesi)', '1 adet',
        'Kazan dairesinde en az bir adet bulundurulması gerekiyor.',
        'BYKHY Madde 54'));
    }

    /* Yangın dolabı */
    var dolapZorunlu = C.yuksek
      || (veri.dolapTur && C.alan > 1000)
      || (C.ek.otopark && C.alan > 600)
      || C.ek.kazan;
    if (dolapZorunlu) {
      var dolapAdet = Math.max(C.kat, Math.ceil(C.alan / 900), 1);
      L.push(kalem('Yangın dolabı', dolapAdet + ' adet (yaklaşık)',
        'Her katta ve yangın bölmesinde, dolaplar arası uzaklık 30 metreyi geçmeyecek şekilde. Yağmurlama sistemi varsa bu mesafe 45 metreye çıkabiliyor. Kesin adet kat planından çıkar.',
        'BYKHY Madde 94'));
      notlar.push('Bina içinde TS EN 671-1 yarı sert hortumlu (25 mm), üretim alanı ve açık sahada TS EN 671-2 yassı hortumlu (50 mm) dolap kullanılır.');
    } else {
      notlar.push('Girdiğiniz bilgilere göre yangın dolabı zorunlu görünmüyor. Zorunluluk yüksek binalarda, 1.000 m² üstü imalathane/atölye/depo/konaklama/sağlık/toplanma/eğitim binalarında, 600 m² üstü kapalı otoparklarda ve 350 kW üstü kazan dairelerinde doğuyor (Madde 94).');
    }

    if (C.alan > 5000) {
      L.push(kalem('Hidrant sistemi', 'Projeye göre',
        'Toplam kapalı alanı 5.000 m²\'yi geçen binalarda hidrant sistemi kurulması gerekiyor. Tasarım debisi en az 1.900 lt/dk, basınç 700 kPa.',
        'BYKHY Madde 95'));
    }
    if (C.ek.filo) {
      notlar.push('Şirket araçlarınız için ayrıca hesap gerekiyor — hesaplayıcıyı "Araç / filo" yolundan bir kez daha çalıştırın.');
    }

    return { liste: L, notlar: notlar, ozet: 'Yaklaşık ' + C.alan.toLocaleString('tr-TR') + ' m², ' + C.kat + ' kat, ' +
      (veri.sinif === 'dusuk' ? 'düşük' : veri.sinif === 'orta' ? 'orta' : 'yüksek') + ' tehlike sınıfı' + (C.yuksek ? ', yüksek bina' : '') + '.' };
  }

  function hesapMutfak(){
    var L = [], notlar = [];
    var yuz = (C.kisiVeri && C.kisiVeri.yuz);
    var avm = (C.mutfakTurVeri && C.mutfakTurVeri.avm);
    var yuksekBina = !!C.ek.yuksekBina;
    var zorunlu = yuz || yuksekBina || avm;

    if (zorunlu) {
      L.push(kalem('Davlumbaz otomatik söndürme sistemi', 'Davlumbaz uzunluğuna göre projelendirilir',
        'Yüksek binalarda yer alan mutfaklarda ve aynı anda 100\'den fazla kişiye hizmet veren mutfaklarda zorunlu. Sistem ayrıca gaz kesme mekanizmasıyla birlikte kurulur.',
        'BYKHY Madde 41'));
    } else {
      L.push(kalem('Davlumbaz otomatik söndürme sistemi', 'Önerilir',
        'Girdiğiniz bilgilere göre zorunlu görünmüyor: zorunluluk yüksek binadaki mutfaklarda ve 100+ kişiye hizmet veren mutfaklarda doğuyor. Yine de ocak üstü yağ yangını en hızlı büyüyen yangın türü.',
        'Öneri — Madde 41 eşiğinin altında', false));
    }

    L.push(kalem('5 kg karbondioksitli (CO₂) cihaz', '1 adet',
      'Mutfak elektriği ve ocak hattı için. Kalıntı bırakmadığı için gıda alanında tercih edilir.', 'BYKHY Madde 99'));
    L.push(kalem('Yangın battaniyesi', '1 adet',
      'Tencere ve tava yangınına ilk müdahale. Ocak hattının yanına asılır.', 'Öneri', false));

    if (C.ek.tupYok || C.ek.salon) {
      L.push(kalem('6 kg ABC kuru kimyevi tozlu cihaz', (C.ek.salon ? '2 adet' : '1 adet'),
        'Mutfak ve servis alanı için genel amaçlı cihaz. Kesin sayı alan üzerinden çıkar.', 'BYKHY Madde 99'));
    }
    if (C.ek.pano) {
      L.push(kalem('Pano içi otomatik söndürme tüpü', '1 adet',
        'Mutfak panosu nem ve yağ buharı nedeniyle riskli. Yönetmelikte adıyla zorunlu değil, öneriyoruz.',
        'Öneri — zorunlu değil', false));
    }

    notlar.push('Salon, depo ve diğer alanlar için cihaz sayısı metrekare üzerinden ayrıca hesaplanır — hesaplayıcıyı "Bina / işyeri" yolundan da çalıştırın.');
    notlar.push('Davlumbaz sistemi kurulurken mutfağın gaz hattına otomatik kesme mekanizması da isteniyor (Madde 41).');

    return { liste: L, notlar: notlar, ozet: (C.mutfakTurVeri ? C.mutfakTurVeri.a : 'Ticari mutfak') +
      ', ' + (yuz ? '100+ kişi' : C.kisi === 'az' ? '100 kişiden az' : 'ölçek belirsiz') + (yuksekBina ? ', yüksek binada' : '') + '.' };
  }

  function hesapArac(){
    var L = [], notlar = [];
    var v = C.aracTurVeri || {};
    var n = C.aracSayi || 1;
    var toplam = (v.ad || 1) * n;

    L.push(kalem('Araç yangın söndürme cihazı (' + v.kg + ')', toplam + ' adet',
      v.adr
        ? 'Tehlikeli madde taşımacılığında kapasite ve adet aracın azami yüklü ağırlığına göre değişiyor. Taşıdığınız maddeyi ve araç ağırlığını söyleyin, ADR şartına göre birlikte netleştirelim.'
        : 'Araç başına ' + (v.ad || 1) + ' adet × ' + n + ' araç. Sürücünün kolayca erişebileceği, hava şartlarından korunan bir yere sabitlenir.',
      'Karayolları Trafik Kanunu 31/1-a'));

    L.push(kalem('Sabitleme aparatı', toplam + ' adet',
      'Cihazın araç içinde savrulmaması için. Muayenede cihazın sabitlenmiş olması da aranıyor.',
      'Öneri', false));

    notlar.push('Yönetmelik asgari şart olarak toplam doldurma kapasitesi en az 1 kg kuru tozlu, en az bir adet cihaz istiyor; ağır vasıta ve yolcu taşıyan araçlarda kapasite artıyor.');
    notlar.push('Eksik ya da süresi geçmiş cihaz 31/1-a\'dan idari para cezası ve 10 ceza puanı doğuruyor; TÜVTÜRK muayenesinde de kontrol ediliyor.');
    notlar.push('Araç tüplerinde de yılda bir kontrol, dört yılda bir dolum ve hidrostatik test gerekiyor. Filo için toplu servis yapıyoruz.');

    return { liste: L, notlar: notlar, ozet: n + ' adet ' + (v.a || 'araç').toLowerCase() + '.' };
  }

  function hesapPano(){
    var L = [], notlar = [];
    var n = C.panoSayi || 1;
    var v = C.panoTurVeri || {};

    L.push(kalem('Pano içi otomatik söndürme tüpü', n + ' adet',
      'Panonun içine monte edilir, elektrik gerekmeden sıcaklıkla kendiliğinden boşalır. Kapasite pano hacmine göre seçilir.',
      'Öneri — yönetmelikte adıyla zorunlu değil', false));

    L.push(kalem('5 kg karbondioksitli (CO₂) cihaz', Math.max(1, Math.ceil(n / 4)) + ' adet',
      'Elle müdahale için. Kuru kimyevi toz kalıntısı kartları ve kontakları bozduğu için pano ve sunucu tarafında CO₂ kullanılır.',
      'BYKHY Madde 99 — elektrikli ekipman'));

    if (C.panoTur === 'sunucu' || C.panoTur === 'ups') {
      notlar.push('Sistem odası ve UPS odası hacimce büyükse pano içi tüp yerine oda tipi temiz gazlı söndürme sistemi konuşulmalı. Odanın ölçüsünü söyleyin, birlikte bakalım.');
    }
    if (C.panoTur === 'jenerator') {
      notlar.push('Jeneratör odasında yakıt bulunduğu için B sınıfı da devreye giriyor; köpüklü cihaz eklenmesi gerekebilir.');
    }
    notlar.push('Pano içi söndürme yönetmelikte adıyla zorunlu tutulmuyor. Buna rağmen öneriyoruz: elektrik kaynaklı yangınların büyük kısmı panoda başlıyor ve kimse yokken çıkıyor.');
    notlar.push('Binanın geneli için cihaz sayısı ayrıca metrekare üzerinden hesaplanır — "Bina / işyeri" yolunu da çalıştırın.');

    return { liste: L, notlar: notlar, ozet: n + ' adet ' + (v.a || 'pano').toLowerCase() + '.' };
  }

  function sonuc(){
    var r = C.yol === 'bina' ? hesapBina()
          : C.yol === 'mutfak' ? hesapMutfak()
          : C.yol === 'arac' ? hesapArac()
          : hesapPano();

    var h = '<span class="eyebrow">Sonuç</span><h2>İhtiyaç listeniz hazır</h2>'
          + '<p class="sonuc-ozet">' + r.ozet + '</p><div class="sonuc-liste">';

    r.liste.forEach(function(k){
      h += '<div class="sonuc-kalem' + (k.zorunlu ? '' : ' sonuc-oneri') + '">'
         + '<div class="sonuc-kalem-ust"><h3>' + k.ad + '</h3><b>' + k.adet + '</b></div>'
         + '<p>' + k.aciklama + '</p>'
         + '<span class="sonuc-dayanak">' + (k.zorunlu ? '' : '★ ') + k.dayanak + '</span>'
         + '</div>';
    });
    h += '</div>';

    if (r.notlar.length) {
      h += '<div class="sonuc-notlar"><h3>Bilmeniz gerekenler</h3><ul>';
      r.notlar.forEach(function(n){ h += '<li>' + n + '</li>'; });
      h += '</ul></div>';
    }

    h += '<div class="sonuc-cta">'
       + '<button type="button" class="btn btn-primary" id="sGonder">Bu listeyi teklife gönder</button>'
       + '<a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-hesap"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>'
       + '<button type="button" class="btn btn-line" id="sBastan">Baştan hesapla</button>'
       + '</div>'
       + '<p class="sonuc-not">Bu liste yönetmeliğin asgari şartlarına göre çıkarılmış bir ön hesaptır; kat planı, yangın bölmeleri ve tesisin özel riskleri sonucu değiştirebilir. Keşif ücretsiz — yerinde bakıp kesinleştiriyoruz. ★ işaretli kalemler zorunlu değil, önerimizdir.</p>';

    document.getElementById('hesapKutu').hidden = true;
    var kutu = document.getElementById('sonucKutu');
    kutu.innerHTML = h;
    kutu.hidden = false;
    kutu.scrollIntoView({ behavior: 'smooth', block: 'start' });

    document.getElementById('sBastan').addEventListener('click', function(){
      C = { ek: {} }; gecmis = [];
      kutu.hidden = true;
      document.getElementById('hesapKutu').hidden = false;
      ciz('yol');
    });

    document.getElementById('sGonder').addEventListener('click', function(){
      var a = document.querySelector('#teklif textarea');
      if (a) {
        var t = 'İhtiyaç hesaplayıcı sonucu (' + YOLLAR[C.yol].ad + ')\n' + r.ozet + '\n\n';
        r.liste.forEach(function(k){ t += '• ' + k.ad + ' — ' + k.adet + (k.zorunlu ? '' : ' (öneri)') + '\n'; });
        a.value = t;
      }
      document.getElementById('teklif').scrollIntoView({ behavior: 'smooth' });
      setTimeout(function(){ var ad = document.querySelector('#teklif input'); if (ad) { ad.focus(); } }, 600);
    });
  }

  ciz('yol');
})();
</script>

<?php get_footer(); ?>
