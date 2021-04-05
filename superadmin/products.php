<?php
require('header.inc.php');

// this is admin-side products page !!

$sql = " select products.*,categories.category from products,categories where products.category_id=categories.id order by products.id desc";

$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);


if(isset($_GET['type']) && $_GET['type']!=''){
   $type = mysqli_real_escape_string($con, $_GET['type']);
   if ($type=='status'){
      $operation = mysqli_real_escape_string($con, $_GET['operation']);
      $id = mysqli_real_escape_string($con, $_GET['id']);

      if ($operation=='active'){
         $status='1';
      }
      else{
         $status='0';
      }
      $status_sql = "update products set status='$status' where id='$id'";
      mysqli_query($con, $status_sql);
   }

   if ($type=='delete'){
      $id = mysqli_real_escape_string($con, $_GET['id']);
      $delete_sql = "delete from products where id='$id'";
      mysqli_query($con, $delete_sql);
   }


}
?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Products</h4>
                           <h4 class="box-link"><a href='manage_product.php'> Add Products </a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Category</th>
                                       <th>Name</th>
                                       <th>Image</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Qty</th>
                                       <th><th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                        $ser = 1;
                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<tr>";
                                            echo "<td class='serial'>" . $ser . "</td>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['category'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>"; ?>
                                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" /></td>
                                            <?php
                                            echo "<td>" . $row['mrp'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>";
                                            if ($row['status']==1){
                                             echo "<a href='?type=status&operation=deactive&id=" .$row['id']. "'>Active</a>&nbsp&nbsp&nbsp"; 
                                         }
                                         else{
                                             echo "<a href='?type=status&operation=active&id=" .$row['id']. "'>Deactive</a>&nbsp&nbsp&nbsp"; 
                                     }
                                     echo "<a href='manage_product.php?type=edit&id=" .$row['id']. "'>Edit</a>&nbsp&nbsp&nbsp";
                                     echo "<a href='?type=delete&id=" .$row['id']. "'>Delete</a>&nbsp";
                                     echo "</td>";
                                     
                                        echo "</tr>";
                                        }
                                    ?>

                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

<?php
require('footer.inc.php');
?>