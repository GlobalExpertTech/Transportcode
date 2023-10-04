<?php 
include'header/header.php';
include'sidebars/sidebar.php';
if(isset($_GET['id']))
{

   $id="";
   $empnamee="";
   $presentday="";
   $perday="";
   $total="";
   $month="";

 $id=$_GET['id'];
   $array= (explode("_",$id));

   $id=$array[0];
   $empnamee=$array[1];
   $presentday=$array[2];
   $perday=$array[3];
   $total=$array[4];
   $month=$array[5];

}

if (isset($_POST['btnpaid'])) 
{

$paydate=$_POST['datee'];


   $sql = "INSERT INTO `tbl_payment`(`paydate`, `empid`, `empname`, `presentdays`, `totalpayment`) VALUES ('$paydate','$id','$empnamee','$presentday','$total')";
   echo $sql;

if (mysqli_query($connect, $sql)) 
{
 echo '<script>alert("status Updated ")</script>';
 echo '<script>window.location="payment.php"</script>';
} 
else 
{
  echo '<script>alert("Error to Update")</script>';
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}



?>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
               <div class="card">
                    <!--  <div class="buttons">
                   <a href="#" class="btn btn-icon icon-left btn-primary"style="float:right"data-toggle="modal" data-target="#exampleModal1"><i class="far fa-edit"></i>Add Employee</a>
                 </div> -->
                 <br>
                <center> <h4>Update Payment status <?php echo  $empnamee; ?></h4></center>
                <form method="POST"> 
                  <div class="container">
                     <div class="form-group">
                      <h5>Date : <?php  echo  $month; ?></h5>
                     
                    </div>
                    <div class="form-group">
                      <h5>Employe Name</h5>
                      <input type="text" class="form-control" value="<?php echo $empnamee; ?>" readonly="">
                      <input type="hidden" name="datee"  value="<?php echo $month; ?>">
                      <input type="hidden" name="empid"  value="<?php echo $id; ?>">
                    </div>
                   
                    <div class="row">
                      <div class="col">
                         <div class="form-group">
                      <h5>Per Day </h5>
                      <input type="text" class="form-control" name="perday" value="<?php echo $perday; ?>">
                    </div>
                      </div>
                      <div class="col">
                         <div class="form-group">
                      <h5>Present</h5>
                      <input type="text" class="form-control" name="presentday" value="<?php echo $presentday; ?>">
                    </div>
                      </div>
                      <div class="col">
                         <div class="form-group">
                      <h5>Total</h5>
                      <input type="text" class="form-control" name="total" value="<?php echo $total; ?>">
                    </div>
                      </div>
                    </div>
                   <button class="btn btn-primary col-3 mb-5" name="btnpaid" type="submit" >Paid Payment</button>
                                      
                  </div>
                </form>        
                </div>
              </div>
            </div>
          </div>
        </section>
              <div class="modal fade" id="exampleModal16" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Details</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
               <div id="myEvent"></div>
             
                </div>
              </div>
            </div>
          </div>
        </div>
      <script type="text/javascript">
$(document).ready(function(){

     //  alert('hii');
      //hiding data 
    

 //     $('#filterbtn').click(function(){

 //       var monthpay=$('#inpmonth').val();
       
 //        if(monthpay!="")
 //        {
 //        //  alert('monthpay is '+monthpay);


 // $.ajax({

 //      url:'getdata.php',
 //      method:'POST',
 //      // date:$('#searchdateform').serialize(),
 //      data:'paymentmonth='+monthpay,
 //      success:function(responcedata) 
 //      {
 //        $('#tableExport').show();
 //        $('#responce').html(responcedata);
 //         // $('#button_action').show();
 //      },

 //  });

 //        }else
 //        {
 //          alert('Please Select Month');
 //        }
   
 //       });


   
  });



      </script>
  <?php include'footers/footer.php'?>