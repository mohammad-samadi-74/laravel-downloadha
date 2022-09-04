$('.news input').focus(function(){
    $(this).css({borderColor:'#ef1616'}).prev('label').addClass('label-floating').css('marginBottom','2rem',)
})

$('.news input').focusout(function(){
    if($(this).val() === ''){
        $(this).css({borderColor:'#f1f3f4'}).prev('label').removeClass('label-floating').css('marginBottom','2rem')
    }
})
