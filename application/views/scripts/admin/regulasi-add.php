<script type="text/javascript">
$(document).ready(function() {
	$('#form-regulasi-add').validate({
        rules: {
            name: {                
                required: true
            },                
            file: {
            	required: true,
            	extension: 'pdf|doc|docx'
            },
        },
        messages: {
			name: {
				required: 'Nama Event harap diisi',				
			},
			file: {
                required: 'File harap dipilih',
				extension: 'Tipe File harus PDF/Word'
			},
		},
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {      
            hideNotifError();       
        	var formData = new FormData($(form)[0]);

        	$.ajax({
	          url: $(form).attr("action"),
	          type: 'POST',
	          dataType: 'json',
	          data: formData,
	          async: false,
	          success: function (data) {	         
	              if(data.status === true) {
	                location.reload();
	              } else {	     
	                showNotifError(data.error);
	              }
	          },
	          error: function() {
	          
	          },
	          cache: false,
	          contentType: false,
	          processData: false
	        });	    
        }
    });

   
    var showNotifError = function(message) {
      $('.alert-danger').html('');      
      $(".alert-danger").html(message);
      $(".alert-danger").slideDown();
    }

    var hideNotifError = function() {
      $('.alert-danger').hide();
    }
});
</script>