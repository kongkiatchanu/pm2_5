<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $version = 1;?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert Form</title>
    <link rel="stylesheet" href="<?= base_url() ?>template/css/bootstrap-4.3.1/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/fontawesome/css/all.min.css?v=<?= $version ?>">
    <link href="<?=base_url()?>assets/plugins/dropzone/dropzone.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url() ?>template/css/alertform.css?v=<?= date('His') ?>">
    <script src="<?= base_url() ?>template/js/all/compress.min.js"></script>
</head>

<body>
    <div class="page-loader">
        <div class="spinner"></div>
        <div class="txt">กำลังโหลดข้อมูล...</div>
    </div>
    <?php $this->load->view($view);?>


    <script src="<?=base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js?v=1" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/plugins/jquery-validation/js/jquery.validate.min.js?v=1"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugins/jquery-validation/js/additional-methods.min.js?v=1"></script>
	<script src="<?=base_url()?>assets/plugins/dropzone/dropzone.js?v=1"></script>
    <script>
        $(window).on('load', function () {
            setTimeout(function () { // allowing 3 secs to fade out loader
                $('.page-loader').fadeOut('slow');
            }, 1000);
        });

        Dropzone.autoDiscover = false;

        $(document).ready(function(){

            $('.frm1_ch_type').on('click', function(){
                var type = $('input[name=alert_type]:checked', '#form1').val();
                if(type==4){
                    $('#alert_type_add').show();
                }else{
                    $('#alert_type_add').hide();
                }
            });

            $('.frm3_ch_author').on('click', function(){
                var type = $('input[name=alert_contact]:checked', '#form3').val();
                if(type!="unknow"){
                    $('#alert_contact_message').show();
                }else{
                    $('#alert_contact_message').hide();
                }
            });
            

            Dropzone.autoDiscover = false;
        
            if ($('#dropzone').length) {
                var myDropzone = new Dropzone("#dropzone",{
                    url: "<?=base_url()?>main/dropbox_upload",
                    maxFiles: 1,
                  //  autoQueue: false,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    success: function(file, response){
                        console.log(response);
                        $("#h_image").val(response);
                    }    
                });

                myDropzone.on("addedfile", function(origFile) {
                    var MAX_WIDTH  = 800;
                    var MAX_HEIGHT = 600;

                    var reader = new FileReader();

                    // Convert file to img

                    reader.addEventListener("load", function(event) {

                        var origImg = new Image();
                        origImg.src = event.target.result;

                        origImg.addEventListener("load", function(event) {

                        var width  = event.target.width;
                        var height = event.target.height;


                        // Don't resize if it's small enough

                        if (width <= MAX_WIDTH && height <= MAX_HEIGHT) {
                            dropzone.enqueueFile(origFile);
                            return;
                        }


                        // Calc new dims otherwise

                        if (width > height) {
                            if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                            }
                        }


                        // Resize

                        var canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;

                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(origImg, 0, 0, width, height);

                        var resizedFile = base64ToFile(canvas.toDataURL(), origFile);


                        // Replace original with resized

                        var origFileIndex = dropzone.files.indexOf(origFile);
                        dropzone.files[origFileIndex] = resizedFile;


                        // Enqueue added file manually making it available for
                        // further processing by dropzone

                        dropzone.enqueueFile(resizedFile);
                        });
                    });

                    reader.readAsDataURL(origFile);
                });



                function base64ToFile(dataURI, origFile) {
                    var byteString, mimestring;

                    if(dataURI.split(',')[0].indexOf('base64') !== -1 ) {
                        byteString = atob(dataURI.split(',')[1]);
                    } else {
                        byteString = decodeURI(dataURI.split(',')[1]);
                    }

                    mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0];

                    var content = new Array();
                    for (var i = 0; i < byteString.length; i++) {
                        content[i] = byteString.charCodeAt(i);
                    }

                    var newFile = new File(
                        [new Uint8Array(content)], origFile.name, {type: mimestring}
                    );


                    // Copy props set by the dropzone in the original file

                    var origProps = [ 
                        "upload", "status", "previewElement", "previewTemplate", "accepted" 
                    ];

                    $.each(origProps, function(i, p) {
                        newFile[p] = origFile[p];
                    });

                    return newFile;
                }
            }
            
            var container= $("div.containerz");
		
            $("#form1").validate({
                errorContainer: container,
                errorLabelContainer: $("ol", container),
                wrapper: "li",
                meta: "validate",
                submitHandler: function( form ) { 
                    if($('#h_image').val()){
                        form.submit(); 
                    }else{
                        alert('อัพโหลดรูป');
                    }
                    
                }
            });

            $("#form2").validate({
                errorContainer: container,
                errorLabelContainer: $("ol", container),
                wrapper: "li",
                meta: "validate",
                submitHandler: function( form ) { 
                    if($('#h_image').val()){
                        form.submit(); 
                    }else{
                        alert('อัพโหลดรูป');
                    }
                    
                }
            });

            $("#form3").validate({
                errorContainer: container,
                errorLabelContainer: $("ol", container),
                wrapper: "li",
                meta: "validate",
                submitHandler: function( form ) { 
                    form.submit(); 
                }
            });
        });
    </script>
</body>

</html>