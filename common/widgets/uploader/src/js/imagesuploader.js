var uploaderTemplate;
function startUploader(widgetId) {

    console.log('--- Start Uploader');

    var $widget = $(widgetId);
    var url = $widget.attr('data-url');
    var paramname = $widget.attr('data-paramname');

    var progressBar = $widget.find('.progressBar')[ 0 ],
        imagesUploader = $widget.find('.images-uploader')[ 0 ],
        progressOuter = $widget.find('.progressOuter')[ 0 ],
        msgBox = $widget.find('.msgBox')[ 0 ];

    var $filesBlock = $(widgetId).find('.files_block');

    //  ul_parrent = $('.uploadBtn').closest('.plugin__message').find('.files_block');

    var ul_parent =$widget.find('.files_block')  ;



    var uploader = new ss.SimpleUpload({
        button: $widget.find('.img-uploader'),
        url: url,
        name: 'uploadfile',
        multipart: true,
        allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        hoverClass: 'hover',
        focusClass: 'focus',
        multipleSelect: true,
        multiple: true,
        customHeaders: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr("content")
        },

        responseType: 'json',
        startXHR: function () {
            $widget.find('.img-uploader').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>')
            // progressOuter.style.display = 'block'; // make progress bar visible
            // this.setProgressBar( progressBar );
        },
        onSubmit: function () {
            msgBox.innerHTML = ''; // empty the message box
            // btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
        },
        onComplete: function (filename, response) {
            // btn.innerHTML = 'Choose Another File';
            // progressOuter.style.display = 'none'; // hide progress bar when upload is completed

            if (!response) {
                // msgBox.innerHTML = 'Unable to upload file [no response]';
                return;
            }

            if (response.success === true) {

                if ($filesBlock.css('display', 'none')) {
                    $filesBlock.show();
                }


                var template = (uploaderTemplate);
                // template.replace(/{fileId}/g,response.file.id);
                template = template.replace('{fileId}',response.filename);
                template = template.replace('{fileId}',response.filename);
                template = template.replace('{filePreview}',response.preview);
                $filesBlock.find('ul').append(template);

            } else {

                if (response.msg) {
                    msgBox.innerHTML = escapeTags(response.msg);

                } else {
                    msgBox.innerHTML = 'An error occurred and the upload failed.';
                }
            }

            $('.img-uploader').html('<i class="fa fa-plus"></i> Add image');


        },
        onError: function (filename, type, status, statusText, response, uploadBtn, size) {

            $(uploadBtn).html('<i class="fa fa-plus"></i> Add image');
            var json = JSON.parse(response);
            // showError(JSON.parse(response), status);
            // $.growl.error({message: 'Error(' + status + '): ' + json.error_text})
            // console.log(filename, type, status, statusText, response, uploadBtn, size);
        }
        // onError: function () {
        //
        //     progressOuter.style.display = 'none';
        //     msgBox.innerHTML = 'Unable to upload file [on error]';
        // }
    });

    $widget.on("click", ".files_block a.delete", function () {

    });
    $widget.on("click", ".files_block a.delete", function () {
        var size_ul = $(this).closest('ul.files-ui').find('li').length - 1;
        var ul_papa = $(this).closest('.files_block');
        $(this).closest('li').remove();
        if (size_ul == 0) {
            ul_papa.hide();
            ul_papa.html('<input type="hidden" name="Goods[images]" value="">');
        }
        return false;
    });
    $widget.on("click", ".files_block a.revert", function (event) {


        var obj = $(this).closest('li');
        var id = $(this).closest('li').attr('data-key');

        $(obj).find('.shadow').addClass('hidden');
        $(obj).find('.loader').removeClass('hidden');

        $.ajax({
            type: "POST", // or GET
            url: "/site/rotate-image",
            data: {id: id, rotate: 'left'},
            success: function (response) {

                $(obj).find('.shadow').removeClass('hidden');
                $(obj).find('.loader').addClass('hidden');
                if (response['success'] == true) {
                    $(obj).attr('data-key', response.file.id);
                    $(obj).attr('class', response.file.rotateClass);

                    $(obj).find('.img_block .img').attr('style', "background: url('" + escapeTags(response.file.preview) + "') center no-repeat; background-size: cover; ");
                    $(obj).find('input').attr('value', response.file.id);
                } else {
                    console.log(response['error_text']);
                }

            },
            error: function () {
                // something's gone wrong.
            }
        });
        //
        //
        // alert('revert');

        event.preventDefault();


    });
    $("body").on("click", ".files_block a.revert_n", function (event) {


        var obj = $(this).closest('li');
        var id = $(this).closest('li').attr('data-key');
        // $(obj).find('.shadow').html('<i class="fa  fa-spinner  fa-pulse"  aria-hidden="true" ></i>');
        $(obj).find('.shadow').addClass('hidden');
        $(obj).find('.loader').removeClass('hidden');


        $.ajax({
            type: "POST", // or GET
            url: "/site/rotate-image",
            data: {id: id, rotate: 'right'},
            success: function (response) {

                if (response.success == true) {

                    $(obj).find('.shadow').removeClass('hidden');
                    $(obj).find('.loader').addClass('hidden');
                    $(obj).attr('data-key', response.file.id);
                    $(obj).attr('class', response.file.rotateClass);
                    // $(obj).find('.shadow').html('<a href="#" class="revert"></a><a href="#" class="delete"></a>');
                    $(obj).find('.img_block .img').attr('style', "background: url('" + escapeTags(response.file.preview) + "') center no-repeat; background-size: cover; ");
                    $(obj).find('input').attr('value', response.file.id);

                } else {
                    console.log(response['error_text']);
                }
                console.log(response);
                //$("#someElement").doSomething();
            },
            error: function () {
                // something's gone wrong.
            }
        });
        //
        //
        // alert('revert');

        event.preventDefault();


    });
    $("body").on("click", ".files_block a.checkbox", function (event) {


        $(this).closest('ul').find('li').removeClass('active');
        $(this).closest('li').addClass('active');
        $('.main_image').val($(this).closest('li').attr('data-key'));


        //
        //
        // alert('revert');

        event.preventDefault();


    });

    $(".files-ui").sortable();
}
function startLogoUploader(widgetId) {
    console.log('--- Start LogoUploader');


    var $widget = $(widgetId);
    var url = $widget.attr('data-url');
    var paramname = $widget.attr('data-paramname');

    var
        // progressBar = $widget.find('.progressBar')[ 0 ],
        // imagesUploader = $widget.find('.images-uploader')[ 0 ],
        progressOuter = $widget.find('.progressOuter')[ 0 ],
        msgBox = $widget.find('.msgBox')[ 0 ];


    var uploader = new ss.SimpleUpload({
        button: $widget.find('.img-uploader'),
        url: url,
        name: 'uploadfile',
        multipart: true,
        allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        hoverClass: 'hover',
        focusClass: 'focus',
        multipleSelect: false,
        customHeaders: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr("content")
        },
        multiple: false,
        responseType: 'json',
        startXHR: function() {
            $widget.find('.img-uploader').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>')
            // progressOuter.style.display = 'block'; // make progress bar visible
            // this.setProgressBar( progressBar );
        },
        onSubmit: function() {
            msgBox.innerHTML = ''; // empty the message box
            // btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
        },
        onComplete: function( filename, response ) {
            // btn.innerHTML = 'Choose Another File';
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed
            console.log('---',response);
            if ( !response ) {
                msgBox.innerHTML = 'Unable to upload file [no response]';
                return;
            }
            if ( response.success === true ) {
                // console.log('success');
                $widget.find('input').val(response.file.id);
                $widget.find('img').attr('src',response.file.preview);
            } else {
            }
            $widget.find('.img-uploader').html('<i class="fa fa-image"></i> Change Logo');
        },
        onError: function() {
            progressOuter.style.display = 'none';
            msgBox.innerHTML = 'Unable to upload file [on error]';
        }
    });
// }


}

