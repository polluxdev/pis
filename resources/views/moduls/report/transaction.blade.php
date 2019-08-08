<div id="div-content">
  <section class="content-header">
    <h1>
      Data Tables Merchant Channel
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-database"></i> Master Data</li>
      <li class="active"> Merchant Channel</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <form id="form-report">
                <div class="col col-md-6">
                  <div class="row justify-content-lg-center">
                    <div class="col col-md-6">
                      <div class="form-group">
                        <input class="form-control" id="keyword" name="keyword" type="hidden" value="">
                        <select id="select-report-keyword" class="form-control select2" name="report-transaction">
                          <option value="">-- Select Report Keyword --</option>
                          <!-- @for ($i = 0; $i < 10; $i++)
                          @if ($transaction[$i]['merchantCode'] != null)
                          @if ($transaction[$i]['merchantCode'] != $transaction[$i+1]['merchantCode'])
                          <option value="{{$transaction[$i]['merchantCode']}}">
                            {{$transaction[$i]['merchantCode']}}
                          </option>
                          @endif
                          @endif
                          @endfor -->
                        </select>
                      </div>
                    </div>
                    <div class="col col-md-2">
                      <input id="merchant-id" name="merchant-id" type="hidden" value="0">
                      <a id="search-btn" href="#" onclick="showMerchantChannelForm()" class="btn btn-info" type="submit">Generate</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div id="merchant-channel-div" class="box-body">
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
<!-- Select2 -->
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<!-- DataTables Javascript -->
<script type="text/javascript">
  $(document).ready(function(){
      $('.select2').select2();
  });
  // $('#select-report-keyword').on('change', function() {
  //     var keyword = $(this).val();
  //     console.log(code);
  //     $('#form-report #keyword').val(keyword);
  // });

  function showMerchantChannelForm() {
      // var code = $('#merchant-id').val();
      $.ajax({
          type: 'GET',
          url: '/report/transaction/table',
          // data: {
          //     code: code,
          // },
          success: function(data) {
              window.open('/report/transaction/table', '_blank');
          },
          error: function(data) {
              console.log(data);
          }
      })
  }
</script>
