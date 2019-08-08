<div id="div-content">
  <section class="content-header">
    <h1>
      User Data Tables
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-gear"></i> Setting</li>
      <li class="active"> User</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <input id="create_action" name="create_action" type="hidden" value="create_user">
            @if ($create)
            <div class="pull-left">
              <a onclick="createUser()" class="btn btn-success modal-show" title="Create New"><i class="fa fa-plus"></i> Add</a>
            </div>
            <br>
            <br>
            @endif
            <div id="res_div" class="alert alert-success hidden">
              <span id="res_message"><strong></strong></span>
              <button id="close" aria-hidden="true" class="close" data-dismiss="modal" type="button">
              ×
              </button>
            </div>
          </div>
          <!-- Add Task Modal Form HTML -->
          <div class="modal fade" id="create-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="form-create">
                  {{ csrf_field() }}
                  <div class="modal-header">
                    <div class="pull-left">
                      <h4 class="modal-title">
                        Add New User
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
                      <ul id="add-user-errors">
                      </ul>
                    </div>
                    <div class="form-group">
                      <label>
                      Name
                      </label>
                      <input class="form-control" id="name" name="name" required="" type="text" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                      <label>
                      Email
                      </label>
                      <input class="form-control" id="email" name="email" required="" type="text" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                      <label>
                      Role
                      </label>
                      <input class="form-control" id="role_id" name="role_id" type="hidden" value="">
                      <select id="select-user-role-create" class="form-control" name="user-role">
                        <option value="">-- Select User Role --</option>
                        @for ($i = 0; $i < count($roles); $i++)
                        <option value="{{ $roles[$i]->id }}">
                          {{ $roles[$i]->name }}
                        </option>
                        @endfor
                      </select>
                    </div>
                    <div class="form-group">
                      <span><strong>Note :</strong></span>
                      <br>
                      <p>Password must be at least 8 characters and contain at least one lower case, upper case, number, and special character</p>
                    </div>
                    <div class="form-group">
                      <label>
                      Password
                      </label>
                      <input class="form-control" id="password" name="password" required="" type="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                      <label>
                      Confirm Password
                      </label>
                      <input class="form-control" id="confirmpassword" name="confirmpassword" required="" type="password" placeholder="Enter Confirm Password">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-add" type="submit" value="add">
                    Create
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Show Modal HTML -->
          <div class="modal fade" id="show-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="form-show">
                  {{ csrf_field() }}
                  <div class="modal-header">
                    <div class="pull-left">
                      <h4 class="modal-title">
                        Show User
                      </h4>
                    </div>
                    <div class="pull-right">
                      <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                      ×
                      </button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <fieldset disabled>
                      <div class="form-group">
                        <label>
                        Name
                        </label>
                        <input class="form-control" id="name" name="name" required="" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Email
                        </label>
                        <input class="form-control" id="email" name="email" required="" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Role
                        </label>
                        <input class="form-control" id="role" name="role" required="" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Created at
                        </label>
                        <input class="form-control" id="created-at" name="created-at" required="" type="text">
                      </div>
                    </fieldset>
                  </div>
                  <div class="modal-footer">
                    <input id="user-id" name="user-id" type="hidden" value="0">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Close">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Edit Modal HTML -->
          <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="form-edit">
                  {{ csrf_field() }}
                  <div class="modal-header">
                    <div class="pull-left">
                      <h4 class="modal-title">
                        Edit User
                      </h4>
                    </div>
                    <div class="pull-right">
                      <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                      ×
                      </button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-danger hidden" id="edit-error-bag">
                      <ul>
                        <li id="edit-user-errors">
                        </li>
                      </ul>
                    </div>
                    <div class="form-group">
                      <label>
                      Name
                      </label>
                      <input class="form-control" id="name" name="name" required="" type="text">
                    </div>
                    <div class="form-group">
                      <label>
                      Email
                      </label>
                      <input class="form-control" id="email" name="email" required="" type="text">
                    </div>
                    <div class="form-group">
                      <label>
                      Role
                      </label>
                      <input class="form-control" id="role_id" name="role_id" type="hidden" value="">
                      <select id="select-user-role-edit" class="form-control" name="user-role">
                        @for ($i = 0; $i < count($roles); $i++)
                          <option value="{{ $roles[$i]->id }}">
                            {{ $roles[$i]->name }}
                          </option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input id="user-id" name="user-id" type="hidden" value="0">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-info" id="btn-edit" type="button" value="add">
                    Update
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Delete Task Modal Form HTML -->
          <div class="modal fade" id="delete-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="form-delete">
                  {{ csrf_field() }}
                  <div class="modal-header">
                    <div class="pull-left">
                      <h4 class="modal-title" id="delete-title" name="title">
                      </h4>
                    </div>
                    <div class="pull-right">
                      <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                      ×
                      </button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <p>
                      Are you sure you want to delete this user?
                    </p>
                    <p class="text-warning">
                      <small>
                      This action cannot be undone.
                      </small>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <input id="user-id" name="user-id" type="hidden" value="0">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                    <button class="btn btn-danger" id="btn-delete" type="button">
                    Delete Task
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="user-table" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-1">No</th>
                  <th class="col-md-2">Name</th>
                  <th class="col-md-2">Email</th>
                  <th class="col-md-2">Role</th>
                  <th class="col-md-2">Created at</th>
                  <th class="col-md-3">Actions</th>
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
                    @if ($show)
                    <button onclick="showUser({{$user->id}})" class="show-modal btn btn-info" title="Show">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Show
                    </button>
                    @endif
                    @if ($update)
                    <button onclick="editUser({{$user->id}})" class="modal-show edit btn btn-warning" title="Edit">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit
                    </button>
                    @endif
                    @if ($delete)
                    <button onclick="deleteUser({{$user->id}})" class="delete-modal btn btn-danger" title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                    Delete
                    </button>
                    @endif
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
  $(document).ready(function(){
      $('#user-table').DataTable();

      $('#btn-add').click(function(e){
          $('#add-error-bag').addClass('hidden');
          e.preventDefault();
          var data = $('#form-create').serialize();
          $('#close').click();

          $.ajax({
              type : 'POST',
              url : '/user',
              data : data,
              success : function(data){
                  $('#form-create').trigger("reset");
                  $('#create-modal').modal('hide');
                  $('#res_message').show();
                  $('#res_message').html(data.success);
                  $('#res_div').removeClass('hidden');
              },
              error: function(response) {
                  var errors = $.parseJSON(response.responseText);
                  $('#add-user-errors').html('');
                  $.each(errors.messages, function(key, value) {
                      $('#add-user-errors').append('<li>' + value + '</li>');
                  });
                  $('#add-error-bag').removeClass('hidden');
              }
          })
      });

      $('#btn-edit').click(function(e) {
          $("#edit-error-bag").addClass('hidden');
          e.preventDefault();
          var user_id = $('#form-edit #user-id').val();
              data = $('#form-edit').serialize();
          $('#close').click();
          $.ajax({
              type: 'PUT',
              url: '/user/' + user_id,
              data: data,
              success: function(response) {
                  $('#form-edit').trigger("reset");
                  $('#edit-modal').modal('hide');
                  $('#res_message').show();
                  $('#res_message').html(response.success);
                  $('#res_div').removeClass('hidden');
              },
              error: function(response) {
                  var errors = $.parseJSON(response.responseText);
                  $('#edit-user-errors').html('');
                  $.each(errors.messages, function(key, value) {
                      $('#edit-user-errors').append('<li>' + value + '</li>');
                  });
                  $("#edit-error-bag").removeClass('hidden');
                  console.log(response.messages);
              }
          });
      });

      $("#btn-delete").click(function(e) {
          e.preventDefault();
          var user_id = $('#form-delete #user-id').val(),
              data = $('#form-delete').serialize();
          $('#close').click();

          $.ajax({
              type: 'DELETE',
              url: '/user/' + user_id,
              data: data,
              success: function(response) {
                  $('#delete-modal').modal('hide');
                  $('#res_message').show();
                  $('#res_message').html(response.success);
                  $('#res_div').removeClass('hidden');
              },
              error: function(response) {
                  console.log(response);
              }
          });
      });

      $('#close').click(function(){
          $('.alert-success').addClass('hidden');
      });
  })

  function createUser(){
      $(document).ready(function() {
          $('#form-create').trigger('reset');
          $('#create-modal').modal('show');
          $('#select-user-role-create').on('change', function(){
              var role = $(this).val();
              console.log(role);
              $('#form-create #role_id').val(role);
          });
      });
  }

  function showUser(user_id){
      $.ajax({
          type : 'GET',
          url : '/user/' + user_id,
          success : function(data){
              $('#form-show #name').val(data.user.name);
              $('#form-show #email').val(data.user.email);
              $('#form-show #created-at').val(data.user.created_at);
              if (data.user.role_id == 1){
                  $('#form-show #role').val('Supervisor');
              } else if (data.user.role_id == 2){
                  $('#form-show #role').val('Manager');
              } else {
                  $('#form-show #role').val('Staff');
              }
              $('#show-modal').modal('show');
          },
          error : function(data){
              console.log(data);
          }
      })
  }

  function editUser(user_id){
      $('#edit-error-bag').addClass('hidden');
      $('#form-edit').trigger('reset');
      $.ajax({
          type : 'GET',
          url : '/user/' + user_id,
          success : function(data){
              $('#form-edit #user-id').val(data.user.id);
              $('#form-edit #name').val(data.user.name);
              $('#form-edit #email').val(data.user.email);
              $('#form-edit #role_id').val(data.user.role_id);
              $('#select-user-role-edit').find('option[value='+data.user.role_id+']').prop('selected', true);
              $('#edit-modal').modal('show');
              $('#select-user-role-edit').on('change', function(){
                  var role = $(this).val();
                  $('#form-edit #role_id').val(role);
              });
          },
          error : function(data){
              console.log(data);
          }
      })
  }

  function deleteUser(user_id) {
      $.ajax({
          type : 'GET',
          url : '/user/' + user_id,
          success : function(data){
              $('#form-delete #user-id').val(data.user.id);
              $('#form-delete #delete-title').html("Delete User (" + data.user.name + ")?");
              $('#delete-modal').modal('show');
          },
          error : function(data){
              console.log(data);
          }
      })
  }

</script>
