<div id="div-content">
  <section class="content-header">
    <h1>
      Roles Data Tables
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-gear"></i> Setting</li>
      <li class="active"> Role</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h4>Your Access List</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form id="role-checkbox-form">
              <ul class="treeview-animated-list mb-3">
                {!! $html !!}
              </ul>
            </form>
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
    $('#role-checkbox-form').find('input').prop('disabled', true);
  });
</script>
