<!DOCTYPE html>
<html>
<head>
  <title>TMWS WATER BILLING SYSTEM</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<style>
  @media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
}
</style>
<body>
<center><input class="btn btn-primary" type="button" onclick="window.print()" value="Print page" />
<a class="btn btn-primary" href="cbilling.php">Back</a></center><hr>
<?php 
session_start();
if(!isset($_SESSION['username'])){
  echo '<script>windows: location="index.php"</script>';
  
  }
?>
<?php
include 'db.php';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$result = mysqli_query($con, "SELECT * FROM commercial_bill where id='$id'");
$row = mysqli_fetch_array($result);
  {
    $account_id=$row['account_id'];
    $prev=$row['prev'];
    $pres=$row['pres'];
    $date=$row['date'];
    $first=$row['first_rate'];
    $second=$row['second_rate'];
    $third=$row['third_rate'];
    $default=$row['default_amount'];
    $status=$row['status'];
    $totalcons=$pres - $prev;
    $setcons=10;
    $dcons=0;
    $fcons = 0;
    $scons = 0;
    $tcons = 0;
    $famount = $fcons * $first;
    $samount = $scons * $second;
    $tamount = $tcons * $third;
    //Formula for the bill amount
    if ($totalcons <= 10) {
      $bill = $default;
    }
    else if ($totalcons <= 20) {
      $bill = ($totalcons - 10) * ($first) + $default;
    }
    else if ($totalcons <= 30) {
      $bill = ($setcons) * ($first) + ($totalcons - 20) * ($second) + $default;
    }
    else if ($totalcons > 30) {
      $bill = ($setcons) * ($first) + ($setcons) * ($second) + ($totalcons - 30) * ($third) + $default;
    }
    //Return a two decimal format for the bill amount
    $billformat = number_format($bill, 2, '.', '');
 
  }
  //Formula for Cu.m.
    if ($totalcons <= 10) {
        $dcons = $totalcons;
        $fcons = 0;
        $scons = 0;
        $tcons = 0;
    }
    else if ($totalcons <= 20) {
        $dcons = 10;
        $fcons = $totalcons - 10;
        $scons = 0;
        $tcons = 0;
        $famount = ($totalcons - 10) * ($first);
    }
    else if ($totalcons <= 30) {
    $dcons = 10;
    $fcons = 10;
    $scons = $totalcons - 20;
    $tcons = 0;
    $famount = (10) * ($first);
    $samount = ($totalcons - 20) * ($second);
    }
    else if ($totalcons > 30) {
    $dcons = 10;
    $fcons = 10;
    $scons = 10;
    $tcons = $totalcons - 30;
    $famount = (10) * ($first);
    $samount = (10) * ($second);
    $tamount = ($totalcons - 30) * ($third);
    }

    $famountformat = number_format($famount, 2, '.', '');
    $samountformat = number_format($samount, 2, '.', '');
    $tamountformat = number_format($tamount, 2, '.', '');


?>
<?php
include 'db.php';
$result = mysqli_query($con, "SELECT * FROM commercial_owners WHERE id  = '$account_id'");
$test = mysqli_fetch_array($result);
if (!$result) 
    {
    die("Error: Data not found..");
    }
        $id=$test['id'];
        $account =$test['account'];       
        $barangay =$test['address'];
        $meterno =$test['mi'];

?>
<?php
$session = $_SESSION['username'];
include 'db.php';
$result = mysqli_query($con, "SELECT * FROM user where username= '$session'");
while($row = mysqli_fetch_array($result))
  {
  $sessionname = $row['username'];
  }
