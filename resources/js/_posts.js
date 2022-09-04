$("#posts .content:not(.post-files-info-content) a").before('<i class="fas fa-download download-link-icon"></i>');

//float input label
$('input.float,textarea.float').each(function(index){
    if($(this).val() != '')
        $(this).prev('label').addClass('label-floating').css({'marginBottom':'2rem' , 'color':'green'});
});

function floatLabel(){
    $('input.float,textarea.float').focus(function(){
        $(this).prev('label').addClass('label-floating').css({'marginBottom':'2rem' , 'color':'green'});
    });

    $('input.float,textarea.float').focusout(function(){
        if($(this).val() === ''){
            $(this).prev('label').removeClass('label-floating').css({'marginBottom':'2rem','color':'#6c757d'});
        }
    });
}
floatLabel();
//float input label



$('#create-comment input[name="parent_id"]').val('');
$('.reply-this-comment').click(function(event){
    event.preventDefault();
    let parent = $(this).parent().parent();
    let createCommentDiv = $('#create-comment');
    let commentWriter = parent.parent().attr('commentWriter');
    let replied_id =parent.parent().attr('comment_id');

    //delete old div
        createCommentDiv.remove()

    //insert new div
    parent.after(createCommentDiv);
    createCommentDiv.children('h5').html(`پاسخ به <b>${commentWriter}</b> <a href="#" class="btn btn-danger btn-sm cancel-reply">لغو پاسخ</a>`)

    //cancel reply
    $('.cancel-reply').click(function(event){
        event.preventDefault();
        let createCommentDiv = $('#create-comment');
        //delete old div
        createCommentDiv.remove()
        //insert new div
        $('.show-comments').before(createCommentDiv)
        createCommentDiv.children('h5').html('ایجاد کامنت جدید')
        floatLabel()
    })
    floatLabel()

})

// like posts
$('.likePost').click(function(event){
    event.preventDefault()
    let postId = $(this).attr('postId')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
    $.ajax({
        method:'post',
        url:'/likePost',
        data:{postId : postId},
        success:function(post){

            let rate = post.dislikes +post.likes !== 0 ? Math.floor(post.likes / (post.dislikes +post.likes)*5) : 0;

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
            $(`.post-views-${postId}`).html(`
                <div class="d-flex ">
                    <div class="stars d-flex flex-row-reverse">
                    </div>
                    <div class="rate"><span>${rate}/5</span><span class="mx-1">(${post.likes} <i>امتیاز</i>)</span></div>
                </div>
            `).find('.stars').html(stars);
        }
    })
})

//dislike posts
$('.dislikePost').click(function(event){
    event.preventDefault()
    let postId = $(this).attr('postId')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
    $.ajax({
        method:'post',
        url:'/dislikePost',
        data:{postId : postId},
        success:function(post){

            let rate = post.dislikes +post.likes !== 0 ? Math.floor(post.likes / (post.dislikes +post.likes)*5) : 0;

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
            $(`.post-views-${postId}`).html(`
                <div class="d-flex ">
                    <div class="stars d-flex flex-row-reverse">
                    </div>
                    <div class="rate"><span>${rate}/5</span><span class="mx-1">(${post.likes} <i>امتیاز</i>)</span></div>
                </div>
            `).find('.stars').html(stars);
        }
    })
})


