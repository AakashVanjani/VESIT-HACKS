<?php

// THIS PAGE IS TO ADD A NEW PRODUCT(MANAGE PRODUCTS THROUGH ADMIN IN GENERAL)

require('header.inc.php');

# why are these empty values taken ??
$category_id='';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image='';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$best_seller = '';

$msg = '';
$image_required='';

// when editing, id milti hai thru get & then u gotta fill up that id in form(which will be edited later)
if ( isset($_GET['id']) && $_GET['id']!='' ){
   $image_required='';
   $id = get_safe_value($con, $_GET['id']);
   $sql = "select * from products where id='$id'";
   $res = mysqli_query($con, $sql);
   #$category = $row['category'];       #then fill this category in the form(which is written below.)
   #sirf upar ki 5 lines(include 4th commented one)likha toh kaam chal jata,but then url me id change krke temper krneki danger se bachne ke liye
   # we have to check if that product(which we wanna update) is actually present or not, if not, redirect to products.php -->
   $count = mysqli_num_rows($res);
   if ($count>0){
      $row = mysqli_fetch_assoc($res);
      $category_id = $row['category_id'];
      $name = $row['name'];
      $mrp = $row['mrp'];
      $price = $row['price'];
      $qty = $row['quantity'];
      $short_desc = $row['short_desc'];
      $description = $row['description'];
      $meta_title = $row['meta_title'];
      $meta_desc = $row['meta_desc'];
      $meta_keyword = $row['meta_keyword'];
      $best_seller = $row['best_seller'];
      
   }
   else{
      header('location:products.php');
      die();
   }

}

if (isset($_POST['submit'])){
   $category_id = get_safe_value($con, $_POST['category_id']);
   $name = get_safe_value($con, $_POST['name']);
   $mrp = get_safe_value($con, $_POST['mrp']);
   $price = get_safe_value($con, $_POST['price']);
   $qty = get_safe_value($con, $_POST['qty']);
   $short_desc = get_safe_value($con, $_POST['short_desc']);
   $description = get_safe_value($con, $_POST['description']);
   $meta_title = get_safe_value($con, $_POST['meta_title']);
   $meta_desc = get_safe_value($con, $_POST['meta_desc']);
   $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
   $best_seller =  get_safe_value($con, $_POST['best_seller']);

   # image is treated separately

   # check if the entered product already exists in the db
   $res = mysqli_query($con, "select * from products where name='$name'");
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
            $msg = 'Product already exists';
         }
      }
      else{
         // get request nai hai toh post request hoga, aur usme toh repeatation ka chance hi nhi
         $msg = 'Product already exists';

      }

   }

   # format of image should be jpg/jpeg/png.
   if ($_FILES['image']['type']!='' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' 
         && $_FILES['image']['type']!='image/png'){
         $msg = "Images of type jpg/jpeg/png/ are allowed !!";
   }


   if ($msg == ''){    #2 cases -> wo already db me nai hai or inputid==id, that can also be put.
      if (isset($_GET['id']) && $_GET['id']!=''){
      
         if ($_FILES['image']['name'] != ''){   # agar new img daali gayi hai, toh update krege
            $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);
            $sql = "update products set category_id='$category_id',name='$name',mrp='$mrp',price='$price',quantity='$qty',short_desc='$short_desc',
            description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller' 
            where id='$id'";
         }
         else{
            $sql = "update products set category_id='$category_id',name='$name',mrp='$mrp',price='$price',quantity='$qty',short_desc='$short_desc',
            description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller' where id='$id'";      
         }
      }
      else{

         # FOR IMAGE !!!
         $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
         move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);

         $sql = "insert into products(category_id,name, mrp,price,quantity,short_desc,description,meta_title,meta_desc,meta_keyword,status,image, best_seller) 
         values('$category_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1', '$image','$best_seller')"; 
      }
      $res = mysqli_query($con, $sql);
      header('location:products.php');
      die();
   }
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong> Products </strong><small> Form</small></div>
                        <form method= "post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="company" class=" form-control-label">Categories</label>
                            <select class="form-control" name="category_id">
                              <option> select category </option>
                              <?php
                                 $res=mysqli_query($con, "select id,category from categories order by category asc");
                                 while ($row=mysqli_fetch_assoc($res)){
                                    if ($row['id'] == $category_id){
                                       echo "<option selected value=".$row['id'] . ">" . $row['category'] . "</option>";
                                    }
                                    else{

                                    }
                                    echo "<option value=".$row['id'] . ">" . $row['category'] . "</option>";
                                 }
                              ?>
                           </select>
                           </div>
                            
                           <div class="form-group"><label for="company" class=" form-control-label">Best Seller</label>
                            <select class="form-control" name="best_seller">
                              <option value=''> select </option>
                              <?php 
                                 if ($best_seller=='1'){
                                    echo "<option value='1' selected> Yes </option>
                                    <option value='0'> No </option>";
                                 }
                                 elseif ($best_seller=='0'){
                                    echo "<option value='1'> Yes </option>
                                    <option value='0' selected> No </option>";
                                 }
                                 else{
                                    echo "<option value='1'> Yes </option>
                                    <option value='0'> No </option>";
                                 }
                                 


                              ?>
                              
                           </select>
                           </div>
                            
                            <div class="form-group"><label for="categories" class=" form-control-label">Product Name</label>
                            <input type="text" name="name" value = "<?php echo $name ?>" placeholder="Enter product Name" class="form-control" required>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">MRP</label>
                            <input type="text" name="mrp" value = "<?php echo $mrp ?>" placeholder="Enter product mrp" class="form-control" required>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Price</label>
                            <input type="text" name="price" value = "<?php echo $price ?>" placeholder="Enter product price" class="form-control" required>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Quantity</label>
                            <input type="text" name="qty" value = "<?php echo $qty ?>" placeholder="Enter product Quantity" class="form-control" required>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label" <?php echo $image_required ?> >Image</label>
                            <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Short Description</label>
                            <textarea name="short_desc" placeholder="Enter product short description" class="form-control"><?php echo $short_desc ?></textarea>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Description</label>
                            <textarea name="description" placeholder="Enter product Description" class="form-control"><?php echo $description ?></textarea>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Meta title</label>
                            <textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title ?></textarea>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Meta Description</label>
                            <textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_desc ?></textarea>
                            </div>

                            <div class="form-group"><label for="categories" class=" form-control-label">Meta Keyword</label>
                            <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword ?></textarea>
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