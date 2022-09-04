$(document).ready(function(){

    $('#last-softs .top-navigation .item').click(function(){
        $(this).addClass('active').siblings().removeClass('active')
    })

    $('#last-softs .top-navigation .item').click(function () {
        $(this).addClass('active').siblings().removeClass('active')

        let category = $(this).attr('category')

        $.ajax({
            type: 'GET',
            url: "/changeLastSofts",
            data: {category: category},
            success: function (posts) {
                let parent = $('.last-softs-list').html('');
                if(posts.posts.length >= 1){
                    for (let post of posts.posts) {
                        parent.append(`
                    <div class="last-softs-item"><a class="nav-link" href="/post/${post.id}"><i class="fas fa-chevron-left mx-2"></i>${post.title}</a></div>
                    `)
                    }
                }else{
                    parent.append(`
                    <div class="last-softs-item"><a class="nav-link">پستی با این دسته بندی یافت نشد.</a></div>
                    `)
                }

            }
        })
    })

})
