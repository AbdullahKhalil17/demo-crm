<?php
include('config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            direction: rtl;
            margin-right: 30px;
            margin-left: 30px;
            font-weight: bold;
        }
        p,span{
            font-size: 20px;
        }

        h1 {
            text-align: center;

        }

        h2,
        .head-1 {
            text-decoration: underline;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }
        .flex-1 {
            display: flex;
            justify-content: space-around;
        }

        h3 {
            text-align: center;
            color: black;
            background-color: gray;
            height: 40px;
            box-sizing: border-box;
            padding-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            empty-cells: show;
        }

        table th{
            background-color: black;
            color: white;
            height: 50px;

        }
        table td{
            width:20%;
            height: 60px;
        }


        table,
        th,
        td {
            border: 1px solid;
        }

        .one td {
            width: 50%;
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
                <h1> بسم الله الرحمن الرحيم
        <br> عقد حق انتفاع تطبيقات باور سوفت <br>
        <div class="head-1">
            مع حفظ حق الملكية الفكرية والمالية للطرف الأول
        </div>
    </h1>
    <h2>عقد حق انتفاع بالنظام المحاسبي</h2>
    <p>انه في يوم الموافق / / </p>
    <p>تحرر هذا العقد بين كلاً من: </p>
    <h2>أولاً: شركة باورسوفت</h2>
    <p>العنوان: 32 الدقي الرئيسي – الجيزة</p>
    <p>هاتف: </p>
    <div class="flex">
        <span>ويمثلها في هذا التعاقد السيد / محمد إبراهيم</span>
        <span>بصفته / مسؤول المبيعات </span>
        <span>(طرف أول)</span>
    </div>
    <h2>ثانياً: </h2>
    <p>العنوان: </p>
    <p>هاتف: </p>
    <div class="flex">
        <span>ويمثلها في هذا التعاقد السيد /  <?php echo $row['custname']?></span>
        <span>بصفته / المدير العام </span>
        <span>(طرف ثان)</span>
    </div>
    <h3>التمهيد</h3>
    <p>لما كان للطرف الأول من الشركات البارزة في مجال تكنولوجيا المعلومات وكذلك هو المخترع والمصمم للعديد من البرامج
        ومنها برنامج (<?php echo $row['service_id']?>) والخاص بإدارة المنشأت التجارية والصناعية، ولما كان للطرف الثاني الرغبة في الاستفادة من بعض
        برامج الطرف الأول، فقد تلاقت إرادة الطرفين بعد أن أقرا بأهليتهما للتصرف والتعاقد على ما يلي:</p>
    <h3>البند الأول:</h3>
    <p>التمهيد السابق جزء من الأجزاء الأساسية في هذا العقد ومكمل ومفسر له.</p>
    <h3>البند الثاني:</h3>
    <p>منح الطرف الأول إلي الطرف الثاني القابل لذلك ما هو حق استخدام عدد تصريح للمستخدمين على النظام المحاسبي داخل
        منشأته المذكورة أعلاه.</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h3>البند الثالث:</h3>
    <p>بموجب هذا العقد منح الطرف الأول إلى الطرف الثاني حق انتفاع الاتي: رخصة استخدام الأنظمة الآتية:</p>
    <table class="one">
        <thead>
            <tr>
                <th colspan="3">رخصة استخدام الأنظمة المحاسبية والإدارية الأتية
                    من NOON LITE ERPالمبني علي قواعد بيانات SQL
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>تصريح استخدام نظام إدارة الحسابات العامة الخاص بنون لايت</td>
                <td rowspan="4"></td>
            </tr>
            <tr>
                <td>تصريح استخدام نظام إدارة المخزون الخاص بنون لايت</td>
                <!-- <td></td> -->
            </tr>
            <tr>
                <td>تصريح استخدام نظام إدارة المشتريات والموردين الخاص بنون لايت</td>
                <!-- <td></td> -->
            </tr>
            <tr>
                <td>تصريح استخدام نظام إدارة المبيعات والعملاء الخاص بنون لايت</td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>
    <h3>البند الرابع:</h3>
    <p>- يلتزم الطرف الثاني بدفع مبلغ وقدرة فقط جنية مصري ( ). </p>
    <div>
        <span> شامل قيمة تصاريح الأنظمة </span>
        <span style="color: red; text-decoration: underline;"> وغير شامل ضريبة القيمة المضافة. </span>
    </div>
    <p>- هذا السعر يشمل على عدد تصاريح للمستخدمين من البرنامج ( ).</p>
    <span style="color: red; text-decoration: underline;">- تصريح الجهاز الإضافي L.E 2500</span>
    <h2>- شروط السداد:</h2>
    <table>
        <thead>
            <tr>
                <th>الدفعات</th>
                <th>المبلغ</th>
                <th>البنك</th>
                <th>رقم الشيك</th>
                <th>تاريخ الاستحقاق</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2"></td>
               
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td colspan="2"></td>
                
                <td></td>
            </tr>
            <tr>
                <td ></td>
                <td></td>
                <td colspan="2"></td>
               
                <td></td>
            </tr>

        </tbody>

    </table>
    <h3>الخامس</h3>
    <h2>■التزامات الطرف الأول: -</h2>
    <p>I. التدريب والتطبيق فى مكان مجهز بمقر الطرف الثانى و بتوفير متدربين متفرغين للتدريب على النظام.</p>
    <p>II. تقديم الإستشارات الفنية من خلال كل وسائل التواصل المتاحة خلال أوقات العمل الرسمية.</p>
    <p>III. الدعم الفنى والتحديثات :</p>
    <p>• يقوم الطرف الأول بتوفير دعم فنى مجانا ً للنظام لمدة سنة ميلادية تبدأ من تاريخ التشغيل النظام لدى الطرف الثاني .
    </p>
    <p>IV. يلتزم الطرف الأول بإنزال أية تحديثات جديدة على نفس الإصدارات التي يصدرها خلال فترة الدعم الفني مجاناً.</p>
    <p>V. يضمن الطرف الأول صلاحية الأنظمة والبرامج والخدمات موضوع التعاقد للغرض المعدة له وجودتها وكفاءتها لذلك.</p>
    <br> <br><br><br><br><br><br><br><br><br>
    <h3>البند السادس:</h3>
    <span style="text-decoration: underline;">■التزامات الطرف الثاني: - </span>
    <span>(وافق الطرف الثاني على الالتزامات التالية)</span>
    <p>I. الالتزام بسداد قيمة تصاريح الأنظمة والبرامج والخدمات التابعة لها بحسب ما هو موضح في البند الرابع.</p>
    <p>II. طلبات الدعم الفني عبر قسم خدمة العملاء للطرف الثاني Support@power-soft.co.</p>
    <p>III. أخذ نسخ احتياطية بصورة دورية لقاعدة البيانات لاسترجاعها في حالة عطل الأجهزة أو الشبكة.</p>
    <p>IV. توفير متطلبات عمل الأنظمة من أجهزة ومعدات وبرامج وشبكات وإرسال خطاب رسمي بالجاهزية.</p>
    <h3>البند السابع:</h3>
    <p>
        - اتفق الطرفان أن الأنظمة الموفرة بموجب هذا العقد هي أنظمة جاهزة ولا يقتضي هذا العقد إجراء أية إضافات أو
        استحداثات
        إلا إذا وافق عليها الطرف الأول وبمذكرة رسيمة، على ألا تكون طلبات الطرف الثاني مخالفة للمعاير المحاسبية أو
        القوانين
        المصرية.
    </p>
    <p>- الإضافات والإستحداثات المستجدة لتطوير ورفع كفاءة البرامج والخدمات والأنظمة موضوع التعاقد والموافقة للمعايير
        المحاسبية والقوانيين المصرية يتم إمداد الطرف الثاني بها حال طلبها بالقيمة الواجبة لذلك.</p>

    <h3>البند الثامن:</h3>
    <p>يلتزم الطرف الأول بضمان البرنامج محل التعاقد ضد أي عيوب برمجية للنظام .
        يلتزم الطرف الأول بتوفير خدمات الدعم الفني مجانا لمدة عام كامل على أن تبدأ مدة سريان هذه الخدمات من تاريخ
        التعاقد.
    </p>
    <h3>البند التاسع:</h3>
    <p>من المتفق عليه بين الطرفين أن الحقوق الفكرية والمالية تكون من حق الطرف الأول أو من يمثله وأن هذا العقد لا ينقل
        ملكية البرنامج إلى الطرف الثاني, وإنما يتمثل حق الطرف الثاني في إستخدام النظام داخل منشآته فقط والتعديلات
        اللاحقة عليه مملوكة لشركة الطرف الأول ومن يمثله وتتمتع في شأنها بجميع حقوق الملكية الفكرية كما تتمتع بالحماية
        القانونية باعتباره مالكا لها, ولا يجوز للطرف الثاني إطلاع أي جهة أخرى على تصميم النظام ومستنداته بأي حال من
        الأحوال لتسهيل نسخة أو توزيعها وإذا حدث شيء من هذا فيعتبر الطرف الثاني هو المسئول أمام الطرف الأول ويحق للطرف
        الأول متابعة الطرف الثاني قانونياً وطلب تعويض مالي يحدده الطرف الأول قدره ويعتبر ذلك بمثابة تعويض اتفاقي غير
        خاضع لرقابة القضاء ويستحق دون حاجة إلى تنبيه أو إنذار أو صدور حكم من القضاء.</p>
    <p>في حالة رغبة الطرف الثاني في عمل أي تعديلات محل التعاقد سواء بالإضافة أو الحذف أو التعديل يكون ذلك بمقابل بشرط أن
        تتوافق تلك الطلبات مع المعايير المحاسبية المتعارف عليها.</p>
    <h3>البند الحادي عشر:</h3>
    <p>في حالة حدوث خلاف لا قدر الله في فهم وتفسير أو تنفيذ أي بند من بنود هذا التعاقد فان الجهة المنوطة بالفصل فيه هي
        محاكم القاهرة الكبرى.</p>
    <div class="flex-1">
        <span>الطرف الأول </span>
        <span>الطرف الثاني</span>
    </div>
    <br>
    <div class="flex-1">
        <span>الاسم :------------------- </span>
        <span> الاسم : ------------------ </span>
    </div>
            <?php
        }
    }
}
?>


</body>

</html>