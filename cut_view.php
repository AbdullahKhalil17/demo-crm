<?php
ob_start();
session_start();
$page_title ="View Proplem";
include('includes/header.php'); 
include('includes/navbar.php'); 
include('dbcon.php'); 
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>View Proplem Details
                        <a href="index.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['custmoer_id']))
                    {
                        $customer_tb_custmoer_id = mysqli_real_escape_string($con, $_GET['custmoer_id']);
                        $sql = "SELECT * FROM customer_tb WHERE custmoer_id ='$customer_tb_custmoer_id' ";
                        $sql_run = mysqli_query($con, $sql);
                        if(mysqli_num_rows($sql_run) > 0)
                        {
                            $customer_tb = mysqli_fetch_array($sql_run);
                            ?>
                            <!-- <?php include('message.php'); ?> -->
                            <!-- <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> -->
                            <div class="mb-3">
                                <label>Customer ID</label>
                                <p class="form-control">
                                <?=$customer_tb['custmoer_id']; ?>
                                </p>
                            </div>
                 
                            <div class="mb-3">
                                    <a href="pro_edit.php?numbercase_id=<?=$customerproplem_tb['numbercase_id']; ?>" class="btn btn-success float-start">Go to Page Edit Proplem</a>
                                    <!-- <a href="proplem-edit.php?numbercase_id=<?=$customerproplem_tb['numbercase_id']; ?>" class="btn btn-success float-end">Go to Page Edit Proplem</a> -->
                            </div>
                        <!-- </form> -->
                            <?php
                        }
                        else
                        {
                            echo "<h4>No Such Number Id Case Found</h4>";
                        }
                    }
                    ?>
                        
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/script.php'); ?>
<?php include('includes/foater.php'); ?>