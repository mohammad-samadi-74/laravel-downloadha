// like products
$('.likeproduct').click(function(event){
    event.preventDefault()
    let productId = $(this).attr('productId')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
    $.ajax({
        method:'post',
        url:'/likeProduct',
        data:{productId : productId},
        success:function(product){
            let rate = product.dislikes +product.likes !== 0 ? Math.floor(product.likes / (product.dislikes +product.likes)*5) : 0;

            let stars = '';
            let rateStars = rate;
            for(let i=1 ; i<=5 ; i++){
                if(rateStars<1){
                    stars += `<div class="container"><i class="fas fa-star"></i></div>`
                }else{
                    stars += `<div class="container"><i class="fas fa-star"></i><i class="star fas fa-star"></i></div>`
                    --rateStars;

                }
            }
            $(`.post-views-${productId}`).html(`
                <div class="d-flex ">
                    <div class="stars d-flex flex-row-reverse">
                    </div>
                    <div class="rate"><span>${rate}/5</span><span class="mx-1">(${product.likes} <i>امتیاز</i>)</span></div>
                </div>
            `).find('.stars').html(stars);
        }
    })
})

//dislike products
$('.dislikeproduct').click(function(event){
    event.preventDefault()
    let productId = $(this).attr('productId')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
    $.ajax({
        method:'post',
        url:'/dislikeProduct',
        data:{productId : productId},
        success:function(product){

            let rate = product.dislikes +product.likes !== 0 ? Math.floor(product.likes / (product.dislikes +product.likes)*5) : 0;

            let stars = '';
            let rateStars = rate;
            for(let i=1 ; i<=5 ; i++){
                if(rateStars<1){
                    stars += `<div class="container"><i class="fas fa-star"></i></div>`
                }else{
                    stars += `<div class="container"><i class="fas fa-star"></i><i class="star fas fa-star"></i></div>`
                    --rateStars;

                }
            }
            $(`.post-views-${productId}`).html(`
                <div class="d-flex ">
                    <div class="stars d-flex flex-row-reverse">
                    </div>
                    <div class="rate"><span>${rate}/5</span><span class="mx-1">(${product.likes} <i>امتیاز</i>)</span></div>
                </div>
            `).find('.stars').html(stars);
        }
    })
})
