<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Table</title>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <!-- DataTables Button -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <style media="screen">
      .container {
      margin-bottom: 50px;
      width: 95%;
      }
      h2 {
      text-align: center;
      margin-bottom: 50px;
      }
      .dt-buttons {
      margin-bottom: 10px;
      }
      .dt-head-center {
      text-align: center;
      }
      table.dataTable thead th {
      vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h2>Transaction Report Table</h2>
      </div>
      <div class="row">
        <table id="report-table" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Merchant</th>
              <th>Payment Gateway</th>
              <th>Payment Channel</th>
              <th>Periode Awal</th>
              <th>Periode Akhir</th>
              <th>Status</th>
              <th>Merchant Order ID</th>
              <th>PIS Order ID</th>
            </tr>
          </thead>
          {{csrf_field()}}
          <tbody>
            @for ($i = 0; $i < count($transaction); $i++)
            <tr>
              <td>{{$transaction[$i]['merchantCode']}}</td>
              <td>{{$transaction[$i]['merchantName']}}</td>
              <td>{{$transaction[$i]['status']}}</td>
              <td>{{$transaction[$i]['merchantOrderId']}}</td>
              <td>{{$transaction[$i]['pisOrderId']}}</td>
              <td>{{$transaction[$i]['status']}}</td>
              <td>{{$transaction[$i]['merchantOrderId']}}</td>
              <td>{{$transaction[$i]['pisOrderId']}}</td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
    </div>
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#report-table').DataTable({
          'columnDefs': [
            {
              'targets': '_all',
              'className': 'dt-head-center'
            }
          ],
          'paging': false,
          'info': false,
          'searching': false,
          dom: 'Bfrtip',
          buttons: [
              {
                  extend: 'print',
                  text: 'Print',
                  title: 'Transaction Report Table',
                  message: 'Transaction Report Table',
                  pageSize: 'A4',
                  autoPrint: false,
                  customize: function (win) {
                      $(win.document.body).find('h1').css('text-align', 'center');
                      $(win.document.body).find('h1').css('margin-bottom', '30px');
                      $(win.document.body).css( 'font-size', '12px' );
                      $(win.document.body).find( 'table' )
                      .addClass( 'compact' )
                      .css( 'font-size', 'inherit' );
                  }
              },
              {
                  extend: 'excelHtml5',
                  text: 'Excel',
                  title: 'Transaction Report Table',
                  messageTop: 'Transaction Report Table',
              },
              {
                  extend: 'pdfHtml5',
                  text: 'Pdf',
                  title: 'Transaction Report Table',
                  messageTop: 'Transaction Report Table',
                  orientation: 'landscape',
                  pageSize: 'A4',
              }
          ],
        });
      });
    </script>
  </body>
</html>
