$(function() {
'use strict'
$('.content .post').on('click', '.like', function() {
    var like = $(this),
        post = like.parent();
        state = like.hasClass('active');

    if (post.hasClass('disabled')) {
        return;
    }

    post.addClass('disabled');

       $.ajax({
            url:'',
            data:{
                act: "like",
                post_id: post.data('post-id'),
                state: !state

            },
            type:"post",
            dataType:"json",
            success: function(response){
                like.toggleClass('active', !state)
                    .removeClass('disabled');
            },
            error: function(response){
                like.removeClass('disabled');
            }, 
        });
});
});

