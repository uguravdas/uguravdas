/*!
 * Tekirdağ Yangın — arayüz geliştirmeleri
 * Tamamen isteğe bağlıdır: dosya yüklenmezse site aynı şekilde çalışır.
 */
(function () {
  "use strict";

  var azHareket = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ------------------------------------------------------------------
     1. Kaydırınca başlığı sabitle / gölge ver, mobil çağrı çubuğunu gizle
     ------------------------------------------------------------------ */
  var baslik = document.querySelector(".site-header");
  var cagri = document.querySelector(".callbar");
  var sonY = window.pageYOffset;
  var bekliyor = false;

  function kaydirma() {
    var y = window.pageYOffset;

    if (baslik) {
      baslik.classList.toggle("is-scrolled", y > 8);
    }

    /* aşağı kaydırırken çubuğu gizle, yukarı çıkınca geri getir */
    if (cagri) {
      if (y > sonY && y > 260) {
        cagri.classList.add("is-gizli");
      } else {
        cagri.classList.remove("is-gizli");
      }
    }

    sonY = y;
    bekliyor = false;
  }

  window.addEventListener(
    "scroll",
    function () {
      if (!bekliyor) {
        bekliyor = true;
        window.requestAnimationFrame(kaydirma);
      }
    },
    { passive: true }
  );
  kaydirma();

  /* ------------------------------------------------------------------
     2. Kaydırmayla beliren bölümler

     Güvenlik kuralı: içerik ASLA kalıcı olarak gizli kalmamalı.
     - Sayfa açılırken zaten görünen ögelere hiç dokunulmaz.
     - IntersectionObserver yoksa hiçbir şey gizlenmez.
     - Her ihtimale karşı 2,5 saniye sonra kalan her şey açılır.
     ------------------------------------------------------------------ */
  if (!azHareket && "IntersectionObserver" in window) {
    var hedefler = document.querySelectorAll(
      ".sec-head, .card, .tip-kart, .surec-adim, .stat, .hesap-serit, .sec-alt, .mevz-item, .hiz-row, .sinif-kart, .yazi-kart"
    );
    var gizlenen = [];

    function hepsiniAc() {
      gizlenen.forEach(function (el) {
        el.classList.add("ty-gorunur");
      });
      gizlenen.length = 0;
    }

    if (hedefler.length) {
      var gozlemci = new IntersectionObserver(
        function (girdiler) {
          girdiler.forEach(function (g) {
            if (!g.isIntersecting) return;
            var el = g.target;
            var gecikme = Number(el.getAttribute("data-ty-gecikme") || 0);
            el.style.transitionDelay = gecikme + "ms";
            el.classList.add("ty-gorunur");
            gozlemci.unobserve(el);
          });
        },
        { rootMargin: "200px 0px 0px 0px", threshold: 0.01 }
      );

      var altSinir = window.innerHeight;

      hedefler.forEach(function (el) {
        /* ekranda hâlihazırda görünen ögeyi hiç gizleme */
        if (el.getBoundingClientRect().top < altSinir) return;

        el.classList.add("ty-reveal");
        gizlenen.push(el);

        var kardes = el.parentNode
          ? Array.prototype.indexOf.call(el.parentNode.children, el)
          : 0;
        el.setAttribute("data-ty-gecikme", String(Math.min(kardes, 5) * 60));
        gozlemci.observe(el);
      });

      /* son emniyet: ne olursa olsun içerik görünür olsun */
      window.setTimeout(hepsiniAc, 2500);
      window.addEventListener("beforeprint", hepsiniAc);
    }
  }

  /* ------------------------------------------------------------------
     3. Mobil menü: Esc ile kapat, dışına tıklayınca kapat, masaüstüne
        geçince sıfırla. (Açma/kapama teması kendi betiğinde kalır.)
     ------------------------------------------------------------------ */
  var nav = document.getElementById("ty-nav");
  var dugme = document.querySelector(".menu-toggle");

  function menuyuKapat() {
    if (!nav || !nav.classList.contains("is-open")) return;
    nav.classList.remove("is-open");
    if (dugme) {
      dugme.setAttribute("aria-expanded", "false");
    }
    nav.querySelectorAll(".acik").forEach(function (x) {
      x.classList.remove("acik");
    });
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      menuyuKapat();
    }
  });

  document.addEventListener("click", function (e) {
    if (!nav || !nav.classList.contains("is-open")) return;
    if (nav.contains(e.target)) return;
    if (dugme && dugme.contains(e.target)) return;
    menuyuKapat();
  });

  var masaustu = window.matchMedia("(min-width: 941px)");
  (masaustu.addEventListener ? masaustu.addEventListener.bind(masaustu, "change") : masaustu.addListener.bind(masaustu))(
    function (e) {
      if (e.matches) menuyuKapat();
    }
  );
})();
