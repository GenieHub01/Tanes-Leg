var vanilla;
var previous_text;
function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.upload-demo').addClass('ready');
            $uploadCrop.croppie('bind', {
                url: e.target.result,
                orientation: 1
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }

        reader.readAsDataURL(input.files[0]);
    }
    else {
        swal("Sorry - you're browser doesn't support the FileReader API");
    }
}

//
// $('#upload').on('change', function () {
//     console.log('uploadImage');
//     readFile(this);
// });
//select tab to crop image and show it on <img>.
// $('a[data-toggle="tab"]').on('show.bs.tab', function (ev) {
//     $uploadCrop.croppie('result', {
//         type: 'canvas',
//         size: 'viewport'
//     }).then(function (resp) {
//         if(resp != 'data:,')
//             $('#imgReview').attr("src",resp);
//     });
// });




function startCropp(widgetId, options){

    console.log('--- Croppier','start');
    var widget = $(widgetId).croppie(options);
    var $widget = $(widgetId);
    // var $uploader = $widget.closest('#uploader'+ widgetId.replace('#','') );
    // var $uploader = startCroppieUpload('#uploader'+ widgetId.replace('#','') );


    // jQuery('#$id').croppie($options);"
    // var $widget = $(widgetId);
    // var url = $widget.attr('data-url');
    var url = '/site/upload-image';
    // var paramname = $uploader.attr('data-paramname');

    // var // progressBar = $widget.find('.progressBar')[ 0 ],
    //     // imagesUploader = $widget.find('.images-uploader')[ 0 ],
    //     progressOuter = $uploader.find('.progressOuter')[0],
    //     msgBox = $uploader.find('.msgBox')[0];
    //
    //
    // var uploader = new ss.SimpleUpload({
    //     button: $uploader.find('.img-uploader'),
    //     url: url,
    //     name: 'uploadfile',
    //     multipart: true,
    //     allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
    //     multipleSelect: false,
    //     multiple: false,
    //     responseType: 'json',
    //     startXHR: function () {
    //         $widget.find('.img-uploader').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>')
    //         // progressOuter.style.display = 'block'; // make progress bar visible
    //         // this.setProgressBar( progressBar );
    //     },
    //     onSubmit: function () {
    //         msgBox.innerHTML = ''; // empty the message box
    //         // btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
    //     },
    //     onComplete: function (filename, response) {
    //         // btn.innerHTML = 'Choose Another File';
    //         progressOuter.style.display = 'none'; // hide progress bar when upload is completed
    //         console.log('---', response);
    //         if (!response) {
    //             msgBox.innerHTML = 'Unable to upload file [no response]';
    //             return;
    //         }
    //         if (response.success === true) {
    //             $widget.croppie('bind', {url: response.file.filename});
    //             $uploader.find('#mprofile-photo').val(response.file.filename);
    //         } else {
    //         }
    //         $uploader.find('.img-uploader').html('<i class="fa fa-image"></i> Change');
    //     },
    //     onError: function () {
    //         progressOuter.style.display = 'none';
    //         msgBox.innerHTML = 'Unable to upload file [on error]';
    //     }
    // });

    $widget.closest('form').on("click", ".croppie-save", function (e) {


        e.preventDefault();

        var $this = $(this);
        var $form = $(this).closest('form');
        previous_text = $this.html();
        $this.html(htmlLoadingIcon);

        $widget.croppie('result', {type: 'blob', size: 'original', format: 'jpeg', circle: false}).then(function (blob) {

            var croppieData = $widget.croppie('get');
            var formData = new FormData();
            formData.append('uploadfile', blob, 'lol.jpg');
            formData.append('croppieData', JSON.stringify(croppieData));
            $.ajax('/profile/ajax-update-thumbnail', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // vanilla.croppie('get');
                    // console.log( '--- Widget croppiedata', $form.find('.input-croppie').val());

                    // var croppieData = $widget.croppie('get');
                    $this.html(previous_text);
                    $.growl({title: "Profile picture", message: "Saved! Please, reload page."});
                    // console.log( '--- Widget ', $widget );

                    // $form.find('.input-croppie').val(response.file.filename);
                    // $form.find('.input-croppiedata').val(JSON.stringify(croppieData));


                    // $('.photo-block__photo img').attr('src',response.file.filename);
                    // console.log( '--- Widget croppiedata', JSON.stringify(croppieData));
                    // $('#croppie').addClass('hidden');
                    // $('#croppie-result').find('img').attr('src', response.file.filename);
                    // $('#croppie-result').removeClass('hidden');

                    // if ($this.hasClass('forcesubmit')) {
                    //     $this.closest('form').submit();
                    // }

                }
            }).fail(function (xhr, status, error) {

                showError(xhr, status, error);


            });
            // html is div (overflow hidden)
            // with img positioned inside.
        });
    });

    // $('.croppie-edit').on('click', function (e) {
    //     e.preventDefault();
    //     $('#croppie').removeClass('hidden');
    //     $('#croppie-result').addClass('hidden');
    // });
    //
    //
    // $('.croppie-rotate').on('click', function (e) {
    //     e.preventDefault();
    //     vanilla.croppie('rotate', parseInt($(this).data('deg')));
    //     return false;
    // });
}



