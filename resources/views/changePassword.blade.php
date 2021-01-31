<!-- Modal -->
  
  <div class="modal fade" id="ChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right">Your email</label>
          <input type="email" id="useremail" name="useremail" class="form-control">
        </div>
        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right">Current password</label>
          <input type="password" id="user_oldPass" class="form-control">
        </div>
        <div class="md-form mb-4">
          <label data-error="wrong" data-success="right">New password</label>
          <input type="password" id="user_newPass" class="form-control">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <a><button class="btn btn-default" id="changePassword">Save</button></a>
      </div>
    </div>
  </div>
</div>

