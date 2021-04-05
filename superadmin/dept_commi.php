<?php
#require('connec.inc.php');     nhi kia toh b chalega kyuki header me kia hai yeh !
require('header.inc.php');

// this is admin-side department-committees page !!


$ser=0;

// (START) DISPLAY COMMITTEE
$sql = " select * from committee where com_category='department'";
$res = mysqli_query($con, $sql);
$count = mysqli_num_rows($res);
// (END) DISPLAY COMMITTEE


if(isset($_GET['type']) && $_GET['type']!=''){
   $type = mysqli_real_escape_string($con, $_GET['type']);

   if ($type=='delete'){
      $id = mysqli_real_escape_string($con, $_GET['id']);
      $delete_sql = "delete from committee where com_id='$id'";
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
                           <h4 class="box-title">Department Committees </h4>
                           <h4 class="box-link"><a href='manage_comm.php?comm=department'> Add a Committee </a> </h4>
                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Committee</th>
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
                                            echo "<td>" . $row['com_name'] . "</td>";
                                            echo "<td>";
                                            
                                            echo "<a href='showpeople.php?type=show&abbrv=" .$row['abbrv']. "'>Members</a>&nbsp&nbsp&nbsp";
                                            echo "<a href='manage_comm.php?comm=department&type=edit&id=" .$row['com_id']. "'>Edit</a>&nbsp&nbsp&nbsp";
                                            echo "<a href='?type=delete&id=" .$row['com_id']. "'>Delete</a>&nbsp";
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