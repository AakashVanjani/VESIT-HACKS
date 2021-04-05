<?php
$servername="localhost";
$username="root";
$password="";
$database="vesit_hacks";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Sorry Connection is not successful.");
}


if(isset($_GET['type']) && $_GET['type']!=''){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $type = $_GET['type'];


    $review_sql = "update events set status='$type' where event_id='$id'";
    mysqli_query($conn, $review_sql);

}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">


    <title>Pending Event Proposals</title>
</head>
<div class="vesitheader bg-light">
    
        
        
        <a class="mr-auto" style="padding-left: 5%;padding-top:0.5%;padding-bottom:0.5%;" href="/"> <img src="https://vesit.ves.ac.in/navlogo.png" class="dispheadermob" alt=""></a>
    </div>

<body>
<div class="container">
<div class="container my-2">
<b>Pending Event for Approval at Institute Level</b>
</div>

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Committee</th>
                    <th scope="col">Actions</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM `events` WHERE `comm_type` = 'institute' and `status`= 'pending'";
    $result = mysqli_query($conn,$query);
    $sno=0;
    while($row=mysqli_fetch_assoc($result)){
        $sno =$sno + 1;
      
      echo "<tr>
      <th scope='row'>".$sno."</th>
      <td>".$row['event_name']."</td>
      <td>".$row['event_desc']."</td>
      <td>".$row['comm_name']."</td>
      <td>
      <a href='?type=accepted&id=" .$row['event_id']. "'><button class='edit btn-btn-sm btn-primary'>Allow the Event</button></a> 
      <a href='?type=rejected&id=" .$row['event_id']. "'><button class='delete btn btn-sm btn-primary'>Deny the Event</button></a>
      </td>
      </tr>"; 
    }
    ?>
        </tbody>
        </table>

    </div>
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


</body>

<?php 
/*      vanjani's code
<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this Event !")) {
                    console.log("yes");
                    window.location = `/VESITHACKS/PendingAprovaldata.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                }
                else {
                    console.log("no");
                }
            })
        })
    </script>

*/
?>