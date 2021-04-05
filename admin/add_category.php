<?php

// THIS PAGE IS TO ADD A NEW CATEGORY(MANAGE CATEGORIES THROUGH FORM IN GENERAL)

require('header.inc.php');
$category='';
$msg = '';

// when editing, id milti hai thru get & then u gotta fill up that id in form(which will be edited later)
if ( isset($_GET['id']) && $_GET['id']!='' ){
   $id = get_safe_value($con, $_GET['id']);
   $sql = "select * from categories where id='$id'";
   $res = mysqli_query($con, $sql);
   #$category = $row['category'];       #then fill this category in the form(which is written below.)
   #sirf upar ki 5 lines(include 4th commented one)likha toh kaam chal jata,but then url me id change krke temper krneki danger se bachne ke liye
   # we have to check if that id is actually present or not, if not, redirect to categories.php -->
   $count = mysqli_num_rows($res);
   if ($count>0){
      $row = mysqli_fetch_assoc($res);
      $category = $row['category'];
   }
   else{
      header('location:categories.php');
      die();
   }

}

if (isset($_POST['submit'])){
   $cat = get_safe_value($con, $_POST['category']);

   # check if the entered category already exists in the db
   $res = mysqli_query($con, "select * from categories where category='$cat'");
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
            $msg = 'Category already exists';
         }
      }
      else{
         // get request nai hai toh post request hoga, aur usme toh repeatation ka chance hi nhi
         $msg = 'Category already exists';

      }

   }

   if ($msg == ''){    #2 cases -> wo already db me nai hai or inputid==id, that can also be put.

      if (isset($_GET['id']) && $_GET['id']!=''){
         $sql = "update categories set category='$cat' where id='$id'";      
      }
      else{f
         $sql = "insert into categories(category,status) values('$cat', '1')";   
      }
      mysqli_query($con, $sql);
      header('location:categories.php');
      die();
   }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong> Categories </strong><small> Form</small></div>
                        <form method= "post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="company" class=" form-control-label">Categories</label>
                            <input type="text" name="category" value = "<?php echo $category ?>" placeholder="Enter Category" class="form-control" required>
                            </div>
                            <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-am0ount">Submit</span>
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