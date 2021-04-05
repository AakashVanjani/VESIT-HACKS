<?php

// THIS PAGE IS TO ADD A NEW committee(MANAGE committee THROUGH FORM IN GENERAL)

require('header.inc.php');

$comm_name='';
$msg = '';
$abbrv = '';
$comm_category = $_GET['comm'];  # har ek committee ki indivdiual parameter jayega.
#echo $comm_category;


// this is, when I have told to edit the already present dept.
// when editing, id milti hai thru get & then u gotta fill up that id in form(which will be edited later)
if ( isset($_GET['id']) && $_GET['id']!='' ){
   $id = get_safe_value($con, $_GET['id']);
   $sql = "select * from committee where com_id='$id'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count>0){
      $row = mysqli_fetch_assoc($res);
      $comm_name = $row['com_name'];
      $abbrv = $row['abbrv'];
   }
   else{
      // for redirecting.
      if ($comm_category == 'department'){
         header('location:dept_commi.php');
      }
      
      elseif ($comm_category == 'institute'){
         header('location:inst_commi.php');
      }
      else{
         header('location:stud_body.php');
      }
      die();
   }

}




// to check if the new value you're entering is already there in DB or not.
if (isset($_POST['submit'])){
   $comm_name = get_safe_value($con, $_POST['comm_name']);
   $abbrv = get_safe_value($con, $_POST['abbrv']);


   # check if the entered category already exists in the db
   $res = mysqli_query($con, "select * from committee where com_name='$comm_name'");
   $count=mysqli_num_rows($res);
   if ($count>0){       # means already exists
      if (isset($_GET['id']) && $_GET['id'] != ''){
         # agar editing hai, toh check (editing id==input me category ki id)
         $row = mysqli_fetch_assoc($res);
         $input_id = $row['com_id'];
         if ($id == $input_id){
            // then it's ok, can edit
         }

         else{
            // the input_id is already in db, toh kese  
            $msg = 'Department already exists';
         }
      }
      else{
         // get request nai hai toh post request hoga, aur usme toh repeatation ka chance hi nhi
         $msg = 'Department already exists';
         
      }
   }

   if ($msg == ''){    #2 cases -> wo already db me nai hai or inputid==id, that can also be put.

      if (isset($_GET['id']) && $_GET['id']!=''){
         $sql = "update committee set com_name='$comm_name',abbrv='$abbrv' where id='$id'";      
      }
      else{
         $sql = "insert into committee(com_name,abbrv, com_category) values('$comm_name','$abbrv', '$comm_category')";   
      }
      mysqli_query($con, $sql);
      // for redirecting.
      if ($comm_category == 'department'){
         $page= 'dept_commi.php';
      }
      
      elseif ($comm_category == 'institute'){
         $page= 'inst_commi.php';
      }
      else{
         $page = 'stud_body.php';
      }
      header('location:'.$page);
      die();
   }
}


?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong> Committee Form</strong></div>
                        <form method= "post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="company" class=" form-control-label">Committee</label>
                            <input type="text" name="comm_name" value = "<?php echo $comm_name ?>" placeholder="Enter Committee" class="form-control" required>
                            </div>
                            <div class="form-group"><label for="company" class=" form-control-label">Abbreviation</label>
                            <input type="text" name="abbrv" value = "<?php echo $abbrv ?>" placeholder="Enter Abbreviation" class="form-control" required>
                            </div>
                            <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>


<?php
require('footer.inc.php');
?>