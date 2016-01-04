jQuery(function($){
    $('.fcontroller_block__btn').click(function(){
        $.post('?action=tree&do=export',{}, function(data) {
            console.log(data);
            $('.fcontroller_block__out').text(JSON.stringify(data));
        },'json');
    });
});
