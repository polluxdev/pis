<div id="div-content">
  <section class="content-header">
    <h1>
      Data Tables Payment Channel
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-database"></i> Master Data</li>
      <li class="active"> Payment Channel</li>
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
                        Show Payment Channel
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
            <table id="payment-channel" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-5">Code</th>
                  <th class="col-md-6">Name</th>
                  <th class="col-md-1">Actions</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($payment); $i++)
                <tr>
                  <td>{{$payment[$i]['paymentChannelCode']}}</td>
                  <td>{{$payment[$i]['paymentChannelName']}}</td>
                  <td>
                    <a onClick="showPaymentChannelForm('{{ $payment[$i]['paymentChannelCode'] }}')" class="btn btn-info" type="button">
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
      $('#payment-channel').DataTable();
  });

  function showPaymentChannelForm(payment_code) {
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
      $.ajax({
          type : 'GET',
          url : '/payment-channel/single',
          data : {
              code : payment_code,
          },
          success : function(response){
              $('#form-show #code').val(response.value.paymentChannelCode);
              $('#form-show #name').val(response.value.paymentChannelName);
              $('#show-modal').modal('show');
          },
          error : function(data){
              console.log(data);
          }
      })
  }
</script>
