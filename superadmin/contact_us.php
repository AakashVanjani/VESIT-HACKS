<?php
require('header.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
   $type = mysqli_real_escape_string($con, $_GET['type']);

   if ($type=='delete'){
      $id = mysqli_real_escape_string($con, $_GET['id']);
      $delete_sql = "delete from contact_us where id='$id'";
      mysqli_query($con, $delete_sql);
   }

}


$sql = " select * from contact_us order by id desc";
# how to rename a table -> ALTER TABLE `contact us` RENAME TO `contact_us`;
$res = mysqli_query($con, $sql);
#$count = mysqli_num_rows($res);




// THIS PAGE IS ONLY FOR DISPLAYING THE QUERIES OF CUSTOMERS TO ADMIN   !!!!!!



?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Contact Us</h4>
                           </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Phone Number</th>
                                       <th>Doubt</th>
                                       <th>Date</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    #if ($res){
                                        $ser = 1;
                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<tr>";
                                            echo "<td class='serial'>" . $ser . "</td>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone_num'] . "</td>";
                                            echo "<td>" . $row['doubt'] . "</td>";
                                            echo "<td>" . $row['asked_on'] . "</td>";
                                            echo "<td>";
                                            echo "<a href='?type=delete&id=" .$row['id']. "'>Delete</a>&nbsp";
                                            echo "</td>";
                                        echo "</tr>";
                                        }
                                    #}
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