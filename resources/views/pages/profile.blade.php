<div id="div-content">
  <div class="row">
    <div class="col col-md-12">
      <!-- success message div -->
      <div id="res_div" class="alert alert-success hidden">
        <span id="res_message"><strong></strong></span>
        <button id="close" aria-hidden="true" class="close" data-dismiss="modal" type="button">
        ×
        </button>
      </div>
      <!-- /.success message div -->
    </div>
  </div>
  <div class="row">
    <div class="col col-md-6">
      <!-- box-primary -->
      <div class="box box-primary">
        <!-- box-body -->
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" alt="User profile picture">
          <h3 class="profile-username text-center">{{$user->name}}</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Name</b>
              <p class="pull-right">{{$user->name}}</p>
            </li>
            <li class="list-group-item">
              <b>Email</b>
              <p class="pull-right">{{$user->email}}</p>
            </li>
            <li class="list-group-item">
              <b>Role</b>
              <p class="pull-right">{{$role->name}}</p>
            </li>
            <br>
            <a href="#" onclick="changePassword({{$user->id}})" class="btn btn-primary btn-block"><b>Change Password</b></a>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box-primary -->
    </div>
  </div>
</div>
<!-- Change Password Modal Form -->
<div class="modal fade" id="change-pass-modal">
  <div class="modal-dialog">
    <!-- modal-content -->
    <div class="modal-content">
      <!-- form-change -->
      <form id="form-change">
        {{ csrf_field() }}
        <!-- modal-header -->
        <div class="modal-header">
          <div class="pull-left">
            <h4 class="modal-title">
              Change Password
            </h4>
          </div>
          <div class="pull-right">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
            ×
            </button>
          </div>
        </div>
        <!-- /.modal-header -->
        <!-- modal-body -->
        <div class="modal-body">
          <div class="alert alert-danger hidden" id="add-error-bag">
            <ul id="res_message_error">
            </ul>
          </div>
          <div class="form-group">
            <label>
            Current Password
            </label>
            <input class="form-control" id="currentpassword" name="currentpassword" required="" type="password" placeholder="Enter Current Password">
          </div>
          <div class="form-group">
            <span><strong>Note :</strong></span>
            <br>
            <p>Password must be at least 8 characters and contain at least one lower case, upper case, number, and special character</p>
          </div>
          <div class="form-group">
            <label>
            New Password
            </label>
            <input class="form-control" id="newpassword" name="newpassword" required="" type="password" placeholder="Enter New Password">
          </div>
          <div class="form-group">
            <label>
            Confirm New Password
            </label>
            <input class="form-control" id="confirmpassword" name="confirmpassword" required="" type="password" placeholder="Re-Enter New Password">
          </div>
        </div>
        <!-- /.modal-body -->
        <!-- modal-footer -->
        <div class="modal-footer">
          <input id="user-id" name="user-id" type="hidden" value="">
          <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
          <button class="btn btn-info" id="btn-change" type="submit" value="add">
          Change Password
          </button>
        </div>
        <!-- /.modal-footer -->
      </form>
      <!-- /.form-change -->
    </div>
    <!-- /.modal-content -->
  </div>
</div>
<!-- /.Change Password Modal Form -->
<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
      $('#btn-change').click(function(e) {
          e.preventDefault();

          var user_id = $('#form-change #user-id').val(),
              data = $('#form-change').serialize();

          $.ajax({
              type: 'POST',
              url: '/profile/change-password/' + user_id,
              data: data,
              success: function(response) {
                  $('#form-change').trigger('reset');
                  $('#change-pass-modal').modal('hide');
                  $('#res_message').show();
                  $('#res_message').html(response.messages);
                  $('#res_div').removeClass('hidden');
              },
              error: function(response) {
                  var errors = $.parseJSON(response.responseText);
                  $('#res_message_error').html('');
                  $.each(errors.messages, function(key, value) {
                      $('#res_message_error').append('<li>' + value + '</li>');
                  });
                  $('#add-error-bag').removeClass('hidden');
              }
          })
      });

      $('#close').click(function() {
          $('.alert-success').addClass('hidden');
      });
  });

  function changePassword(user_id) {
      $('#form-change').trigger('reset');
      $.ajax({
          type: 'GET',
          url: '/profile/change-password',
          data: {
              user_id: user_id,
          },
          success: function(response) {
              $('#form-change #user-id').val(response.user.id);
              $('#change-pass-modal').modal('show');
          },
          error: function(response) {
              console.log(response);
          }
      })
  }
</script>
