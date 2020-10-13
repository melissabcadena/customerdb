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
    $sql = "SELECT * FROM customer_info WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
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
  <?php if($customer) : ?>
    <tr>
      <th scope="row"><?php echo $customer['id']?></th>
      <td><?php echo $customer['name']?></td>
      <td><?php echo $customer['email']?></td>
      <td><?php echo $customer['phone']?></td>
      <td><a href="#">Update</a></td>
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

<?php include('templates/footer.php'); ?>