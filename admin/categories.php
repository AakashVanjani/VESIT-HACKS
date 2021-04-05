<?php
#require('connec.inc.php');     nhi kia toh b chalega kyuki header me kia hai yeh !
require('header.inc.php');

// this is admin-side categories page !!


$sql = " select * from categories order by id asc";
$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);
#if ($count>0){

#}

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
      $status_sql = "update categories set status='$status' where id='$id'";
      mysqli_query($con, $status_sql);
   }

   if ($type=='delete'){
      $id = mysqli_real_escape_string($con, $_GET['id']);
      $delete_sql = "delete from categories where id='$id'";
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
                           <h4 class="box-title">Categories </h4>
                           <h4 class="box-link"><a href='manage_category.php'> Add Categories </a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Category</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if ($res){
                                        $ser = 1;
                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<tr>";
                                            echo "<td class='serial'>" . $ser . "</td>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['category'] . "</td>";
                                            echo "<td>";
                                            if ($row['status']==1){
                                                echo "<a href='?type=status&operation=deactive&id=" .$row['id']. "'>Active</a>&nbsp&nbsp&nbsp"; 
                                            }
                                            else{
                                                echo "<a href='?type=status&operation=active&id=" .$row['id']. "'>Deactive</a>&nbsp&nbsp&nbsp"; 
                                        }
                                        echo "<a href='manage_category.php?type=edit&id=" .$row['id']. "'>Edit</a>&nbsp&nbsp&nbsp";
                                        echo "<a href='?type=delete&id=" .$row['id']. "'>Delete</a>&nbsp";
                                        echo "</td>";
                                        echo "</tr>";
                                        }
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