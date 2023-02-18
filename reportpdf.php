<?php
$page_title ="Invoice";
include('authentication.php');
include('includes/header.php');
// include('includes/topbar.php');
// include('includes/sidebar.php');
include('config/dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="all.min.css"> -->
    <link rel="stylesheet" href="fontawesome-free-6.2.1-web/css/all.min.css">
    <style>
        * {

            text-align: end;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 15px;
            margin: 0 auto;



        }

        table {
            width: 80%;
            /* margin: 100px auto; */
            border: 3px solid black;
            border-top: 1px solid black;


        }

        .table-1 td {
            width: 50%;
            height: 50px;
            padding-top: 8px;
            border-top: 3px solid black;
            float: right;

        }

        .table-2 td {
            width: 50%;
            height: 50px;
            border: 3px solid black;
            background-color: bisque;

        }

        .table-3 td {
            width: 50%;
            height: 50px;

        }

        table th {
            background-color: rgb(7, 129, 94);
            color: white;
            padding: 10px;
        }

        .circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 1px solid black;
            /* margin-bottom: 18px; */
            position: absolute;
            right: 376px;
            bottom: -137px;
            /* z-index: 1; */
        }

        .circle::before {
            content: " ختم العميل ";
            position: absolute;
            top: -24px;
            left: 32px;
            color: black;
        }



        img {
            width: 381px;
            height: 100px;
            display: flex;
            justify-items: flex-start;
            position: relative;
            right: 277px;
        }

        h3 {
            text-decoration: underline;
            position: relative;
            top: 90px;
            right: 118px;
            margin-bottom: 5px;
        }


        .footer {
            /* font-size: 30px !important; */
            font-weight: bold;
            width: 80%;
            height: 200px;
            /* background-color: bisque; */
            position: relative;
            margin-top: 50px;

        }

        .fa-phone {
            transform: translate(-137px, 36px);
        }

        .phone {
            position: absolute;
            left: 50%;
            top: -40px;
            font-size: 1.3rem !important;
            font-weight: bold !important;

        }

        .house {
            position: absolute;
            left: 0;
            font-size: 1.3rem !important;
            font-weight: bold !important;

        }

        .secand {
            position: absolute;
            left: 0;
            top: 80px;
            font-size: 1.3rem;
            font-weight: bold;
        }

        i {
            font-size: 25px;
            font-weight: bold;
        }
    </style>


</head>

<body>
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
                <h3>محضر تركيب نظام عميل</h3>
    <img src="WhatsApp Image 2022-12-26 at 3.28.13 PM.jpeg" alt="">
    <table class="table-1">
        <!-- <caption>محضر تركيب نظام عميل</caption> -->
        <thead>
            <tr>
                <th colspan="2"> بيانات العميل </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?php echo $row['custname'] ;?> :اسم العميل </td>
                <td> ...................... :نشاط العميل </td>
            </tr>
            <tr>
                <td> <?php echo $row['phonenumber'] ;?> :التليفون </td>
                <td> .................... : الفاكس </td>
            </tr>
            <tr>
                <td colspan="2"> ...................................................... : العنوان التفصيلى </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2">............................................................... : ملاحظات
                    التركيب </td>
                <td></td>

            </tr>

        </tbody>
        <table class="table-2">
            <thead>
                <tr>
                    <th> بيانات المسئول المتعاقدعلى النظام </th>
                    <th> بيانات المسئول عن استلام النظام </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $row['authorizedname'] ;?>  : المسئول العام </td>
                    <td> <?php echo $row['authorizedname'] ;?>  : المسئول عن استلام النظام </td>
                </tr>
                <tr>
                    <td> ...................:الوظيفة </td>
                    <td> ...................:الوظيفة </td>

                </tr>
                <tr>
                    <td> ...................:رقم الموبايل </td>
                    <td> ...................:رقم الموبايل </td>

                </tr>
                <td> ...................: البريد الالكترونى </td>
                <td> <?php echo $row['authorizedname'] ;?> :مدير النظام </td>
                <tr>

                </tr>
            </tbody>
        </table>
        <table class="table-3">
            <thead>
                <th> قسم الدعم الفنى : تملئ عن طريق مسئول الدعم الفنى </th>
                <th> : البرامج و الاجهزة المتعاقد عليها </th>

            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $row['emp_id'] ;?>: الشخص المسئول عن التركيب </td>
                    <td> <?php echo $row['service_id'] ;?>: اسم البرنامج </td>

                </tr>
                <tr>
                    <td> <?php echo $row['active_date'] ;?>: تاريج التركيب</td>
                    <td> <?php echo $row['servers'] ;?>: عدد النسخ </td>

                </tr>
                <tr>

                    <td> : التوقيع </td>
                    <td> عدد الاجهزة الطرفية (<?php echo $row['subsidiary_devices'] ;?>)server عددال</td>
                <tr>
                    <td> </td>
                    <td> : التوقيع </td>

                </tr>
                </tr>
            </tbody>
        </table>

    </table>
    <span class="circle"></span>


    <div class="footer">
        <div class="first">
            <div class="house">
                <i class="fa-solid fa-house"><span>32 DOKKI ST,LEVEL4 </span></i>
            </div>
            <div class="phone">
                <i class="fa-solid fa-phone"></i>
                <div>+20(02)33380809 </div>
                <div>+20(02)33350509 </div>
            </div>
        </div>
        <div class="secand">
            <i class="fa-brands fa-telegram"><span>info@power-soft.co</span></i>

        </div>

    </div>
            <?php
        }
    }
}
?>
    


</body>

</html>