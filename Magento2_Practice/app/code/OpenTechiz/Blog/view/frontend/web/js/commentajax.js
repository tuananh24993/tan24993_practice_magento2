define([
    "jquery",
    "jquery/ui",
    "loadcomment"
], function($, ui, loadcomment) {
    "use strict";

    function main(config, element) {
        var $element = $(element);
        loadcomment.loadComments(config);

        var AjaxCommentPostUrl = config.AjaxCommentPostUrl;

        //var page = 1;
        //notification.loadNotifications(config, page);

        var dataForm = $('#comment-form');
        dataForm.mage('validation', {});

        $(document).on('click', '#submit',function(){
            if(dataForm.valid()){
                event.preventDefault();
                var param = dataForm.serialize();
                $.ajax({
                    showLoader: true,
                    url: AjaxCommentPostUrl,
                    data: param,
                    type: 'POST'
                }).done(function(data){
                    if(data.result== "error"){
                        $('.note').css('color', 'red');
                        $('.note').html(data.message);
                        return false;
                    }
                    document.getElementById('comment-form').reset();
                    $('.note').html(data.message);
                    $('.note').css('color', 'green');
                    loadcomment.loadComments(config);
                });
            }
        });

        $(document).on('click', '#load-more',function(){
            event.preventDefault();
            page++;
            notification.loadNotifications(config, page);
        });
    };
    return main;
});