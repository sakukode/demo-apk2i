<script type="text/javascript">
$(document).ready(function() {
	$('#form-save-videos').validate({
        rules: {
            "video_url[]": {                
                url: true
            }, 
        },
        messages: {
			"video_url[]": {
				required: 'Url Video harus berupa valid url',				
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
            $('#btnSaveVideos').button('loading');

            hideNotifSuccess();
            hideNotifError();  

        	var formData = new FormData($(form)[0]);

        	$.ajax({
	          url: $(form).attr("action"),
	          type: 'POST',
	          dataType: 'json',
	          data: formData,
	          async: false,
	          success: function (data) {	   
                $('#btnSaveVideos').button('reset');

	              if(data.status === true) {
	                showNotifSuccess(data.message);
	              } else {	     
	                showNotifError(data.error);
	              }
	          },
	          error: function() {
                $('#btnSaveVideos').button('reset');	          
                showNotifError("Terjadi Kesalahan Pada Sistem");
	          },
	          cache: false,
	          contentType: false,
	          processData: false
	        });	    
        }
    });


    $('.form-save-image').change(function(e) {        
        var formData = new FormData($(this)[0]);
        var id = $(this).attr('id');

        $.ajax({
            url: $(this).attr("action"),
            type: 'POST',
            dataType: 'json',
            data: formData,
            async: false,
            success: function(data) {
                if (data.status === true) {
                    $('#img-' + id).attr("src", data.path);                    
                } else {
                   showNotifError(data.error);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

   
    var showNotifError = function(message) {
      $('.notif-error-save-videos').html('');      
      $(".notif-error-save-videos").html(message);
      $(".notif-error-save-videos").slideDown();

      setTimeout(function(){ hideNotifError(); }, 3000);
    }

    var hideNotifError = function() {
      $('.notif-error-save-videos').hide();
    }

    var showNotifSuccess = function(message) {
      $('.notif-success-save-videos').html('');      
      $(".notif-success-save-videos").html(message);
      $(".notif-success-save-videos").slideDown();

      setTimeout(function(){ hideNotifSuccess(); }, 3000);
    }

    var hideNotifSuccess = function() {
      $('.notif-success-save-videos').hide();
    }
});
</script>