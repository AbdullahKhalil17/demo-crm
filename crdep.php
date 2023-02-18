<?php
ob_start();
session_start();
    $page_title ="Add Department";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');
?>
<?php
  if($_SERVER["REQUEST_METHOD"] == 'POST')
  {
    $dep_id = mysqli_real_escape_string($con, $_POST['dep_id']);
    $depname = mysqli_real_escape_string($con, $_POST['depname']);
    $depnote = mysqli_real_escape_string($con, $_POST['depnote']);
    if(!$con)
    {
      die("connection failed" .mysqli_connect_error());
    }
    else
    {
      $sql = "INSERT INTO depart_tb(dep_id,depname, depnote) VALUES ('".$dep_id."','".$depname."', '".$depnote."')";
      if(mysqli_query($con, $sql))
      $query = "SELECT dep_id from depart_tb order by dep_id desc";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $lastid = $row['dep_id'];

      if(empty($lastid))
      {
        $number = "DE-00001";
      }
      else
      {
        $idd = str_replace("DE-","",$lastid);
        $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
        $number = 'DE-'.$id;
      }
    }
  }
  $query = "SELECT dep_id from depart_tb order by dep_id desc";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  $lastid = $row['dep_id'];

  if(empty($lastid))
  {
    $number = "DE-00001";
  }
  else
  {
    $idd = str_replace("DE-","",$lastid);
    $id = str_pad($idd +1, 5,0, STR_PAD_LEFT);
    $number = 'DE-'.$id;
  }







?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Depratment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Depratment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-tittle">Add Depratment
                            </h3>
                            <a href="index.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                      <div class="col-md-6">
                                      <form action="<?php echo($_SERVER["PHP_SELF"]) ?>" method="post">
                                          <div class="modal-body">
                                            <div class="form-group">
                                              <label for="floatingInput">Depratment ID</label>
                                              <input type="text" class=form-control id="floatingInput" name="dep_id" value="<?php echo $number?>"  readonly>
                                            </div>
                                            <div class="form-group">
                                              <label for="floatingInput">Depratment Name</label>
                                              <input type="text" class=form-control id="floatingInput" name="depname" placeholder="Enter Depratment Name"  required>
                                            </div>
                                            <div class="form-group">
                                              <label for="">Depratment Note</label>
                                              <input type="text" name="depnote"  class="form-control" placeholder="Enter Depratment Note" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" name="crdep" class="btn btn-info">Save Department</button>
                                            </div>
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