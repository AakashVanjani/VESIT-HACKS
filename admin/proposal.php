<?php
require('header.inc.php');

// this is admin-side proposals page !!

#yeh comm name mila, ab iski id chahiye.
$curr_admin_com = $_SESSION['admin_comm'];
$sql = "select com_id from committee where abbrv='$curr_admin_com'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$cur_admin_com_id = $row['com_id'];



// (START) current logged-in user & get committee & abbrv of cur_user.
$cur_user=$_SESSION['admin_name'];
$sql = "select committee.* from committee, admin where admin.username='$cur_user' and committee.abbrv=admin.council_name";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

# find current user's comm
# to get comm name, join on proposal&comm
/*$curr_user_comm = $row['com_id'];
$curr_user_comm = $row['council_name'];*/
// (END) current logged-in user & get committee & abbrv of cur_user.



$ser=0;
$key='';
$res = '';

// key means pending, accepted or rejected.
if(isset($_GET['key']) && $_GET['key']!=''){
   $key = $_GET['key'];
   
    $show_sql = "select * from events where status='$key' and comm_name='$curr_admin_com'";
    $res = mysqli_query($con, $show_sql);
    
}


if(isset($_GET['type']) && $_GET['type']!=''){

    $type = $_GET['type'];
    $id = mysqli_real_escape_string($con, $_GET['id']);

    if ($type=='delete'){
        $delete_sql = "delete from events where prop_id='$id'";
        mysqli_query($con, $delete_sql);
    }

    if ($type=='proceed'){
        # only chnage it's status from accepted to upcoming.
        $proceed_sql = "update events set status='upcoming' where status='accepted' and event_id='$id'";
        mysqli_query($con, $proceed_sql);
        header('location:events.php?key=upcoming');


    }

    else{
        $update_sql = "update events set status='$type' where event_id='$id'";
        mysqli_query($con, $update_sql);        
    }
    #header('location:proposal.php?key=pending');

}

?>


<style>
.center {
  text-align: center;
}
</style>

<h1 class="box-title center"> <?php echo $row['com_name'] . " (" . $row['abbrv'] . ") " ?>  </h4><br>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title"> <?php echo $key . " " ?>Proposals </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>ID</th>
                                       <th>Event Title</th>
                                       <th>Event Description</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if($res){
                                        while ($row = mysqli_fetch_array($res)){
                                            $ser = $ser+1 ;
                                            echo "<tr>";
                                            echo "<td>" . $ser . "</td>";
                                            echo "<td>" . $row['event_name'] . "</td>";
                                            echo "<td>" . $row['event_desc'] . "</td>";
                                            echo "<td>";

                                        if ($key!='accepted' && $key!='rejected'){
                                            echo "<a href='?type=accepted&id=" .$row['event_id']. "'>Accept</a>";
                                            echo "/";
                                            echo "<a href='?type=rejected&id=" .$row['event_id']. "'>Reject</a>&nbsp&nbsp&nbsp";
                                        }

                                        elseif($key == 'accepted'){
                                            echo "<a href='?type=proceed&id=" .$row['event_id']. "'>Proceed to launch the event !</a>&nbsp&nbsp&nbsp&nbsp";
                                            echo "<a href='?type=rejected&id=" .$row['event_id']. "'>Reject</a>&nbsp&nbsp&nbsp";
                                     
                                        }
                                            #echo "<a href='?type=edit&id=" .$row['prop_id']. "'>Edit</a>&nbsp&nbsp&nbsp";
                                            echo "<a href='?type=delete&id=" .$row['event_id']. "'>Delete</a>&nbsp";
                                     
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