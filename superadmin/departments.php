<?php
require('header.inc.php');

// this is admin-side departments page !!
// yahape login wali condition nai likhi hai, kyuki header.php me likhi hai.

$ser=0;

$sql = " select * from department order by id asc";
$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);

if(isset($_GET['type']) && $_GET['type']!=''){
   $type = mysqli_real_escape_string($con, $_GET['type']);

   if ($type=='delete'){
      $id = mysqli_real_escape_string($con, $_GET['id']);
      $delete_sql = "delete from department where id='$id'";
      mysqli_query($con, $delete_sql);
   }


   /* iske liye ek popup / alagse google sheet chahiye.
   if ($type=='show'){
      $abbrv = mysqli_real_escape_string($con, $_GET['abbrv']);
      $select_sql = "select * from users where dept='$abbrv'";
      $res = mysqli_query($con, $select_sql);


      while ($row=mysqli_fetch_assoc($res)){
         echo $row['name'];
      }      
   }*/


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
                                            
                                            echo "<a href='showfac.php?type=show&abbrv=" .$row['abbrv']. "'>Faculties</a>&nbsp&nbsp&nbsp";
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