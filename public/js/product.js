$(document).ready(function(){
	$("#prdTable").dataTable({
		"bPaginate": true,
		"bFilter": false,
		"bInfo": false,
		"sDom": '<"top"i>rt<"bottom"flp<"clear">'  
	});
	$("#addProduct").validate({
	  rules: {
	    pname: "required",
	    price:{
	    	required:true
	    },
	    quantity:{
	    	required:true
	    }
		},
	  messages: {
	    pname: "Please specify your product",
	    price:{
	    	required:"Please enter price"
	    }
	  }
	});
	$("#addProductdata").on('click', function(){
		$("#add-modal").modal("show");
	});
	var form = $('#addProduct')[0];
	$("#addProduct").on('submit',function(e){
		e.preventDefault();
		$.ajax({
  			"type":"POST",
  			"url":"productInsert",
  			"data": new FormData(form),
  			"contentType": false,
            "cache": false,
            "processData": false,
  			"dataType":"JSON",
  			success: function(response) {
  				console.log(response['productInsert']);
			   	$("#add-modal").modal("hide");
			    var html = '<tr>';
			     html+= '<td>'+response['productInsert'].id+'</td>';
			    html+= '<td>'+response['productInsert'].name+'</td>';
			    html+= '<td>'+response['productInsert'].price+'</td>';
			    html+= '<td>'+response['productInsert'].quantity+'</td>';
			    html+= '<td>'+response['productInsert'].status+'</td>';
			    html+= '<td><a class="btn-edit" data-id="'+response['productInsert'].id+'"><i class="fa fa-edit fa-sm" style="color:blue;"></i></a><a class="btn-delete" data-id="'+response['productInsert'].id+'"><i class="fa fa-trash fa-sm" aria-hidden="true" style="color:red;"></i></a></td>';
			    $("#productTbody").prepend(html);
			    $("#name").val("");
				$("#price").val("");
				$("#quantity").val("");
  				toastr.success(response['message']);
  			}
  		});
	});
	$("#prdTable").on('click','.btn-edit', function(){
  		$id = $(this).data("id");
  		$('.modal_hiddenid').val($id);
  		$.ajax({
  	  		"type":"GET",
  	  		"url": "productEdit",
			"data": {"productID":$id},
			"dataType": "JSON",
			success: function(response) {
			    console.log(response);
			    $('#editPrdName').val(response.name);
			    $('#editPrdPrice').val(response.price);
			    $('#editPrdQuantity').val(response.quantity);
			    $('#edit-modal').modal('show');
			    toastr.success(response['message']);
			},
			error: function(response){
				toastr.error(response);
			}
		});
  	});
  	
  	$("#editForm").on('submit', function(e){
  		e.preventDefault();
  		
  		$id = $("#id").val();
  		$.ajax({
  			"type":"POST",
  			"url":"productUpdate/"+$id,
  			"data":$("#editForm").serialize(),
  			"dataType":"JSON",
  			success: function(response) {
  				console.log(response['productUpdate']);
  				$('#edit-modal').modal('hide');
  				$("#prdTable #name"+$id).html(response['productUpdate'].name);
  				$("#prdTable #price"+$id).html(response['productUpdate'].price);
  				$("#prdTable #quantity"+$id).html(response['productUpdate'].quantity);
  			}
  		});
  	
  	});
  	$("#prdTable").on('click', '.btn-delete', function(){
		var id = $(this).data("id");
		var thisrow = $(this);
		swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this product!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$.ajax({
				  "type": "GET",
				  "url": "productDelete",
				  "data": {"productID":id},
				  "dataType": "JSON",
				  success: function(response) {
					    console.log('received this response: '+response);
					    	thisrow.closest("tr").remove();
						  	
			    		swal("Poof! Your Product has been deleted!", {
			      		icon: "success",
			    		});
						toastr.success(response['message']);
					},
					error: function(response){
						toastr.error(response['message']);
					}
				});
			  }
			});
		});
});