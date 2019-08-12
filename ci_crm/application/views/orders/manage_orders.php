

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
                  <th>Order Name</th>
                  <th>Client</th>
                  <th>Budget</th>
                  <th>Submit Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($order_data as $row): ?>
                <tr>
                  <td><?= $row['orderName']; ?></td>
                  <td><?php foreach($row['client'] as $clients){ echo $clients->FirstName.' '.$clients->MiddleName.' '.$clients->LastName; } ?></td>
                  <td><?= $row['orderBudget']; ?></td>
                  <td><?= $row['orderDeadline']; ?></td>
                  <td>
                    <?php
                      if($row['orderStatus'] == 0){ echo "<kbd class='bg-red'>PENDING</kbd>"; }
                      else if($row['orderStatus'] == 1){ echo "<kbd class='bg-orange'>PROCESSING</kbd>"; }
                      else if($row['orderStatus'] == 3){ echo "<kbd class='bg-green'>COMPLETED</kbd>"; }
                      else { echo "<kbd class='bg-blue'>ERROR</kbd>"; }
                    ?>
                  </td>
                  <td><?= '<a href="view/'.$row['id'].'" class="btn btn-primary btn-xs">VIEW</a>&nbsp;<a href="edit/'.$row['id'].'" class="btn btn-danger btn-xs">EDIT</a>'; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Order Name</th>
                  <th>Client</th>
                  <th>Budget</th>
                  <th>Submit Date</th>
                  <th>Status</th>
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
