<style>
/* main styles */
*, *:before, *:after {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}
pre {
  white-space: pre;
  padding: 2px 6px;
  margin-top: 1em;
  background-color: #ddd;
  border-radius: 3px;
  overflow: auto;
}

a.primary {
  width: 100vw;
  left: 50%;
  margin-left: -50vw;
}
a.full {
  clear: both;
  width: 100%;
  box-shadow: 0 3px 4px #000;
}

a.boxout1, a.boxout2 {
  width: 100%;
}

a.boxout2 {
  float: right;
  margin: 1em -4em 0 1em;
}

/* progressive image CSS */
a.progressive {
  position: relative;
  display: block;
  overflow: hidden;
  outline: none;
}

a.progressive:not(.replace) {
  cursor: default;
}

a.progressive img {
  display: block;
  width: 100%;
  max-width: none;
  height: auto;
  border: 0 none;
}

a.progressive img.preview {
  filter: blur(2vw);
  transform: scale(1.05);
}

a.progressive img.reveal {
  position: absolute;
  left: 0;
  top: 0;
  will-change: transform, opacity;
  animation: reveal 1s ease-out;
}

@keyframes reveal {
    0% { transform: scale(1.05); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>
<script>
// progressive-image.js
if (window.addEventListener && window.requestAnimationFrame && document.getElementsByClassName) window.addEventListener('load', function() {

  // start
  var pItem = document.getElementsByClassName('progressive replace'), timer;

  window.addEventListener('scroll', scroller, false);
  window.addEventListener('resize', scroller, false);
  inView();


  // throttled scroll/resize
  function scroller(e) {

    timer = timer || setTimeout(function() {
      timer = null;
      requestAnimationFrame(inView);
    }, 300);

  }


  // image in view?
  function inView() {

    var wT = window.pageYOffset, wB = wT + window.innerHeight, cRect, pT, pB, p = 0;
    while (p < pItem.length) {

      cRect = pItem[p].getBoundingClientRect();
      pT = wT + cRect.top;
      pB = pT + cRect.height;

      if (wT < pB && wB > pT) {
        loadFullImage(pItem[p]);
        pItem[p].classList.remove('replace');
      }
      else p++;

    }

  }


  // replace with full image
  function loadFullImage(item) {

    if (!item || !item.href) return;

    // load image
    var img = new Image();
    if (item.dataset) {
      img.srcset = item.dataset.srcset || '';

    }
    img.src = item.href;
    img.className = 'reveal'; 
	img.style.padding = '-50px';
    img.style.width = '100%';
    img.style.height = '350px';


    if (img.complete) addImg();
    else img.onload = addImg;

    // replace image
    function addImg() {

      // disable click
      item.addEventListener('click', function(e) { e.preventDefault(); }, false);

      // add full image
      item.appendChild(img).addEventListener('animationend', function(e) {

        // remove preview image
        var pImg = item.querySelector && item.querySelector('img.preview');
        if (pImg) {
          e.target.alt = pImg.alt || '';
          item.removeChild(pImg);
          e.target.classList.remove('reveal');
        }

      });

    }

  }

}, false);
</script>