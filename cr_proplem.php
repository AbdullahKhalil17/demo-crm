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
    $customername = mysqli_real_escape_string($con, $_POST['custname']);
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





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- User Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Proplem</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
            </button>
        </div>
        <form  action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
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
                  <input type="text" name="customername" class="form-control" placeholder="Enter Customer Name" required>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Phone Number</label>
                  <input type="text" name="phonenumber" class="form-control" placeholder="Enter Phone Number" required>
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
                  <input type="text" name="authorizedname" class="form-control" placeholder="Enter Authorized Name" required>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Phone Authorized</label>
                  <input type="text" name="phoneauthrized" class="form-control" placeholder="Enter Phone Authorized" required>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="create_proplem" class="btn btn-primary">Submit</button>
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
            <h1 class="m-0">Check Proplrm</h1>
            </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Check Proplem</li>
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
                <h3 class="card-title">Check Proplem</h3>
                <a href="#" data-toggle="#" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add New Proplem</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Number Case</th>
                    <th>Proplem Descraption</th>
                    <th>Customer Name</th>
                    <th>Authorized Name</th>
                    <th>Phone Authrized</th>
                    <th>Proplem Stutes</th>
                    <th>stutesdescraption</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM customerproplem_tb";
                    $sql_run = mysqli_query($con, $sql);
                    if(mysqli_num_rows($sql_run ) > 0)
                    {
                      foreach($sql_run as $items)
                      {
                        // echo $items['email'];
                        ?>
                        <tr>
                          <td><?= $items['numbercase_id'];?></td>
                          <td><?= $items['proplemdescraption'];?></td>
                          <td><?= $items['custname'];?></td>
                          <td><?= $items['authorizedname'];?></td>
                          <td><?= $items['phoneauthrized'];?></td>
                          <td><?= $items['proplemstutes'];?></td>
                          <td><?= $items['stutesdescraption'];?></td>
                         
                          <td>
                            <a href="pro_edit.php?numbercase_id=<?= $items['numbercase_id'];?>" class="btn btn-success btn-sm">Edit</a>
                            <!-- <a href="cust_edit.php?customer_id=<?= $items['customer_id'];?>" class="btn btn-success btn-sm">Edit</a> -->
                            <a href="" class="btn btn-danger btn-sm">Delet</a>
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