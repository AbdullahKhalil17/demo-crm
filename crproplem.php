<?php
ob_start();
session_start();
    $page_title ="Data Proplem";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');
?>
<?php
if($_SERVER["REQUEST_METHOD"] == 'POST')
{
  $numbercase_id = mysqli_real_escape_string($con, $_POST['numbercase_id']);
    $proplemdescraption = mysqli_real_escape_string($con, $_POST['proplemdescraption']);
    $custname = mysqli_real_escape_string($con, $_POST['custname']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
    $phoneauthrized = mysqli_real_escape_string($con, $_POST['phoneauthrized']);
    $proplemstutes = mysqli_real_escape_string($con, $_POST['proplemstutes']);
    $stutesdescraption = mysqli_real_escape_string($con, $_POST['stutesdescraption']);
  if(!$con)
  {
    die("connection failed" .mysqli_connect_error());
  }
  else
  {
    $sql = "INSERT INTO customerproplem_tb (numbercase_id, proplemdescraption, custname, phonenumber, authorizedname, phoneauthrized, proplemstutes, stutesdescraption)
    VALUES ('".$numbercase_id."', '".$proplemdescraption."', '".$custname."', '".$phonenumber."', '".$authorizedname."', '".$phoneauthrized."', '".$proplemstutes."', '".$stutesdescraption."')";
    if(mysqli_query($con, $sql))
    {
        $_SESSION['status'] = "Create Proplem Successfully...! Please Check Proplem Data";
        header("Location: cr_proplem.php");
        exit(0);
    }
    $query = "SELECT numbercase_id from customerproplem_tb order by numbercase_id desc";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['numbercase_id'];

    if(empty($lastid))
    {
      $number = "PR-00001";
    }
    else
    {
      $idd = str_replace("PR-","",$lastid);
      $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
      $number = 'PR-'.$id;
    }
  }
}
$query = "SELECT numbercase_id from customerproplem_tb order by numbercase_id desc";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['numbercase_id'];

if(empty($lastid))
{
  $number = "PR-00001";
}
else
{
  $idd = str_replace("PR-","",$lastid);
  $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
  $number = 'PR-'.$id;
}
?>

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
                            <h3 class="card-tittle">Create Proplem
                            </h3>
                            <a href="cr_customer.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-12">
                                      <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
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
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="floatingInput">Number Case ID</label>
                                                                    <input type="text" class=form-control id="floatingInput" name="numbercase_id" placeholder="Enter Customer ID" value= "<?php echo $number ;?>" readonly>
                                                                </div>
                                                                                                        
                                                                <div class="form-group">
                                                                    <label for="floatingInput">Proplem Descrption</label>
                                                                    <input type="text" class=form-control id="floatingInput" name="proplemdescraption" placeholder="Enter Proplem Descraption" required>
                                                                </div>
                                                                                                        
                                                                                                        
                                                                                                        
                                                                <div class="row">
                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label for="">Customer Name</label>
                                                                      <input type="text" name="custname" class="form-control" value="<?php echo $row['custname'] ;?>" placeholder="Enter Customer Name" required>
                                                                  </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label for="">Phone Number</label>
                                                                      <input type="text" name="phonenumber" value="<?php echo $row['phonenumber'] ;?>" class="form-control" placeholder="Enter Phone Number" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                                                        
                                                                                                        
                                                                <!-- 
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
                                                                </div> -->
                                                                                                        
                                                                                                        
                                                                                                        
                                                                <div class="row">
                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label for="">Authorized Name</label>
                                                                      <input type="text" name="authorizedname" value="<?php echo $row['authorizedname'] ;?>" class="form-control" placeholder="Enter Authorized Name" required>
                                                                  </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label for="">Phone Authorized</label>
                                                                      <input type="text" name="phoneauthrized" value="<?php echo $row['phoneauthorized'] ;?>" class="form-control" placeholder="Enter Phone Authorized" required>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                                                        
                                                                <div class="row">
                                                                  <div class="col-md-6">
                                                                    <div class="form-group">
                                                                      <label for="">Service Name</label>
                                                                        <select class="form-control" name="proplemstutes" id="floatingSelect" aria-label="Floating label select example">
                                                                            <option selected>Open This Select Proplem Stutes</option>
                                                                            <option value="جديد">جديد</option>
                                                                            <option value="تحت الفحص">تحت الفحص</option>
                                                                            <option value="تم الانتهاء">تم الانتهاء</option>
                                                                        </select>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                                                        
                                                                                                        
                                                                <div class="form-group">
                                                                    <label for="floatingInput">Stutes Descrption</label>
                                                                    <input type="text" class=form-control id="floatingInput" name="stutesdescraption" placeholder="Enter Proplem Descraption" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="submit" name="create_proplem" class="btn btn-primary">Submit</button>
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