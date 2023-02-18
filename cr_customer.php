<?php
ob_start();
session_start();
    $page_title ="Data User";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    $customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);
    $custname = mysqli_real_escape_string($con, $_POST['custname']);
    $forname = mysqli_real_escape_string($con, $_POST['forname']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
    $phoneauthorized = mysqli_real_escape_string($con, $_POST['phoneauthorized']);
    $dateofcontract = mysqli_real_escape_string($con, $_POST['dateofcontract']);
    $service_id = mysqli_real_escape_string($con, $_POST['service_id']);
    $active_date = mysqli_real_escape_string($con, $_POST['active_date']);
    $warranty_period = mysqli_real_escape_string($con, $_POST['warranty_period']);
    $servers = mysqli_real_escape_string($con, $_POST['servers']);
    $subsidiary_devices = mysqli_real_escape_string($con, $_POST['subsidiary_devices']);
    // $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
  if(!$con)
  {
    die("connection failed" .mysqli_connect_error());
  }
  else
  {
    $sql = "INSERT INTO customer_tb(customer_id, custname, forname, phonenumber, email, authorizedname, phoneauthorized, dateofcontract, service_id, active_date, warranty_period, servers, subsidiary_devices)
    VALUES ('".$customer_id."', '".$custname."', '".$forname."', '".$phonenumber."', '".$email."', '".$authorizedname."', '".$phoneauthorized."', '".$dateofcontract."', '".$service_id."', '".$active_date."', '".$warranty_period."', '".$servers."', '".$subsidiary_devices."')";
    if(mysqli_query($con, $sql))
    $query = "SELECT customer_id from customer_tb order by customer_id desc";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['customer_id'];

    if(empty($lastid))
    {
      $number = "CU-00001";
    }
    else
    {
      $idd = str_replace("CU-","",$lastid);
      $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
      $number = 'CU-'.$id;
    }
  }
}
$query = "SELECT customer_id from customer_tb order by customer_id desc";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['customer_id'];

if(empty($lastid))
{
  $number = "CU-00001";
}
else
{
  $idd = str_replace("CU-","",$lastid);
  $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
  $number = 'CU-'.$id;
}
?>

      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- User Modal -->
  <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
      <form action="<?php echo($_SERVER["PHP_SELF"]) ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="floatingInput">Customer ID</label>
                <input type="text" class=form-control id="floatingInput" name="customer_id" placeholder="Enter Customer ID" value= "<?php echo "$number" ;?>" readonly>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Customer Name</label>
                  <input type="text" name="custname" class="form-control" placeholder="Enter Customer Name">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Foreigen Name</label>
                  <input type="text" name="forname" class="form-control" placeholder="Enter Foreigen Name">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Phone Number</label>
                  <input type="text" name="phonenumber" class="form-control" placeholder="Enter Phone Number">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="email" class="form-control" placeholder="Enter Email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Authorized Name</label>
                  <input type="text" name="authorizedname" class="form-control" placeholder="Enter Authorized Name">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Phone Authorized</label>
                  <input type="text" name="phoneauthorized" class="form-control" placeholder="Enter Phone Authorized">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Service Name</label>
                  <select class="form-control" name="service_id" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Open This Select Proplem Stutes</option>
                        <?php
                          $records = mysqli_query($con, "SELECT * From services_tbl");  // Use select query here 
                          while($data = mysqli_fetch_array($records))
                          {
                          ?>
                          <option value="<?php echo $data['service_name'];?>"><?php echo $data['service_name'];?></option>  
                          <?php
                          } 
                        ?>
                        
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Warranty Period</label>
                  <input type="text" name="warranty_period" class="form-control" placeholder="Enter Warranty Period">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Date Of Contract</label>
                  <input type="date" name="dateofcontract" class="form-control" placeholder="Enter Date Of Contract">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Active Date</label>
                  <input type="date" name="active_date" class="form-control" placeholder="Enter Active Date">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Servers</label>
                  <input type="text" name="servers" class="form-control" placeholder="Enter Servers Number">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Subsidiary Devices</label>
                  <input type="text" name="subsidiary_devices" class="form-control" placeholder="Enter Subsidiary Devices Number">
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="">Agent Name</label>
                <input type="text" name="empname" class="form-control" value="<?php echo $_SESSION['auth_user']['empname'];?>" readonly>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="create_customer" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Create Customer</h1>
            </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Customer</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php
             include('message.php');
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registere User</h3>
                <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add Customer</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>CustomerName</th>
                    <th>PhoneNumber</th>
                    <th>Email</th>
                    <th>AuthorizedName</th>
                    <th>PhoneAuthorized</th>
                    <th>DateOfContract</th>
                    <th>ServiceName</th>
                    <th>ActiveDate</th>
                    <th>WarrantyPeriod</th>
                    <th>ServersNumber</th>
                    <th>Subsidiary Devices</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM customer_tb";
                    $sql_run = mysqli_query($con, $sql);
                    if(mysqli_num_rows($sql_run ) > 0)
                    {
                      foreach($sql_run as $items)
                      {
                        // echo $items['email'];
                        ?>
                        <tr>
                          <td><?= $items['customer_id'];?></td>
                          <td><?= $items['custname'];?></td>
                          <td><?= $items['phonenumber'];?></td>
                          <td><?= $items['email'];?></td>
                          <td><?= $items['authorizedname'];?></td>
                          <td><?= $items['phoneauthorized'];?></td>
                          <td><?= $items['dateofcontract'];?></td>
                          <td><?= $items['service_id'];?></td>
                          <td><?= $items['active_date'];?></td>
                          <td><?= $items['warranty_period'];?></td>
                          <td><?= $items['servers'];?></td>
                          <td><?= $items['subsidiary_devices'];?></td>
                          <td>
                            <a href="crproplem.php?customer_id=<?= $items['customer_id'];?>" class="btn btn-primary btn-sm">Creat Proplem</a>
                            <a href="cust_edit.php?customer_id=<?= $items['customer_id'];?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">View</a>
                          </td>
                          
                        </tr>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                        <tr>
                          <td>Not Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>



<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>