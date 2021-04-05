<?php
require('header.inc.php');


$type= '';
$abbrv = '';


// this is admin-side departments page !!
// yahape login wali condition nai likhi hai, kyuki header.php me likhi hai.

$ser=0;


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
      $status_sql = "update users set status='$status' where id='$id'";
      mysqli_query($con, $status_sql);
   }

$res='';

   // iske liye ek popup / alagse google sheet chahiye.
   if ($type=='show'){
      $abbrv = mysqli_real_escape_string($con, $_GET['abbrv']);
      $select_sql = "select * from users where committee='$abbrv'";
      $res = mysqli_query($con, $select_sql);      
   }


}


?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Departments </h4>
                           <h4 class="box-link"><a href='manage_dept.php'> Add a Department </a> </h4>
                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Department</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <?php
                                    if ($res){
                                        while ($row = mysqli_fetch_array($res)){
                                          $ser=$ser+1;
                                            echo "<tr>";
                                            echo "<td>" . $ser . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>";
                                            
                                            
                                            if ($row['status']==1){
                                             echo "<a href='?type=status&operation=deactive&id=" .$row['id']. "'>Admin</a>&nbsp&nbsp&nbsp"; 
                                         }
                                         else{
                                             echo "<a href='?type=status&operation=active&id=" .$row['id']. "'>Make Admin</a>&nbsp&nbsp&nbsp"; 
                                     }
                                            echo "<a href='manage_dept.php?type=edit&id=" .$row['id']. "'>Edit</a>&nbsp&nbsp&nbsp";
                                            echo "<a href='?type=delete&id=" .$row['id']. "'>Delete</a>&nbsp";
                                            echo "</td>";
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