?>
<div style="position: absolute;">
<img src="img/talakaglogo.png" height="80" width="80" draggable="false">
</div>
<div>
<p style="margin: 0px 250px; font-family: tahoma; font-size: 11px;">Republic of the Philippines</p>
<p style="margin: 0px 251px; font-family: tahoma; font-size: 11px;">PROVINCE OF BUKIDNON</p>
<p style="margin: 0px 259px; font-family: tahoma; font-size: 11px;">Municipality of Talakag</p>
<p style="margin: 0px 214px; font-family: tahoma; font-weight: bold; font-size: 11px;">TALAKAG MUNICIPAL WATER SYSTEM</p>
<br>
<p style="margin: 0px 248px; font-family: tahoma; font-weight: bold; font-size: 11px;">STATEMENT OF ACCOUNT</p>
</div>
<div>    

<p style="margin: 0px; font-size: 11px; float: left; margin-right: 310px;"><?php echo $account; ?></p> 
<p style="font-size: 11px; align-self: right; margin-bottom: 0px;
margin-top: 0px;">Reading Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date; ?></p> 

<p style="margin: 0px; font-size: 11px; float: left; margin-right: 233px;"><?php echo $barangay; ?>, Talakag, Bukidnon</p>
<p style="font-size: 11px; align-self: right; margin-bottom: 15px;
margin-top: 0px;">Due Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="duedate" id="duedate" value="" placeholder="ex. 17-Oct-17" style="width: 117px; border: none;"></p> 

<p style="margin: 0px; font-size: 11px;">Meter No: <?php echo $meterno; ?></p>
<p style="margin: 0px; font-size: 11px; margin-bottom: 15px;">Billing as of  <input type="text" name="billmonth" id="billmonth" value="" placeholder="Input Month" style="width: 75px; border: none; margin-left: 5px;">
 <input type="text" name="billyear" id="billyear" value="" placeholder="Input Year" style="width: 50px; border: none;"></p>

<p style="margin: 0px; font-size: 11px; float: left; margin-right: 90px;">Previous Reading</p>
<p style="font-size: 11px; float: left; margin-right: 90px;">Present Reading</p> 
<p style="font-size: 11px; float: left; margin-right: 103px;">Cu.m.</p> 
<p style="font-size: 11px;">Total Amount</p> 
<div style="float: left; width: 50px; margin-right: 115px; height: 10px;">
<p style="margin: 0px; font-size: 11px; float: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $prev; ?></p>
</div>

<div style="float: left; width: 60px; margin-right: 100px; height: 10px;">
<p style="margin: 0px; font-size: 11px; float: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $pres; ?></p>
</div>

<div style="float: left; width: 60px; margin-right: 98px; height: 10px;">
<p style="margin: 0px; font-size: 11px; float: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $totalcons; ?></p>
</div>

<div style="float: left; width: 70px; height: 10px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $billformat; ?></p>
</div>

<div style="width: 20px; margin-left: 360px; margin-right: 0px; height: 10px;">
<p style="margin: 0px; font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $dcons; ?></p>
</div>

<div style="width: 20px; margin-left: 515px; height: 10px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $default; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 360px; height: 10px; margin-top: 4px; margin-bottom: 4px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $fcons; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 50px; height: 10px; margin-top: 4px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $first; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 65px; height: 10px; margin-top: 4px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $famountformat; ?></p>
</div>

<div style="width: 20px; margin-left: 360px; height: 10px; margin-top: 4px; margin-bottom: 4px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $scons; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 430px; height: 10px; margin-top: 0px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $second; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 65px; height: 10px; margin-top: 0px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $samountformat; ?></p>
</div>

<div style="width: 20px; margin-left: 360px; height: 10px; margin-top: 0px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $tcons; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 430px; height: 10px; margin-top: 0px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $third; ?></p>
</div>

<div style="float: left; width: 20px; margin-left: 65px; height: 10px; margin-top: 0px; margin-bottom: 0px;">
<p style="font-size: 11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $tamountformat; ?></p>
</div>

<div style="width: 20px; margin-left: 510px; height: 10px; margin-top: 24px;">
<p style="font-size: 11px;"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $billformat; ?></p>
</div>
<hr style="width: 70px; border-color: black; margin-left: 475px; margin-bottom: 0px; margin-top: 0px; padding-bottom: 0px;"></hr>
<br>
<br>
<hr>

</div>
</body>
</html>