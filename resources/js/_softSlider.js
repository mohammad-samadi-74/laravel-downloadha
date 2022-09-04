$(document).ready(function () {


    function set_soft_slider() {
        $('#soft-slider .soft-slider').slick({
            dots: true,
            arrows: false,
            speed: 1000,
            slidesToShow: 6,
            slidesToScroll: 6,
            focusOnSelect: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                }
            ]
        })
    }

    set_soft_slider()


    $('#soft-slider .top-navigation .item').click(function () {
        $(this).addClass('active').siblings().removeClass('active')

        let category = $(this).attr('category')

        $.ajax({
            type: 'GET',
            url: "/changeSoftSlider",
            data: {category: category},
            success: function (posts) {
                let parent = $('.soft-slider');
                parent.replaceWith(`<div class="soft-slider bg-white px-2 shadow-md"></div>`);
                if(posts.posts.length >= 1){
                    for (let post of posts.posts) {
                        $('.soft-slider').append(`
                        <div class="soft-slider-item">
                            <a href="/post/${post.id}" class="d-flex flex-column py-2 text-decoration-none mt-4">
                                <div class="d-flex justify-content-center">
                                    <img class="mb-3" src="${post.icon ? '/'+post.icon.icon : '/images/software-icon-30-300x300.png'}" width="75" height="75" alt="picture">
                                </div>
                                <h4 class="soft-slider-item-title text-center">
                                    ${ post.icon ? post.icon.caption : ''}
                                </h4>
                                <h6 class="soft-slider-item-description text-center">
                                    ${ post.icon ? post.icon.content : ''}
                                </h6>
                            </a>
                        </div>
                    `)
                    }
                    set_soft_slider();
                }

            }
        })
    })

})
