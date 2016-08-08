<script type="text/javascript">
$(document).ready(function() {
	$('#search').keypress(function(e) {
		//e.preventDefault();

		if(e.which === 13) {
			var search = $('#search').val().trim();
			if(search == '') {
				window.location = BASE_URL + "admin/regulasi";
			} else {
				window.location = BASE_URL + "admin/regulasi/search/" + search;
			}
		}
	});	


	$('.btn-remove').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');		
		var name = $(this).attr('data-name');
			
		//show alert warning before remove icon from cart
		swal({
			title: "Hapus Regulasi",
			text: 'Yakin Ingin menghapus Regulasi "' + name + '"?',
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: true,
			showLoaderOnConfirm: true
		}, function() {			
			//if clicked confirmation, call method to remove icon from cart
			$.ajax({
				type: "post",
				url: BASE_URL + "admin/regulasi/delete",
				cache: false,
				data: {
					id: id
				},
				success: function(response) {
					window.location = BASE_URL + "admin/regulasi";
				},
				error: function() {
					console.log("error");
				}
			});
		});
	});
});
</script>