<div id="div-content">
  <!-- content -->
  <section class="content-header">
    <h1>
      User Data Tables
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-gear"></i> Setting</li>
      <li class="active"> Edit Password</li>
    </ol>
  </section>
  <!-- /.content -->
  <!-- content -->
  <section class="content">
    <!-- row -->
    <div class="row">
      <!-- col -->
      <div class="col-xs-12">
        <!-- box -->
        <div class="box">
          <!-- box-header -->
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <!-- box-body -->
          <div class="box-body">
            <table id="users-editpassword-table" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-2">Name</th>
                  <th class="col-md-2">Email</th>
                  <th class="col-md-2">Role</th>
                  <th class="col-md-3">Created at</th>
                  <th class="col-md-2">Actions</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody>
                <?php $no = 1 ?>
                @foreach ($users as $user)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role->name}}</td>
                  <td>{{date_format($user->created_at, "d-M-Y")}}</td>
                  <td>
                    <button onclick="editPassword({{$user->id}})" class="modal-show edit btn btn-info" title="Edit Password">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Password
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div class="modal fade" id="edit-pass-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form-edit">
        {{ csrf_field() }}
        <div class="modal-header">
          <div class="pull-left">
            <h4 class="modal-title">
              Edit Password
            </h4>
          </div>
          <div class="pull-right">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
            ×
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger hidden" id="add-error-bag">
            <ul id="res_message_error">
            </ul>
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
            <input class="form-control" id="new-password" name="newpassword" required="" type="password" placeholder="Enter New Password">
          </div>
          <div class="form-group">
            <label>
            Confirm New Password
            </label>
            <input class="form-control" id="confirm-password" name="confirmpassword" required="" type="password" placeholder="Re-Enter New Password">
          </div>
        </div>
        <div class="modal-footer">
          <input id="user-id" name="user-id" type="hidden" value="0">
          <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
          <button class="btn btn-info" id="btn-edit-pass" type="submit" value="add">
          Edit Password
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- Latest compiled JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.js" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Javascript -->
<script>
  $(document).ready(function() {
      $('#users-editpassword-table').DataTable();

      $('#btn-edit-pass').click(function(e){
          e.preventDefault();

          var user_id = $('#form-edit #user-id').val(),
              password = $('#form-edit').serialize();

          $.ajax({
              type : 'POST',
              url : '/edit-password/' + user_id,
              data : password,
              dataType : 'json',
              success : function(response){
                  $('#form-edit').trigger('reset');
                  $('#edit-pass-modal').modal('hide');
                  $('#res_message').show();
                  $('#res_message').html(response.messages);
                  $('#res_div').removeClass('hidden');
              },
              error : function(response){
                  var errors = $.parseJSON(response.responseText);
                  $('#res_message_error').html('');
                  $.each(errors.messages, function(key, value) {
                      $('#res_message_error').append('<li>' + value + '</li>');
                  });
                  $('#add-error-bag').removeClass('hidden');
              }
          })
      });
  });

  function editPassword(user_id) {
      $('#form-edit').trigger('reset');
      $.ajax({
          type : 'GET',
          url : '/edit-password/get-user',
          data : {
              user_id : user_id,
          },
          success : function (response) {
              $('#user-id').val(response.user.id);
              $('#edit-pass-modal').modal('show');
          },
          error : function(response){
              console.log(response);
          }
      })
  }
</script>
