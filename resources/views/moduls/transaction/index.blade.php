<div id="div-content">
  <section class="content-header">
    <h1>
      Data Tables Transaction
    </h1>
    <ol class="breadcrumb">
      <li onclick="changeMenu('/transaction')" class="active"><a href="#"><i class="fa fa-address-book"></i>Transaction</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="transaction" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-4">Merchant Order ID</th>
                  <th class="col-md-4">PIS Order ID</th>
                  <th class="col-md-3">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($transaction); $i++)
                <tr>
                  <td>{{$transaction[$i]['merchantOrderId']}}</td>
                  <td>{{$transaction[$i]['pisOrderId']}}</td>
                  <td>{{$transaction[$i]['status']}}</td>
                  <td>
                    <a onClick="showDetailTransaction('{{$transaction[$i]['pisOrderId']}}')" class="btn btn-info" type="button">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Detail
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
      $('#transaction').DataTable();
  });

  function showDetailTransaction(pis_order_id) {
      $('#content-wrapper').hide();
      $.ajax({
          type : 'GET',
          url : '/transaction/detail',
          data : {
              pis_order_id : pis_order_id,
          },
          success : function(data){
              $('#content-wrapper').show();
              $('#container-div').html(data);
          },
          error : function(data){
              console.log(data);
          }
      })
  }
</script>
