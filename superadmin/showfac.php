<?php
require('header.inc.php');


// it is showing members of dept level committees only.
// it should show for other committees also. -> DONE.



$ser=0;



# showpeople wale page me ek important chiz --> jo b log admin me hai, unka status 1 hona chahiye.
# compare krte time, sabka lowercase hi lelo. ex : $person_name = strtolower()
# the above thing is bit complex, easy -> users ke sabhi log jina design sec/head, usko 1 banado.

$sql1 = "update users set status='1' where design='faculty head' or design='secretary'";
$res1 = mysqli_query($con, $sql1);



if(isset($_GET['type']) && $_GET['type']!=''){
   $type = mysqli_real_escape_string($con, $_GET['type']);

   if ($type=='status'){


         # status me, agar mene kisiko admin banaya, toh wo jayega admin table me, nai toh remove ho jayega.

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




// order by status kia, so that head comes at TOP
   $count=0;
   // iske liye ek popup / alagse google sheet chahiye.
   if ($type=='show'){
      $abbrv = mysqli_real_escape_string($con, $_GET['abbrv']);
      $select_sql = "select * from users where dept='$abbrv' and dept_design='faculty'";
      $res = mysqli_query($con, $select_sql);
      $count = mysqli_num_rows($res);    
   }


}


?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Faculty Members </h4>
                           <h4 class="box-link"><a href='add_faculty.php?dept=<?php echo $abbrv ?>'> Add a Faculty Member </a> </h4>
                           <!-- comm=department  -->
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Designation</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <?php
                                    if ($count>0){
                                        while ($row = mysqli_fetch_array($res)){
                                          $ser=$ser+1;
                                            echo "<tr>";
                                            echo "<td>" . $ser . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['dept_design'] . "</td>";
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