<?php

include('config/db_connect.php');

  // query for all customers
  $sql = 'SELECT * FROM customer_info ORDER BY created_at';
  $data = mysqli_query($conn, $sql);
  $customers = mysqli_fetch_all($data, MYSQLI_ASSOC);

  // release from memory & close conn
  mysqli_free_result($data);
  mysqli_close($conn);


?>

<!DOCTYPE html>
<html>

  <?php include('templates/header.php'); ?>

  <h4> Customer Data Table </h4>
  <p> Click ID# for more options </p>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($customers as $customer){ ?>
    <tr>
      <th scope="row"><a href="customer.php?id=<?php echo $customer['id']?>"><?php echo $customer['id']?></a></th>
      <td><?php echo $customer['name']?></td>
      <td><?php echo $customer['email']?></td>
      <td><?php echo $customer['phone']?></td>
    </tr>

  <?php } ?>

  </tbody>
</table>
    

    

    <?php include('templates/footer.php'); ?>
