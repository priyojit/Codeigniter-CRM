
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Peding Orders</th>
                  <th>Total Paid</th>
                  <th>Total Due</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($clients_data as $row): ?>
                <tr>
                  <td><?= $row['fullName']; ?></td>
                  <td><?= $row['email']; ?></td>
                  <td><?= $row['phone']; ?></td>
                  <td><?php if($row['order_data'] != null){echo $row['order_data']; }else{echo 0;} ?></td>
                  <td><?= $row['phone']; ?></td>
                  <td><?= $row['phone']; ?></td>
                  <td><?= '<a href="view/'.$row['id'].'" class="btn btn-primary btn-xs">VIEW</a>&nbsp;<a href="edit/'.$row['id'].'" class="btn btn-danger btn-xs">EDIT</a>'; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Peding Orders</th>
                  <th>Total Paid</th>
                  <th>Total Due</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
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
  <!-- /.content-wrapper -->
