define([
    "jquery",
    "jquery/ui",
    "OpenTechiz_Blog/js/loadcomment"
], function($, ui, loadcomment) {
    "use strict";

    function main(config, element) {
        var $element = $(element);
        //console.log(loadcomment);
        loadcomment.loadComments(config);
        var AjaxCommentPostUrl = config.AjaxCommentPostUrl;

        var dataForm = $('#comment-form');
        dataForm.mage('validation', {});

        $(document).on('click', '.submit',function(){
            if(dataForm.valid()){
                event.preventDefault();
                var param = dataForm.serialize();
                //alert(param);
                $.ajax({
                    showLoader: true,
                    url: AjaxCommentPostUrl,
                    data: param,
                    type: 'POST'
                }).done(function(data){
                    //console.log(data);
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
    };
    return main;
});