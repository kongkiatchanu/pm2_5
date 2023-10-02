<!-- BEGIN FOOTER -->
<div class="page-footer">
			<div class="page-footer-inner">  &copy; <?=$this->config->item('title_name')?>
				<a href="#" target="_top" class="makerCss">IPlayComputer</a>
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!-- end footer -->
	</div>
	<!-- start js include path -->
	<script src="<?=base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js?v=1" type="text/javascript"></script>
	<script src="<?=base_url('assets/')?>plugins/popper/popper.js?v=1"></script>
	<script src="<?=base_url('assets/')?>plugins/jquery-blockui/jquery.blockui.min.js?v=1"></script>
	<script src="<?=base_url('assets/')?>plugins/jquery-slimscroll/jquery.slimscroll.js?v=1"></script>
	<!-- bootstrap -->
	<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.min.js?v=1"></script>
	<script src="<?=base_url('assets/')?>plugins/bootstrap-switch/js/bootstrap-switch.min.js?v=1"></script>

	<script src="<?=base_url('assets/')?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"  charset="UTF-8"></script>
	<!-- Common js-->
	<script src="<?=base_url('assets/')?>js/app.js?v=1"></script>
	<script src="<?=base_url('assets/')?>js/layout.js?v=1"></script>
	<script src="<?=base_url('assets/')?>js/theme-color.js?v=1"></script>
	<!-- Material -->
	<script src="<?=base_url('assets/')?>plugins/material/material.min.js?v=1"></script>
	<!-- end js include path -->
	
	<script src="<?=base_url()?>assets/plugins/tagsinput/bootstrap-tagsinput.min.js?v=1" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js?v=1"></script>
    <script src="<?=base_url()?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js?v=1"></script>
    <script src="<?=base_url()?>assets/js/pages/table/table_data.js?v=1"></script>

	<script type="text/javascript" src="<?=base_url()?>assets/plugins/jquery-validation/js/jquery.validate.min.js?v=1"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugins/jquery-validation/js/additional-methods.min.js?v=1"></script>
	<script src="<?=base_url()?>assets/plugins/summernote/dist/summernote.js?v=1"></script>
	<script src="<?=base_url()?>assets/plugins/dropzone/dropzone.js?v=1"></script>
	
	<script>
	jQuery(document).ready(function() {  

		$(function() { $('.color_hex').colorpicker(); });
		var preview = $("#upload-preview");  
		var container= $("div.containerz");
		
		$("#form_profile").validate({
			errorContainer: container,
			errorLabelContainer: $("ol", container),
			wrapper: "li",
			meta: "validate",
			rules: {
				n_password : {
                    minlength : 6
                },
                c_password : {
                    minlength : 6,
                    equalTo : "#n_password"
                }
			},
			messages: {
				n_password : {
                    minlength : 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว'
                },
                c_password : {
                    minlength : 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว',
                    equalTo : "ยืนยันรหัสผ่านไม่ถูกต้อง"
                }
			},
			submitHandler: function( form ) { form.submit(); }
		});
		
		$('.summernote').summernote({
			height: 300,
			focus: true,
			callbacks: {
				onImageUpload : function(files, editor, welEditable) {
					for(var i = files.length - 1; i >= 0; i--) {
						sendFile(files[i], this);
					}
				}
			} 
		});


        function sendFile(file, el) {
            var form_data = new FormData();
            form_data.append('file', file);
            $.ajax({
                data: form_data,
                type: "POST",
                url: "<?=base_url()?>assets/plugins/summernote/save.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $(el).summernote('editor.insertImage', url);
                }
            });
        }
		
		Dropzone.autoDiscover = false;
        
		if ($('#dropzone').length) {
			var myDropzone = new Dropzone("#dropzone",{
				url: "<?=base_url()?>assets/plugins/dropzone/upload.php",
				maxFiles: 1,
				maxFilesize: 10,
				autoProcessQueue: false,
				addRemoveLinks: true,
				init: function() {
					this.on("maxfilesexceeded", function(file){
							this.removeAllFiles();
							this.addFile(file);
						});
					},
					success: function(file, response){
						$("#h_image").val(response);
					}
					
			});
		}
		
		/* DROPZONE */
			
		$('#remove_image_cover').on("click",function(){
			$('#dropzone').show();
			$('#image_cover_show').hide();
		});
		
		$("#frm_content_validate").validate({
			errorContainer: container,
			errorLabelContainer: $("ol", container),
			wrapper: "li",
			meta: "validate",
			rules: {
				'content_file[]': {
					required: true,
					extension: "pdf|jpg|docx|xlsx|zip|rar"
				}
			},
			messages: {
				'content_file[]': {
				  required: 'กรุณาเลือกไฟล์เอกสาร',
				  extension: "ไฟล์เอกสารต้องเป็นไฟล์นามสกุล pdf|jpg|docx|xlsx|zip|rar เท่านั้น"
				}
			},
			submitHandler: function(form) {
						
				myDropzone.processQueue();
				setTimeout(function(){
					form.submit();
				},2000)
						
			}
		});
	});
	</script>
</body>

</html>