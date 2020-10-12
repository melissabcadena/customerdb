
<?php 

  // was the form submitted
  if(isset($_POST['submit'])){

    // check that form was filled out correctly
    if(empty($_POST['name'])) {
      echo 'Please enter name! <br />';
    } else {
      echo $_POST['name'];
    };

    if(empty($_POST['email'])) {
      echo 'Please enter email! <br />';
    } else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Please enter valid email! <br />';
      }
    };

    if(empty($_POST['phone'])) {
      echo 'Please enter phone number! <br />';
    } else {
      $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
      $validphone = str_replace("-", "", $phone);
      if (strlen($validphone) < 10 || strlen($validphone) > 14) {
        echo 'Please enter valid phone number! <br />';
      } else {
        echo $validphone;
      }
    };
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
          <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNumber" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="123.456.7890">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Submit!" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>

<?php include('templates/footer.php'); ?>
