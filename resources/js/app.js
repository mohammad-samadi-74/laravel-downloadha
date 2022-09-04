require('./bootstrap');

//add fontawesome
require("./../../node_modules/@fortawesome/fontawesome-free/js/all.min");

//add slick
require("../../node_modules/slick-carousel/slick/slick.min")

//anime js
require("./../../node_modules/animejs/lib/anime.min")


//custom js scripts
require('./_navigation');
require('./_mediaSlider');
require('./_softSlider');
require('./_lastSofts');
require('./_sidebar');
require('./_posts');
require('./_products');
require('./_footer');

anime({
    targets: '.img-fluid',
    translateX: 250,
    rotate: '1turn',
    backgroundColor: '#FFF',
    duration: 800
});
