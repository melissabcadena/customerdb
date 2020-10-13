<?php

include('config/db_connect.php');

if(isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM customer_info WHERE id = $id_to_delete";

    // if successful
    if(mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        // if not successful
        echo 'query error: ' . mysqli_error($conn);
    }
}

// check get request id
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // grab customer info
    $sql = "SELECT * FROM customer_info WHERE id = $id";

    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);

    // grab customer notes
    $sqlNotes = "SELECT note FROM `customer_notes` WHERE user_id = $id";


    $notesResult = mysqli_query($conn, $sqlNotes);
    $allNotes = mysqli_fetch_all($notesResult);
    mysqli_free_result($result);
    mysqli_free_result($notesResult);

    mysqli_close($conn);
}

// add new note form submitted
if(isset($_POST['newNote'])){
    $id_to_add = mysqli_real_escape_string($conn, $_POST['id_to_add']);
    $note = mysqli_real_escape_string($conn, $_POST['note-text']);
    $sql = "INSERT INTO customer_notes(note, user_id) VALUES('$note', '$id_to_add')";
    // if successful
    if(mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        // if not successful
        echo 'query error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>


  <h4> Individual Customer </h4>

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>


    </tr>
  </thead>
  <tbody>
  <?php if($customer) :?>
    <tr>
      <th scope="row"><?php echo $customer['id']?></th>
      <td><?php echo $customer['name']?></td>
      <td><?php echo $customer['email']?></td>
      <td><?php echo $customer['phone']?></td>
      <td><a href="updateCustomer.php?id=<?php echo $customer['id']?>" class="btn btn-primary">Update</a></td>
      <td>
        <form action='customer.php' method='post'>
            <input type="hidden" name="id_to_delete" value="<?php echo $customer['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-primary">
        </form>
      </td>

    </tr>


  <?php else: ?>
    <h4> No Customer with this ID!</h4>
  <?php endif; ?>

  

  </tbody>
</table>

    <!-- Customer Notes -->
    <h4>Customer Notes: </h4>
    
 <!-- loops through notes to create li for each note -->
     <ul class="list-group">
         <?php foreach($allNotes as $note){ 
            foreach($note as $singleNote) { ?>
        <li class="list-group-item"><?php echo $singleNote?></li>
        <?php }
    } ?>  
    </ul> 

   
    <!-- new note form -->
    <div>
        <form role="form" method="POST" action="customer.php">
            <textarea name="note-text" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
            <input type="hidden" name="id_to_add" value="<?php echo $customer['id'] ?>">
        ,    <input type="submit" value="Add note!" name="newNote" class="btn btn-primary"/>
        </form>
    </div>



<?php include('templates/footer.php'); ?>