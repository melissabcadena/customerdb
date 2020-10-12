
<?php 

  // was the form submitted
  if(isset($_POST['submit'])){
    echo $_POST['name'];
    echo $_POST['email'];
    echo $_POST['phone'];
  }

?>

<!DOCTYPE html>
<?php include('templates/header.php'); ?>


<!-- Customer Form --> 

<h2 class="text-center"> Add New Customer </h2>
    <form role="form" method="POST" action="addCustomer.php">
      <div class="form-group row">
        <label for="inputCustomer" class="col-sm-2 col-form-label">Customer Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputCustomer" name="name" placeholder="Full Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNumber" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="inputPhone" name="phone" placeholder="123.456.7890">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Submit!" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>

<?php include('templates/footer.php'); ?>
