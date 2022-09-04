$('#best-date-posts .second-title a').click(function (event){
    event.preventDefault();
    $(this).addClass('active').parent().siblings().children('a').removeClass('active');

    let active_column = $(this).attr('date');

    $.ajax({
        url: '/searchPostsByDate',
        method: 'get',
        data: {date:active_column},
        success:function(response){
            if (response.status == 'success'){
                    let posts = response.posts;
                let output = '';
                for (post of posts){
                    output += `<div class="py-2 px-3 border-bottom"><a class="font-14" href="/post/${post.id}"><i class="fa fa-chevron-left"></i>${post.title}</a></div>`
                }
                $('#best-date-posts .content').html(output);
            }

        }
    })

})
