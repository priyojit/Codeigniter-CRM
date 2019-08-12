
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('orders/add_orders', array('role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
              <div class="box-body">
                <?php if(!empty(validation_errors())){ ?><div class="validate-status valerrorbox"><?= validation_errors(); ?></div><?php } ?>
                <?php if(!empty($this->session->flashdata('error_occurred'))){ ?><div class="validate-status valerrorbox"><?= $this->session->flashdata('error_occurred'); ?></div><?php } ?>
                <?php if(!empty($this->session->flashdata('client_added'))){ ?><div class="validate-status valsuccessbox"><?= $this->session->flashdata('client_added'); ?></div><?php } ?>
                <div class="form-group">
                  <span class="col-md-12">
                    <label for="order_name">Product Name</label>
                    <input type="text" class="form-control" id="order_name" name="order_name" placeholder="Enter Product Name">
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-4">
                    <label for="order_client">Select Client</label>
                    <select class="form-control" id="order_client" name="order_client">
                      <option value="">Select a Client</option>
                      <?php foreach ($clients as $row): ?>
                        <option value="<?= $row->id; ?>"><?= $row->FirstName.' '.$row->MiddleName.' '.$row->LastName; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </span>
                  <span class="col-md-4">
                    <label for="order_budget">Budget / Price</label>
                    <input type="text" class="form-control text-left" id="order_budget" name="order_budget" placeholder="Enter Order Budget or Price" data-inputmask="'alias': 'numeric', 'rightAlign':false, 'allowMinus':false" data-mask>
                  </span>
                  <span class="col-md-4">
                    <label for="order_deadline">Submit Date</label>
                    <input type="text" class="form-control" id="datepicker" name="order_deadline" placeholder="Enter Submission Date">
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-6">
                    <label for="order_document">Document</label>
                    <input type="file" class="form-control" id="order_document" name="order_document" placeholder="Choose Document">
                  </span>
                  <span class="col-md-6">
                    <label for="order_cat">Priority</label>
                    <select class="form-control" id="order_cat" name="order_cat">
                      <option value="">Select a Priority</option>
                      <option value="2">Normal</option>
                    </select>
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-12">
                    <label for="order_msg">Message (optional)</label>
                    <textarea class="form-control" id="order_msg" name="order_msg" placeholder="Enter Message" rows="5"></textarea>
                  </span>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
$('#Country').on('change', function(){

  var countryID = $("option:selected", this).data('countryid');
  if(countryID == null){
    $('#State').html('<option value="">Select a State</option>');
  }else{
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>clients/getStateByCountry/'+countryID,
      data: 'countryID='+countryID,
      success: function(response){
        $('#State').html(response);
      }
    });
  }
});
</script>
