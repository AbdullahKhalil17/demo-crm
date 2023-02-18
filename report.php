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
// if(isset($_POST['create_customer']))
// {
//     $customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);
//     $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
//     $foreigen_name = mysqli_real_escape_string($con, $_POST['foreigen_name']);
//     $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
//     $phoneauthorized = mysqli_real_escape_string($con, $_POST['phoneauthorized']);
//     // $contractofsystem = mysqli_real_escape_string($con, $_POST['contractofsystem']);
//     // $service_id = mysqli_real_escape_string($con, $_POST['service_id']);
//     $dateofcontract = mysqli_real_escape_string($con, $_POST['dateofcontract']);
//     $active_date = mysqli_real_escape_string($con, $_POST['active_date']);
//     $warranty_period = mysqli_real_escape_string($con, $_POST['warranty_period']);
//     $service_id	= mysqli_real_escape_string($con, $_POST['service_id']);
//     $subsidiary_devices = mysqli_real_escape_string($con, $_POST['subsidiary_devices']);
//     // $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
// $sql = "INSERT INTO customer_tb(customer_id, customer_name, foreigen_name, phonenumber, email, authorizedname, phoneauthorized, dateofcontract, active_date, warranty_period, service_id, subsidiary_devices)
//     VALUES ('".$customer_id."', '".$customer_name."', '".$foreigen_name."', '".$phonenumber."', '".$email."', '".$authorizedname."', '".$phoneauthorized."',  '".$dateofcontract."','".$active_date."', '".$warranty_period."', '".$service_id."', '".$subsidiary_devices."')";
//     $sql_run = mysqli_query($con, $sql);
//       if($sql_run)
//       {
//           $_SESSION['message'] = "Customer Created Successflly";
//           header("Location: cr_customer.php");
      
//       }
//       else
//       {
//           $_SESSION['message'] = "Customer Not Created";
//           header("Location: cr_customer.php");
          
//       }
// }
// $query2 = "SELECT * FROM customer_tb order by customer_id desc limit 1";
// $result2 = mysqli_query($con,$query2);
// $row = mysqli_fetch_array($result2);
// $last_id = $row['customer_id'];
// if ($last_id == " ")
// {
//     $numbercase_id = "CU:";
// }
// else
// {
//     $customer_id = substr($last_id, 3);
//     $customer_id = intval($customer_id);
//     $customer_id = "CU:10" . ($customer_id + 1);
// }
?>

<?php
if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    $customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $foreigen_name = mysqli_real_escape_string($con, $_POST['foreigen_name']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
    $phoneauthorized = mysqli_real_escape_string($con, $_POST['phoneauthorized']);
    // $contractofsystem = mysqli_real_escape_string($con, $_POST['contractofsystem']);
    // $service_id = mysqli_real_escape_string($con, $_POST['service_id']);
    $dateofcontract = mysqli_real_escape_string($con, $_POST['dateofcontract']);
    $active_date = mysqli_real_escape_string($con, $_POST['active_date']);
    $warranty_period = mysqli_real_escape_string($con, $_POST['warranty_period']);
    $service_id	= mysqli_real_escape_string($con, $_POST['service_id']);
    $subsidiary_devices = mysqli_real_escape_string($con, $_POST['subsidiary_devices']);
    // $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
  if(!$con)
  {
    die("connection failed" .mysqli_connect_error());
  }
  else
  {
    $sql = "INSERT INTO customer_tb(customer_id, customer_name, foreigen_name, phonenumber, email, authorizedname, phoneauthorized, dateofcontract, active_date, warranty_period, service_id, subsidiary_devices)
    VALUES ('".$customer_id."', '".$customer_name."', '".$foreigen_name."', '".$phonenumber."', '".$email."', '".$authorizedname."', '".$phoneauthorized."',  '".$dateofcontract."','".$active_date."', '".$warranty_period."', '".$service_id."', '".$subsidiary_devices."')";
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
                  <input type="text" name="customer_name" class="form-control" placeholder="Enter Customer Name">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Foreigen Name</label>
                  <input type="text" name="foreigen_name" class="form-control" placeholder="Enter Foreigen Name">
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
                  <input type="text" name="service_id	" class="form-control" placeholder="Enter Service Name">
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
                  <input type="text" name="service_id" class="form-control" placeholder="Enter Servers Number">
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Subsidiary Devices</label>
                  <input type="text" name="subsidiary_devices" class="form-control" placeholder="Enter Subsidiary Devices Number">
                </div>
              </div>
            </div>
            <!-- <div class="form-group">
                <label for="">Agent Name</label>
                <input type="text" name="user_id" class="form-control" value="<?= $_SESSION['auth_user']['agentname'];?>" placeholder="Enter Subsidiary Devices Number">
            </div> -->
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
            <h1 class="m-0">Data Customer</h1>
            </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Customer</li>
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
                <h3 class="card-title">Data Customer</h3>
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
                          <td><?= $items['servers'];?></td>
                          <td><?= $items['subsidiary_devices'];?></td>
                          <td>
                            <a href="contract.php?customer_id=<?= $items['customer_id'];?>" class="btn btn-success btn-sm" target="_blank">Contract</a>
                            <a href="reportpdf.php?customer_id=<?= $items['customer_id'];?>" class="btn btn-danger btn-sm" target="_blank">Installation record</a>
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
<?php include('includes/foater.php'); ?>