function startCroppie(widgetId, options){

    console.log('--- Croppier','start');
    var widget = $(widgetId).croppie(options);
    var $widget = $(widgetId);
    var $uploader = $widget.closest('#uploader'+ widgetId.replace('#','') );
    // var $uploader = startCroppieUpload('#uploader'+ widgetId.replace('#','') );


    // jQuery('#$id').croppie($options);"
    // var $widget = $(widgetId);
    // var url = $widget.attr('data-url');
    var url = '/site/upload-image';
    var paramname = $uploader.attr('data-paramname');

    var // progressBar = $widget.find('.progressBar')[ 0 ],
        // imagesUploader = $widget.find('.images-uploader')[ 0 ],
        progressOuter = $uploader.find('.progressOuter')[0],
        msgBox = $uploader.find('.msgBox')[0];


    var uploader = new ss.SimpleUpload({
        button: $uploader.find('.img-uploader'),
        url: url,
        name: 'uploadfile',
        multipart: true,
        allowedExtensions: ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        multipleSelect: false,
        multiple: false,
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
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed
            console.log('---', response);
            if (!response) {
                msgBox.innerHTML = 'Unable to upload file [no response]';
                return;
            }
            if (response.success === true) {
                $widget.croppie('bind', {url: response.file.proxyFilename});
                $uploader.find('#mprofile-photo').val(response.file.filename);
            } else {
            }
            $uploader.find('.img-uploader').html('<i class="fa fa-image"></i> Change');
        },
        onError: function () {
            progressOuter.style.display = 'none';
            msgBox.innerHTML = 'Unable to upload file [on error]';
        }
    });

    $uploader.on("click", ".croppie-save", function (e) {

        e.preventDefault();
        console.log('--- Croppier','.croppie-save');
        var $this = $(this);
          previous_text = $this.html();
        $this.html(htmlLoadingIcon);
        $widget.croppie('result', {type: 'blob', size: 'original', format: 'jpeg', circle: false}).then(function (blob) {
            console.log('--- Upload Blob');
            var formData = new FormData();
            formData.append('uploadfile', blob, 'lol.jpg');
            $.ajax('/profile/change-thumbnail', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // vanilla.croppie('get');

                    var croppieData = $widget.croppie('get');
                    $this.html(previous_text);
                    $uploader.find('.input-croppie').val(response.file.filename);
                    $uploader.find('.input-croppiedata').val(JSON.stringify(croppieData));

                    // $('#croppie').addClass('hidden');
                    // $('#croppie-result').find('img').attr('src', response.file.filename);
                    // $('#croppie-result').removeClass('hidden');

                    if ($this.hasClass('forcesubmit')) {
                        $this.closest('form').submit();
                    }

                },
                error: function () {
                    console.log('Upload error');
                }
            });
            // html is div (overflow hidden)
            // with img positioned inside.
        });
    });

    // $('.croppie-edit').on('click', function (e) {
    //     e.preventDefault();
    //     $('#croppie').removeClass('hidden');
    //     $('#croppie-result').addClass('hidden');
    // });
    //
    //
    // $('.croppie-rotate').on('click', function (e) {
    //     e.preventDefault();
    //     vanilla.croppie('rotate', parseInt($(this).data('deg')));
    //     return false;
    // });
}




function startCroppieDeprecated(widgetId){

    $('.croppie-save').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var previous_text = $this.html();
        $this.html(htmlLoadingIcon);
        vanilla.croppie('result', {type: 'blob', size: 'original', format: 'jpeg', circle: false}).then(function (blob) {
            console.log('--- Upload Blob');
            var formData = new FormData();
            formData.append('uploadfile', blob, 'lol.jpg');
            $.ajax('/site/upload-ava', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // vanilla.croppie('get');

                    var croppieData = vanilla.croppie('get');
                    $this.html(previous_text);
                    $('#mprofile-croppie').val(response.file.filename);
                    $('#mprofile-croppiedata').val(JSON.stringify(croppieData));

                    $('#croppie').addClass('hidden');
                    $('#croppie-result').find('img').attr('src', response.file.filename);
                    $('#croppie-result').removeClass('hidden');
                    $('.photo-block__photo img').attr('src',response.file.filename);


                    if ($this.hasClass('forcesubmit')) {
                        $this.closest('form').submit();
                    }

                },
                error: function () {
                    console.log('Upload error');
                }
            });
            // html is div (overflow hidden)
            // with img positioned inside.
        });
    });

    $('.croppie-edit').on('click', function (e) {
        e.preventDefault();
        $('#croppie').removeClass('hidden');
        $('#croppie-result').addClass('hidden');
    });


    $('.croppie-rotate').on('click', function (e) {
        e.preventDefault();
        vanilla.croppie('rotate', parseInt($(this).data('deg')));
        return false;
    });
}

