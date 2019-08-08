<div id="div-content">
  <section class="content-header">
    <h1>
      Data Tables Merchant
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-database"></i> Master Data</li>
      <li class="active"> Merchant</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="modal fade" id="show-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form id="form-show">
                  {{ csrf_field() }}
                  <div class="modal-header">
                    <div class="pull-left">
                      <h4 class="modal-title">
                        Show Merchant
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
                        Code
                        </label>
                        <input class="form-control" id="code" name="code" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Name
                        </label>
                        <input class="form-control" id="name" name="name" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Email
                        </label>
                        <input class="form-control" id="email" name="email" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Phone
                        </label>
                        <input class="form-control" id="phone" name="phone" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        PIS Key
                        </label>
                        <input class="form-control" id="piskey" name="piskey" type="text">
                      </div>
                      <div class="form-group">
                        <label>
                        Status
                        </label>
                        <input class="form-control" id="status" name="status" type="text">
                      </div>
                    </fieldset>
                  </div>
                  <div class="modal-footer">
                    <input id="payment_no" name="payment_no" type="hidden" value="0">
                    <input class="btn btn-default" data-dismiss="modal" type="button" value="Close">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="merchant" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-5">Code</th>
                  <th class="col-md-6">Name</th>
                  <th class="col-md-1">Actions</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($merchant); $i++)
                <tr>
                  <td>{{$merchant[$i]['merchantCode']}}</td>
                  <td>{{$merchant[$i]['merchantName']}}</td>
                  <td>
                    <a onClick="showMerchantForm('{{ $merchant[$i]['merchantCode'] }}')" class="btn btn-info" type="button">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Show
                    </a>
                  </td>
                </tr>
                @endfor
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
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Javascript -->
<script type="text/javascript">
  $(document).ready(function() {
      $('#merchant').DataTable();
  });

  function showMerchantForm(merchant_code) {
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
      $.ajax({
          type : 'GET',
          url : '/merchant/single',
          data : {
              code : merchant_code,
          },
          success : function(response){
              $('#form-show #code').val(response.value.merchantCode);
              $('#form-show #name').val(response.value.merchantName);
              $('#form-show #email').val(response.value.merchantEmail);
              $('#form-show #phone').val(response.value.merchantPhone);
              $('#form-show #piskey').val(response.value.pisKey);
              if (response.value.merchantStatus == 1) {
                  $('#form-show #status').val('Active');
              } else {
                  $('#form-show #status').val('Non-Active');
              }
              $('#show-modal').modal('show');
          },
          error : function(data){
              console.log(data);
          }
      })
  }
</script>
