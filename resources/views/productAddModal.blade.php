
<div id="add-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100 font-weight-bold">Product form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
			</div>
			<form id="addProduct" name="addProduct" method="POST">
              	<div class="modal-body">
              	{{ csrf_field() }}				
					<div class="form-group">
						<label for="pname">Name</label>
						<input type="text" name="pname" id="pname" class="form-control">
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" name="price" id="price" class="form-control">
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="text" name="quantity" id="quantity" class="form-control">
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status">
							<option value="">Select Status</option>
							<option value="active">Active</option>
							<option value="inactive">InActive</option>
						</select>
					</div>					
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" id="add_submit">
				</div>
			</form>
		</div>
	</div>
</div>
