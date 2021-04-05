<?php

// THIS PAGE IS TO ADD A NEW CATEGORY(MANAGE CATEGORIES THROUGH FORM IN GENERAL)

require('header.inc.php');

/* blank values deneka reason -->
$categoy ki value url se sirf tab milegi jab hum submit pe click karege, but I awant to always display value of $category
in the input box of form of this page; isliye by default '' value daaldega */
$dept_name='';
$msg = '';
$abbrv = '';

// this is, when I have told to edit the already present dept.
// when editing, id milti hai thru get & then u gotta fill up that id in form(which will be edited later)
if ( isset($_GET['id']) && $_GET['id']!='' ){
   $id = get_safe_value($con, $_GET['id']);
   $sql = "select * from department where id='$id'";
   $res = mysqli_query($con, $sql);
   #$category = $row['category'];       #then fill this category in the form(which is written below.)
   #sirf upar ki 5 lines(include 4th commented one)likha toh kaam chal jata,but then url me id change krke temper krneki danger se bachne ke liye
   # we have to check if that id is actually present or not, if not, redirect to categories.php -->
   $count = mysqli_num_rows($res);
   if ($count>0){
      $row = mysqli_fetch_assoc($res);
      $dept_name = $row['name'];
      $abbrv = $row['abbrv'];
   }
   else{
      header('location:departments.php');
      die();
   }

}



// to check if the new value you're entering is already there in DB or not.
if (isset($_POST['submit'])){
   $dept = get_safe_value($con, $_POST['dept_name']);
   $abbrv = get_safe_value($con, $_POST['abbrv']);


   # check if the entered category already exists in the db
   $res = mysqli_query($con, "select * from department where name='$dept'");
   $count=mysqli_num_rows($res);
   if ($count>0){       # means already exists
      if (isset($_GET['id']) && $_GET['id'] != ''){
         # agar editing hai, toh check (editing id==input me category ki id)
         $row = mysqli_fetch_assoc($res);
         $input_id = $row['id'];
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
         $sql = "update department set name='$dept',abbrv='$abbrv' where id='$id'";      
      }
      else{
         $sql = "insert into department(name, abbrv) values('$dept', '$abbrv')";   
      }
      mysqli_query($con, $sql);
      header('location:departments.php');
      die();
   }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong> Departments Form</strong></div>
                        <form method= "post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="company" class=" form-control-label">Department</label>
                            <input type="text" name="dept_name" value = "<?php echo $dept_name ?>" placeholder="Enter Department" class="form-control" required>
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