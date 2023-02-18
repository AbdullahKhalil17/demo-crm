<?php
ob_start();
session_start();
    $page_title ="Edit Proplem";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');

    if(isset($_POST['updateproplem']))
    {
      $numbercase_id = mysqli_real_escape_string($con, $_POST['numbercase_id']);
      $proplemdescraption = mysqli_real_escape_string($con, $_POST['proplemdescraption']);
      $customername = mysqli_real_escape_string($con, $_POST['customername']);
      $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
      $authorizedname = mysqli_real_escape_string($con, $_POST['authorizedname']);
      $phoneauthrized = mysqli_real_escape_string($con, $_POST['phoneauthrized']);
      $proplemstutes = mysqli_real_escape_string($con, $_POST['proplemstutes']);
      $stutesdescraption = mysqli_real_escape_string($con, $_POST['stutesdescraption']);
      $query = "UPDATE customerproplem_tb SET proplemdescraption = '".$proplemdescraption."', customername = '".$customername."', phonenumber = '".$phonenumber."',
      authorizedname = '".$authorizedname."', phoneauthrized = '".$phoneauthrized."', proplemstutes = '".$proplemstutes."', stutesdescraption = '".$stutesdescraption."'  WHERE  numbercase_id ='".$numbercase_id."'";
       $query_run = mysqli_query($con, $query);
       if($query_run)
       {
          $_SESSION['status'] = "Proplem Updated Successflly";
          header("Location: cr_proplem.php");
          exit(0);
       }
       else
       {
        $_SESSION['status'] = "Proplem Updating Failed";
          header("Location: cr_proplem.php");
          exit(0);
       }
    }
?>
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CRM SYSTEM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit - Proplem</li>
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
                            <h3 class="card-tittle">Edit - Proplem</h3>
                            <a href="cr_customer.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-12">
                                      <form action="pro_edit.php" method="post">
                                          <div class="modal-body">
                                              <?php
                                                if(isset($_GET['numbercase_id']))
                                                {
                                                  $numbercase_id = $_GET['numbercase_id'];
                                                  $query = "SELECT * FROM customerproplem_tb WHERE numbercase_id ='$numbercase_id' LIMIT 1 ";
                                                  $query_run = mysqli_query($con, $query);
                                                  if(mysqli_num_rows($query_run) > 0)
                                                  {
                                                    foreach($query_run as $row)
                                                    {
                                                      ?>
                                                        <input type="hidden" name = "numbercase_id" value = "<?php echo $row['numbercase_id'] ;?>">
                                                        <div class="form-group">
                                                          <label for="floatingInput">Number Case</label>
                                                          <input type="text" class=form-control id="floatingInput" name="numbercase_id" placeholder="Enter Customer ID" value= "<?php echo $row['numbercase_id'] ;?>" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="floatingInput">Proplem Descraption</label>
                                                          <input type="text" class=form-control id="floatingInput" name="proplemdescraption" placeholder="Enter Customer ID" value= "<?php echo $row['proplemdescraption'] ;?>">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="floatingInput">Customer Name</label>
                                                          <input type="text" class=form-control id="floatingInput" name="customername" placeholder="Enter Customer ID" value= "<?php echo $row['customername'] ;?>" readonly>
                                                        </div>

                                        

                                                        
                                                        <div class="form-group">
                                                          <label for="">Phone Number</label>
                                                          <input type="text" name="phonenumber" value= "<?php echo $row['phonenumber'] ;?>" class="form-control" placeholder="Enter Phone Number" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="">Authorized Name</label>
                                                          <input type="text" name="authorizedname" value= "<?php echo $row['authorizedname'] ;?>" class="form-control" placeholder="Enter Authorized Name" readonly>
                                                        </div>




                                                        <div class="form-group">
                                                          <label for="">Phone Authorized</label>
                                                          <input type="text" name="phoneauthrized" value="<?php echo $row['phoneauthrized'] ;?>" class="form-control" placeholder="Enter Phone Authorized" readonly>
                                                        </div>






                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Proplem Stutes</label>
                                                                    <select class="form-control" name="proplemstutes" id="floatingSelect" value= "<?php echo $row['proplemstutes']; ?>" aria-label="Floating label select example">
                                                                        <option selected>Open This Select Proplem Stutes</option>
                                                                        <option value="جديد">جديد</option>
                                                                        <option value="تحت الفحص">تحت الفحص</option>
                                                                        <option value="تم الانتهاء">تم الانتهاء</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="form-group">
                                                          <label for="">Stutes Descraption</label>
                                                          <input type="text" name="stutesdescraption" value= "<?php echo $row['stutesdescraption'] ;?>" class="form-control" placeholder="Enter stutesdescraption">
                                                        </div>
                                                     
                                                        <div class="modal-footer">
                                                          <button type="submit" name="updateproplem" class="btn btn-info">Update</button>
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