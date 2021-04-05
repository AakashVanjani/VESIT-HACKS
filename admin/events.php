<?php
require('header.inc.php');

// this is admin-side proposals page !!

$ser=0;
$curr_admin_com = $_SESSION['admin_comm'];

$key2 = mysqli_real_escape_string($con,$_GET['key']);

if(isset($_GET['key']) && $_GET['key']!=''){
   $key = mysqli_real_escape_string($con,$_GET['key']);
   if ($key=='upcoming'){
      $show_sql = "select * from events where start_date >= CURRENT_TIMESTAMP and comm_name='$curr_admin_com' and status='upcoming'";
   }
   else{
      #jo event upcoming they & unka date cross hogya, mtlb wo complete hogaye.
      $update_sql = "update events set status='completed' where end_date <= CURRENT_TIMESTAMP and status='upcoming'";
      mysqli_query($con, $update_sql);
      $show_sql = "select * from events where status='completed' and comm_name='$curr_admin_com';
      # and status='completed'";
    
   }

   $res = mysqli_query($con, $show_sql);
    
}


?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title"> <?php echo $key . " " ?>Events </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Event Title</th>
                                       <th>Event Description</th>
                                       <th>start Date</th>
                                       <th>End Date</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if ($res){
                                        while ($row = mysqli_fetch_array($res)){
                                            $ser = $ser+1 ;
                                            echo "<tr>";
                                            echo "<td>" . $ser . "</td>";
                                            echo "<td>" . $row['event_name'] . "</td>";
                                            echo "<td>" . $row['event_desc'] . "</td>";
                                            echo "<td>" . $row['start_date'] . "</td>";
                                            echo "<td>" . $row['end_date'] . "</td>";
                                            echo "<td>";
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