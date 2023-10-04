<?php
include('header/header.php');
include('config.php');

$selectchllanquery = "SELECT * FROM `comapnymaster` where `id`='1'";
// echo $selectchllanquery;
$result = mysqli_query($con, $selectchllanquery);
$row = mysqli_fetch_assoc($result);

$rcname = $row['name'];
$rmobno = $row['mob'];
$remail = $row['email'];
$rpan = $row['pan'];
$rgstin = $row['gst'];
$rlogo = $row['logo'];
$raddress = $row['address'];
$rtandc = $row['tandc'];

if (isset($_POST['submitcomapny'])) {
  $cname = $_POST['cname'];
  $mobno = $_POST['mobno'];
  $email = $_POST['email'];
  $pan = $_POST['pan'];
  $gstin = $_POST['gstin'];
  $logo = $_POST['logo'];
  $address = $_POST['address'];
  $tandc = $_POST['tandc'];


  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["logo"]["name"]);
  $tempfile = $_FILES["logo"]["tmp_name"];
  // $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (move_uploaded_file($tempfile, $target_file)) {

    $query = "INSERT INTO `comapnymaster`(`name`, `mob`, `email`, `pan`, `gst`, `logo`, `address`, `tandc`)
  VALUES ('$cname','$mobno','$email','$pan','$gstin','$target_file','$address','$tandc')";

    mysqli_query($con, $query);
    // echo '<script>window.location.reload() </script>';

  } else {

    $query = "INSERT INTO `comapnymaster`(`name`, `mob`, `email`, `pan`, `gst`, `address`, `tandc`)
    VALUES ('$cname','$mobno','$email','$pan','$gstin','$address','$tandc')";
  
      mysqli_query($con, $query);
      // echo '<script> window.location.reload() </script>';

    //echo "Sorry, there was an error uploading your file.";
  }

}

if (isset($_POST['updatecomapny'])) {
  $cname = $_POST['cname'];
  $mobno = $_POST['mobno'];
  $email = $_POST['email'];
  $pan = $_POST['pan'];
  $gstin = $_POST['gstin'];
  $logo = $_POST['logo'];
  $address = $_POST['address'];
  $tandc = $_POST['tandc'];


  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["logo"]["name"]);
  $tempfile = $_FILES["logo"]["tmp_name"];
  // $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (move_uploaded_file($tempfile, $target_file)) {

    $query = "UPDATE `comapnymaster` SET `name`='$cname',`mob`='$mobno',`email`='$email',`pan`='$pan',`gst`='$gstin',`logo`='$target_file',`address`='$address',`tandc`='$tandc' WHERE `id`='1'";

    // echo $query;

    mysqli_query($con, $query);
    // echo '<script>    window.location.reload()    </script>';

  } else {
    $query = "UPDATE `comapnymaster` SET `name`='$cname',`mob`='$mobno',`email`='$email',`pan`='$pan',`gst`='$gstin',`address`='$address',`tandc`='$tandc' WHERE `id`='1'";

    // echo $query;

    mysqli_query($con, $query);
    // echo '<script>window.location.reload()</script>';

    //echo "Sorry, there was an error uploading your file.";
  }



}



?>


<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->


      <div class="row justify-content-center">
        <h3></h3>

      </div>

      <div class="card">
        <div class="card-header">
          <h4>Comapny Details</h4>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-6">
                <label>Company Name</label>
                <input type="text" name="cname" value="<?php echo $rcname; ?>" class="form-control">
              </div>

              <div class="form-group col-6">
                <label>Phone / Mobile No</label>
                <input type="text" name="mobno" value="<?php echo $rmobno; ?>" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $remail; ?>" class="form-control">
              </div>

              <div class="form-group col-6">
                <label>PAN</label>
                <input type="text" name="pan" value="<?php echo $rpan; ?>" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label>GSTIN</label>
                <input type="text" name="gstin" value="<?php echo $rgstin; ?>" class="form-control">
              </div>

              <div class="form-group col-6">
                <label>Logo</label>
                <input type="file" name="logo" id="logo" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label>Address</label>
                <textarea class="form-control" value="<?php echo $raddress; ?>" name="address"><?php echo $raddress; ?></textarea>
              </div>

              <div class="form-group col-6">
                <label>Terms & Condition</label>
                <textarea class="form-control" name="tandc"><?php echo $rtandc; ?></textarea>
              </div>
            </div>




            <div class="card-footer text-right">
              <?php if ($rcname == "") {
                echo '<button class="btn btn-primary mr-1" name="submitcomapny" type="submit">Submit</button>';
              } else {
                echo '<button class="btn btn-warning mr-1" name="updatecomapny" type="submit">Update company Details</button>';

              } ?>

              <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </div>
      </div>
      </form>

    </div>
  </section>
  <?php
  include('footers/footer.php');
  ?>