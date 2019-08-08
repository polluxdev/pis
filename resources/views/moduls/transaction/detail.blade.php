<div id="div-content">
  <!-- content-header -->
  <section class="content-header">
    <h1>
      Detail Transaction
    </h1>
    <ol class="breadcrumb">
      <li onclick="changeMenu('/transaction')"><a href="#"><i class="fa fa-dashboard"></i>Transaction</a></li>
      <li class="active"><a href="#">Detail</a></li>
    </ol>
  </section>
  <!-- /.content-header -->
  <!-- Show Modal Form -->
  <div class="modal fade" id="show-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form-show">
          {{ csrf_field() }}
          <div class="modal-header">
            <div class="pull-left">
              <h4 class="modal-title">
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
                Merchant Order ID
                </label>
                <input class="form-control" id="merchant_order_id" name="merchant_order_id" type="text">
              </div>
              <div class="form-group">
                <label>
                PIS Order ID
                </label>
                <input class="form-control" id="pis_order_id" name="pis_order_id" type="text">
              </div>
              <div class="form-group">
                <label>
                Date
                </label>
                <input class="form-control" id="date_time" name="date_time" type="text">
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
  <!-- /.Show Modal Form -->
  <!-- content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="pull-left">
              <h4>
                Payment Request
              </h4>
            </div>
            <div class="pull-right">
              <button onclick="changeMenu('/transaction')" class="btn btn-info" type="button">Back
              <span class="glyphicon glyphicon-chevron-right"></span>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="transaction" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-3">Merchant Order ID</th>
                  <th class="col-md-4">PIS Order ID</th>
                  <th class="col-md-2">Datetime</th>
                  <th class="col-md-2">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($transaction); $i++)
                  @if (strtolower($transaction[$i]['transType']) == 'request')
                  <tr>
                    <td>{{$transaction[$i]['merchantOrderId']}}</td>
                    <td>{{$transaction[$i]['pisOrderId']}}</td>
                    <td>{{$transaction[$i]['createdTime']}}</td>
                    <td>{{$transaction[$i]['status']}}</td>
                    <td>
                      <a id="show-payment-request" onClick="showDetailPaymentRequest({{$transaction[$i]['id']}})" class="btn btn-info" type="button"
                      data-merchant="{{$transaction[$i]['merchantOrderId']}}" data-pis="{{$transaction[$i]['pisOrderId']}}"
                      data-datetime="{{$transaction[$i]['createdTime']}}" data-status="{{$transaction[$i]['status']}}">
                      <span class="glyphicon glyphicon-eye-open"></span> Detail
                      </a>
                    </td>
                  </tr>
                  @endif
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="pull-left">
              <h4>
                Payment Notification
              </h4>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="transaction" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-3">Merchant Order ID</th>
                  <th class="col-md-4">PIS Order ID</th>
                  <th class="col-md-2">Datetime</th>
                  <th class="col-md-2">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($transaction); $i++)
                  @if (strtolower($transaction[$i]['transType']) == 'notification')
                    <tr>
                      <td>{{$transaction[$i]['merchantOrderId']}}</td>
                      <td>{{$transaction[$i]['pisOrderId']}}</td>
                      <td>{{$transaction[$i]['createdTime']}}</td>
                      <td>{{$transaction[$i]['status']}}</td>
                      <td>
                        <a id="show-payment-notification" onClick="showDetailPaymentNotification({{$transaction[$i]['id']}})" class="btn btn-info" type="button"
                        data-merchant="{{$transaction[$i]['merchantOrderId']}}" data-pis="{{$transaction[$i]['pisOrderId']}}"
                        data-datetime="{{$transaction[$i]['createdTime']}}" data-status="{{$transaction[$i]['status']}}">
                        <span class="glyphicon glyphicon-eye-open"></span> Detail
                        </a>
                      </td>
                    </tr>
                  @endif
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="pull-left">
              <h4>
                Payment Confirmation
              </h4>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="transaction" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-3">Merchant Order ID</th>
                  <th class="col-md-4">PIS Order ID</th>
                  <th class="col-md-2">Datetime</th>
                  <th class="col-md-2">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($transaction); $i++)
                  @if (strtolower($transaction[$i]['transType']) == 'confirmation')
                    <tr>
                      <td>{{$transaction[$i]['merchantOrderId']}}</td>
                      <td>{{$transaction[$i]['pisOrderId']}}</td>
                      <td>{{$transaction[$i]['createdTime']}}</td>
                      <td>{{$transaction[$i]['status']}}</td>
                      <td>
                        <a id="show-payment-confirmation" onClick="showDetailPaymentConfirmation({{$transaction[$i]['id']}})" class="btn btn-info" type="button"
                        data-merchant="{{$transaction[$i]['merchantOrderId']}}" data-pis="{{$transaction[$i]['pisOrderId']}}"
                        data-datetime="{{$transaction[$i]['createdTime']}}" data-status="{{$transaction[$i]['status']}}">
                        <span class="glyphicon glyphicon-eye-open"></span> Detail
                        </a>
                      </td>
                    </tr>
                  @endif
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="pull-left">
              <h4>
                Payment Log
              </h4>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="transaction" class="table table-bordered table-striped display" style="width: 100%">
              <thead>
                <tr>
                  <th class="col-md-3">Merchant Order ID</th>
                  <th class="col-md-4">PIS Order ID</th>
                  <th class="col-md-2">Datetime</th>
                  <th class="col-md-2">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              {{csrf_field()}}
              <tbody id="table-body">
                @for ($i = 0; $i < count($transaction); $i++)
                  @if (strtolower($transaction[$i]['transType']) == 'log')
                    <tr>
                      <td>{{$transaction[$i]['merchantOrderId']}}</td>
                      <td>{{$transaction[$i]['pisOrderId']}}</td>
                      <td>{{$transaction[$i]['createdTime']}}</td>
                      <td>{{$transaction[$i]['status']}}</td>
                      <td>
                        <a id="show-payment-log" onClick="showDetailPaymentLog({{$transaction[$i]['id']}})" class="btn btn-info" type="button"
                        data-merchant="{{$transaction[$i]['merchantOrderId']}}" data-pis="{{$transaction[$i]['pisOrderId']}}"
                        data-datetime="{{$transaction[$i]['createdTime']}}" data-status="{{$transaction[$i]['status']}}">
                        <span class="glyphicon glyphicon-eye-open"></span> Detail
                        </a>
                      </td>
                    </tr>
                  @endif
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
<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click', '#show-payment-request', function() {
        $('#merchant_order_id').val($(this).data('merchant'));
        $('#pis_order_id').val($(this).data('pis'));
        $('#date_time').val($(this).data('datetime'));
        $('#status').val($(this).data('status'));
    });

    $('body').on('click', '#show-payment-notification', function() {
        $('#merchant_order_id').val($(this).data('merchant'));
        $('#pis_order_id').val($(this).data('pis'));
        $('#date_time').val($(this).data('datetime'));
        $('#status').val($(this).data('status'));
    });

    $('body').on('click', '#show-payment-confirmation', function() {
        $('#merchant_order_id').val($(this).data('merchant'));
        $('#pis_order_id').val($(this).data('pis'));
        $('#date_time').val($(this).data('datetime'));
        $('#status').val($(this).data('status'));
    });

    $('body').on('click', '#show-payment-log', function() {
        $('#merchant_order_id').val($(this).data('merchant'));
        $('#pis_order_id').val($(this).data('pis'));
        $('#date_time').val($(this).data('datetime'));
        $('#status').val($(this).data('status'));
    });
  });

  function showDetailPaymentRequest() {
      $('#form-show .modal-title').html('Show Payment Request');
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
  }

  function showDetailPaymentNotification() {
      $('#form-show .modal-title').html('Show Payment Notification');
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
  }

  function showDetailPaymentConfirmation() {
      $('#form-show .modal-title').html('Show Payment Confirmation');
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
  }

  function showDetailPaymentLog() {
      $('#form-show .modal-title').html('Show Payment Log');
      $('#form-show').trigger('reset');
      $('#show-modal').modal('show');
  }
</script>
