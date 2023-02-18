<?php
ob_start();
session_start();
    $page_title ="Data User";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');


    if(isset($_POST['updatecustomer']))
    {
      $customer_id = mysqli_real_escape_string($con, $_POST['customer_id']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
      $phoneauthorized = mysqli_real_escape_string($con, $_POST['phoneauthorized']);
      $servers = mysqli_real_escape_string($con, $_POST['servers']);
      $subsidiary_devices = mysqli_real_escape_string($con, $_POST['subsidiary_devices']);
      $query = "UPDATE customer_tb SET email = '".$email."', authorizedname = '".$authorizedname."', phoneauthorized = '".$phoneauthorized."',
       servers = '".$servers."', subsidiary_devices = '".$subsidiary_devices."'  WHERE  customer_id ='".$customer_id."'";
       $query_run = mysqli_query($con, $query);
       if($query_run)
       {
          $_SESSION['status'] = "Customer Updated Successflly";
          header("Location: cr_customer.php");
          exit(0);
       }
       else
       {
        $_SESSION['status'] = "Customer Updating Failed";
          header("Location: cr_customer.php");
          exit(0);
       }
    }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <?php
                    if(isset($_SESSION['status']))
                    {
                      echo "<h4>".$_SESSION['status']."</h4>" ;
                      // unsent($_SESSION['status']);
                    }
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-tittle">Edit - Customer
                            </h3>
                            <a href="cr_customer.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                      <div class="col-md-6">
                                      <form action="cust_edit.php" method="post">
                                          <div class="modal-body">
                                              <?php
                                                if(isset($_GET['customer_id']))
                                                {
                                                  $customer_id = $_GET['customer_id'];
                                                  $query = "SELECT * FROM customer_tb WHERE customer_id ='$customer_id' LIMIT 1 ";
                                                  $query_run = mysqli_query($con, $query);
                                                  if(mysqli_num_rows($query_run) > 0)
                                                  {
                                                    foreach($query_run as $row)
                                                    {
                                                      ?>
                                                        <input type="hidden" name = "customer_id" value = "<?php echo $row['customer_id'] ;?>">
                                                        <div class="form-group">
                                                          <label for="floatingInput">Customer ID</label>
                                                          <input type="text" class=form-control id="floatingInput" name="customer_id" placeholder="Enter Customer ID" value= "<?php echo $row['customer_id'] ;?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Customer Name</label>
                                                          <input type="text" name="customer_name" value= "<?php echo $row['customer_name'] ;?>" class="form-control" placeholder="Enter Customer Name" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Phone Number</label>
                                                          <input type="text" name="phonenumber" value= "<?php echo $row['phonenumber'] ;?>" class="form-control" placeholder="Enter Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Email</label>
                                                          <input type="text" name="email" value= "<?php echo $row['email'] ;?>" class="form-control" placeholder="Enter Email" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Authorized Name</label>
                                                          <input type="text" name="authorizedname" value= "<?php echo $row['authorizedname'] ;?>" class="form-control" placeholder="Enter Authorized Name" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Phone Authorized</label>
                                                          <input type="text" name="phoneauthorized" value= "<?php echo $row['phoneauthorized'] ;?>" class="form-control" placeholder="Enter Phone Authorized" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Servers</label>
                                                          <input type="text" name="servers" value= "<?php echo $row['servers'] ;?>" class="form-control" placeholder="Enter Servers Number" >
                                                        </div><div class="form-group">
                                                          <label for="">Subsidiary Devices</label>
                                                          <input type="text" name="subsidiary_devices" value= "<?php echo $row['subsidiary_devices'] ;?>" class="form-control" placeholder="Enter Customer Name" >
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="submit" name="updatecustomer" class="btn btn-info">Update</button>
                                                        </div>
                                                      <?php
                                                    }
                                                  }
                                                  else
                                                  {
                                                    echo "<h4>No Record Found..!</h4>";
                                                  }
                                                }
                                              ?>
                                          </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include('includes/script.php'); ?>
<?php include('includes/foater.php'); ?>