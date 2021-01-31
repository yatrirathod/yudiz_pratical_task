
<div id="edit-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100 font-weight-bold">Update Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
			</div>
			<form id="editForm" name="editForm" method="POST">
              	<div class="modal-body">
              	{{ csrf_field() }}
              	{{method_field('POST')}}
    			<input type="hidden" id="id" name="id" class='modal_hiddenid' value="">				
					<div class="form-group">
						<label for="pname">Name</label>
						<input type="text" name="editPrdName" id="editPrdName" class="form-control">
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="tetx" name="editPrdPrice" id="editPrdPrice" class="form-control">
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="text" name="editPrdQuantity" id="editPrdQuantity" class="form-control">
					</div>						
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" id="edit_submit">
				</div>
			</form>
		</div>
	</div>
</div>