
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
            <?php echo form_open('clients/add_clients', array('role' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
              <div class="box-body">
                <?php if(!empty(validation_errors())){ ?><div class="validate-status valerrorbox"><?= validation_errors(); ?></div><?php } ?>
                <?php if(!empty($this->session->flashdata('email_exist'))){ ?><div class="validate-status valerrorbox"><?= $this->session->flashdata('email_exist'); ?></div><?php } ?>
                <?php if(!empty($this->session->flashdata('error_occurred'))){ ?><div class="validate-status valerrorbox"><?= $this->session->flashdata('error_occurred'); ?></div><?php } ?>
                <?php if(!empty($this->session->flashdata('client_added'))){ ?><div class="validate-status valsuccessbox"><?= $this->session->flashdata('client_added'); ?></div><?php } ?>
                <div class="form-group">
                  <span class="col-md-4">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name">
                  </span>
                  <span class="col-md-4">
                    <label for="MiddleName">Middle Name</label>
                    <input type="text" class="form-control" id="MiddleName" name="MiddleName" placeholder="Enter Middle Name">
                  </span>
                  <span class="col-md-4">
                    <label for="FirstName">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name">
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-4">
                    <label for="EmailAddress">Email Address</label>
                    <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Enter Email Address">
                  </span>
                  <span class="col-md-4">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Enter Phone Number" data-inputmask='"mask": "9999999999"' data-mask>
                  </span>
                  <span class="col-md-4">
                    <label for="Company">Company Name</label>
                    <input type="text" class="form-control" id="Company" name="Company" placeholder="Enter Company Name">
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-12">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Address">
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-6">
                    <label for="City">City</label>
                    <input type="text" class="form-control" id="City" name="City" placeholder="Enter City">
                  </span>
                  <span class="col-md-6">
                    <label for="State">State</label>
                    <select class="form-control" id="State" name="State">
                      <option value="">Select a State</option>
                    </select>
                  </span>
                </div>
                <div class="form-group">
                  <span class="col-md-6">
                    <label for="Country">Country</label>
                    <select class="form-control" id="Country" name="Country">
                      <option value="">Select a Country</option>
                      <?php foreach ($country as $row): ?>
                        <option value="<?= $row->Name; ?>" data-countryid="<?= $row->id; ?>"><?= $row->Name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </span>
                  <span class="col-md-6">
                    <label for="Pincode">Pincode</label>
                    <input type="text" class="form-control" id="Pincode" name="Pincode" placeholder="Enter Pincode">
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
