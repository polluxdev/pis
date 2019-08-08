<div id="merchant-channel-div" class="box-body">
  <div class="modal fade" id="show-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form-show">
          {{ csrf_field() }}
          <div class="modal-header">
            <div class="pull-left">
              <h4 class="modal-title">
                Show Payment Gateway
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
                Merchant Code
                </label>
                <input class="form-control" id="merchant" name="merchant-code" type="text">
              </div>
              <div class="form-group">
                <label>
                Payment Channel Code
                </label>
                <input class="form-control" id="channel" name="payment-channel-code" type="text">
              </div>
              <div class="form-group">
                <label>
                Payment Gateway Code
                </label>
                <input class="form-control" id="gateway" name="payment-gateway-code" type="text">
              </div>
              <div class="form-group">
                <label>
                Status
                </label>
                <input class="form-control" id="status" name="merchant-channel-status" type="text">
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
  <table id="merchant-channel-table" class="table table-bordered table-striped display" style="width: 100%">
    <thead>
      <tr>
        <th class="col-md-3">Merchant Code</th>
        <th class="col-md-4">Payment Channel Code</th>
        <th class="col-md-4">Payment Gateway Code</th>
        <th class="col-md-4">Status</th>
        <th class="col-md-1">Actions</th>
      </tr>
    </thead>
    {{csrf_field()}}
    <tbody id="table-body">
      <?php $no = 1?>
      @for ($j = 0; $j < count($channel); $j++)
      <tr>
        <td>{{$channel[$j]['merchantCode']}}</td>
        <td>{{$channel[$j]['paymentChannelCode']}}</td>
        <td>{{$channel[$j]['paymentGatewayCode']}}</td>
        @if ($channel[$j]['merchantChannelStatus'] == 1)
        <td>Active</td>
        @else
        <td>Non-Active</td>
        @endif
        <td>
          <a id="show-channel" class="btn btn-info" type="button" data-merchant="{{$channel[$j]['merchantCode']}}"
          data-channel="{{$channel[$j]['paymentChannelCode']}}" data-gateway="{{$channel[$j]['paymentGatewayCode']}}"
          @if ($channel[$j]['merchantChannelStatus'] == 1)
          data-status="Active"
          @else
          data-status="Inactive"
          @endif>
          <span class="glyphicon glyphicon-eye-open"></span>
          Show
          </a>
        </td>
      </tr>
      @endfor
    </tbody>
  </table>
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
  $(document).ready(function() {
      $('#merchant-channel-table').DataTable();
  });

  $('body').on('click','#show-channel',function(){
      $('#show-modal').modal('show');
      $('#merchant').val($(this).data('merchant'));
      $('#channel').val($(this).data('channel'));
      $('#gateway').val($(this).data('gateway'));
      $('#status').val($(this).data('status'));
  });
</script>
