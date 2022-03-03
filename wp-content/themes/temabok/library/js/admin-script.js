jQuery(document).ready(function($) {
    
    $('.clone a').on('click', function(){
        const regexp = /(?<=post=)\d+/gm;

        const str = $(this).attr('href');

        let resultId = str.match(regexp)[0].match(/\d+/)[0];

        $.ajax({
            url: window.location.origin + "/wp-json/videomanager/v1/clone/?post_id=" + resultId,
            method: "GET",
            success: function(data) {			
                console.log(data);
            },
            error:function(data){
             console.log("error", data);
            }
        })
    })

    $(".page-title-action.aria-button-if-js").on('click', function() {
        $.ajax({
            url: window.location.origin + "/wp-json/videomanager/v1/status/",
            method: "GET",
            success: function(data) {			
                console.log(data);
                if (data === null) {
                    alert("Video manager work wrong, please, try again later.");
                }
            },
            error:function(){
             alert("Video manager work wrong, please, try again later.");
            }
        })
    })

    $("#menu-item-upload").on('click', function() {        
        $.ajax({
            url: window.location.origin + "/wp-json/videomanager/v1/status/",
            method: "GET",
            success: function(data) {			
                console.log(data);
                if (data === null) {
                    alert("Video manager work wrong, please, try again later.");
                }
            },
            error:function(){
             alert("Video manager work wrong, please, try again later.");
            }
        })
    })

    $('#plupload-browse-button').mouseover(function() {        
        $.ajax({
            url: window.location.origin + "/wp-json/videomanager/v1/status/",
            method: "GET",
            success: function(data) {			
                console.log(data);
                if (data === null) {
                    alert("Video manager work wrong, please, try again later.");
                }
            },
            error:function(){
             alert("Video manager work wrong, please, try again later.");
            }
        })
    })  

        $('#__wp-uploader-id-1').mouseover(function() {        
            $.ajax({
                url: window.location.origin + "/wp-json/videomanager/v1/status/",
                method: "GET",
                success: function(data) {			
                    console.log(data);
                    if (data === null) {
                        alert("Video manager work wrong, please, try again later.");
                    }
                },
                error:function(){
                 alert("Video manager work wrong, please, try again later.");
                }
            })
        })
})