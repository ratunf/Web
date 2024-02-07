<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_POST['submit']))
    {
        // Handle form submission untuk menyimpan perubahan pada user
        $userid=intval($_GET['id']);
        $fname=$_POST['fullname'];
        $email=$_POST['email'];
        $contactno=$_POST['contactno'];
        $dob=$_POST['dob'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $country=$_POST['country'];
        
        $sql="update tblusers set FullName=:fname, EmailId=:email, ContactNo=:contactno, dob=:dob, Address=:address, City=:city, Country=:country where id=:userid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
        $query->bindParam(':dob',$dob,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':city',$city,PDO::PARAM_STR);
        $query->bindParam(':country',$country,PDO::PARAM_STR);
        $query->bindParam(':userid',$userid,PDO::PARAM_STR);
        $query->execute();
        $msg="User data updated successfully";
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Bike Rental Portal | Admin Edit User</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>

</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Edit User</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Edit User Details</div>
                            <div class="panel-body">
                                <?php
                                    $userid=intval($_GET['id']);
                                    $sql = "SELECT * from  tblusers where id=:userid";
                                    $query = $dbh -> prepare($sql);
                                    $query -> bindParam(':userid', $userid, PDO::PARAM_STR);
                                    $query -> execute();
                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if($query -> rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        {
                                ?>

                                <form method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="fullname" class="form-control" value="<?php echo htmlentities($result->FullName);?>" required>
                                        </div>
                                        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="email" name="email" class="form-control" value="<?php echo htmlentities($result->EmailId);?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Contact No<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contactno" class="form-control" value="<?php echo htmlentities($result->ContactNo);?>" required>
                                        </div>
                                        <label class="col-sm-2 control-label">DOB<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="date" name="dob" class="form-control" value="<?php echo htmlentities($result->dob);?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" name="address" required><?php echo htmlentities($result->Address);?></textarea>
                                        </div>
                                        <label class="col-sm-2 control-label">City<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="city" class="form-control" value="<?php echo htmlentities($result->City);?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Country<span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="country" class="form-control" value="<?php echo htmlentities($result->Country);?>" required>
                                        </div>
                                    </div>

                                    <div class="hr-dashed"></div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                                        </div>
                                    </div>

                                </form>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php } ?>
