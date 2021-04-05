<?php

// to add new members from the admin page.

// yahape wo sirf apni council wale ko hi add kar sakta, make changes.


require('header.inc.php');

// yahape yeh sabki zarurat nahi hai, kyuki sirf add krna hai,prefilled data nai hai kuch.
$comm_id='';
$design='';
$stud_name='';
$dept='';
$dept_design='';

$msg = '';


   # image is treated separately


if (isset($_POST['submit'])){
   $comm_id = get_safe_value($con, $_POST['comm_id']);
   $design = get_safe_value($con, $_POST['design']);
   $stud_name = get_safe_value($con, $_POST['stud_name']);
   $dept = get_safe_value($con, $_POST['dept']);
   $dept_design = get_safe_value($con, $_POST['dept_design']);


   # check if the entered student already exists in the db
   $check_sql = "select * from users where name='$stud_name', dept='$dept',design='$design'";
   $res = mysqli_query($con, "select * from users where name='$stud_name', dept='$dept',design='$design'");
   #print_r($res);
   #$count=mysqli_num_rows($res);
   if ($res){                                  # means already exists
            $msg = 'Member already exists';
         }




   if ($msg == ''){

         # student toh mere pass already hai, bas usko non-member se member banana hai.
         # edit : users ke saare bacche already members hain.
         
         # below steps are to get committee name from committee id.
         $get_comm_sql = "select * from committee where com_id = '$comm_id'";
         $res2 = mysqli_query($con, $get_comm_sql);
         $row = mysqli_fetch_assoc($res2);
         $new_member_comm =$row['abbrv'];
         
         $sql = "insert into users(name,dept,dept_design, committee,design) 
               values('$stud_name','$dept','$dept_design' , '$new_member_comm','$design')";

         # if design is secretary, toh admin wale me b daldo.
         if ($design == 'secretary'){
            $username = $stud_name . '.' . 'admin' . '.' . $new_member_comm;
            echo $username;
            mysqli_query($con, "insert into admin(name,council_name,designation, username,password) 
            values('$stud_name','$new_member_comm','$design' , '$username','vesit')");
         }
      }

   mysqli_query($con, $sql);
   // redirect to another page - using JS - when php doen't work.
   /*echo '<script>';
   echo 'window.location.href="showpeople.php?type=show"';
   echo '</script>';*/
   
}

?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong> Add a new Member Form</strong></div>
                        <form method= "post">
                        <div class="card-body card-block">
                        <div class="form-group"><label for="categories" class=" form-control-label">Name</label>
                            <input type="text" name="stud_name" placeholder="Enter name " class="form-control" required>
                           </div>

                           <div class="form-group"><label for="categories" class=" form-control-label">Department</label>
                            <input type="text" name="dept" placeholder="Enter department" class="form-control" required>
                           </div>

                           <div class="form-group"><label for="categories" class=" form-control-label">Department Designation</label>
                            <input type="text" name="dept_design" placeholder="Enter dept designation" class="form-control" required>
                           </div>

                            <div class="form-group"><label for="company" class=" form-control-label">Select a Committee</label>
                            <select class="form-control" name="comm_id">
                              <option> select committee </option>
                              <?php
                              
                                 $add_sql = "select distinct com_id,com_name,abbrv from committee order by com_name asc";
                                 $res=mysqli_query($con, $add_sql);
                                 while ($row=mysqli_fetch_assoc($res)){

                                       echo "<option value=".$row['com_id'] . ">" . $row['com_name'] . "</option>";
                                 }
                              ?>
                           </select>
                           </div>

                           <div class="form-group"><label for="categories" class=" form-control-label">Designation</label>
                            <input type="text" name="design" placeholder="Enter Designation" class="form-control" required>
                           </div>


                            <div class="form-group"><label for="categories" class=" form-control-label" <?php ?> >Image</label>
                            <input type="file" name="image" class="form-control">
                            </div>


                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
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