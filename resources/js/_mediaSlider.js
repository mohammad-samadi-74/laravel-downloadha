$(document).ready(function(){


    $('.media-slider').slick({
        dots: true,
        arrows: false,
        speed: 1200,
        slidesToShow: 6,
        slidesToScroll: 6,
        focusOnSelect:true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }
            ]
    })

})
