
<?php 

include('config/db_connect.php');


$errors = array('name'=> "", 'email'=> '', 'phone'=>'');
$name='Full name';
$email='Email';
$phone='123-456-7890';

  // was the form submitted
  if(isset($_POST['submit'])){

    // check that form was filled out correctly
    if(empty($_POST['name'])) {
      
      $errors['name'] = 'Please enter name! <br />';
    } else {
      $name = $_POST['name'];
    }

    if(empty($_POST['email'])) {
      $errors['email'] = 'Please enter email! <br />';
    } else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter valid email! <br />';
      }
    };

    if(empty($_POST['phone'])) {
      $errors['phone'] = 'Please enter phone number! <br />';
    } else {
      $cleanPhone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
      $phone = str_replace("-", "", $cleanPhone);
      if (strlen($phone) < 10 || strlen($phone) > 14) {
        $errors['phone'] = 'Please enter valid phone number! <br />';
      }
    }

    // redirect back to initial page if no form errors
    if(!array_filter($errors)) {

      // save to db 
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);

      $sql = "INSERT INTO customer_info(name, email, phone) VALUES('$name', '$email', '$phone')";

      // if successfully added, redirect
      if(mysqli_query($conn, $sql)) {
        header('location: index.php');
      } else {
        // if error
        echo 'query error: ' . mysqli_error($conn);
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
          <input type="text" class="form-control" id="inputCustomer" name="name" value="<?php echo $name; ?>" >
          <div class='text-danger'><?php echo $errors['name'];?></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail" name="email" value="<?php echo $email; ?>">
          <div class='text-danger'><?php echo $errors['email'];?></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNumber" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPhone" name="phone" value="<?php echo $phone; ?>">
          <div class='text-danger'><?php echo $errors['phone'];?></div>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Submit!" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>

<?php include('templates/footer.php'); ?>
