<?php
if(isset($_POST["register"])){
  require_once("dbconfig.php");
  $full_name = $_POST["full_name"];
  $email     = $_POST["email"];
  $username  = $_POST["username"];
  $password  = $_POST["password"];
  
  // print($email);
  $regex = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';
  // print(preg_match($regex , $email, $matches));

  if (1 === preg_match($regex , $email, $matches)) {
    if (strlen($password > 6)) {
      $password_md5 = md5($password);
      $sql = "INSERT INTO usertbl (id, fullname, email, username, password, tyc)".
              " VALUES (NULL, '".$full_name."', '".$email."', '".$username."', '".$password_md5."', '1');";
      $result = mysqli_query($con,$sql);
      print("Insert new user!");
    }
  }
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guia 1 demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body style="margin: 10%;">
    <h1>Sing Up</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
    <form id="registerform" name="registerform" action="register.php" method="POST" >
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="full_name" required>
        <div id="name" class="form-text">Enter your complete Name.</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" 
            pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5" required>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">User</label>
          <input type="text" class="form-control" id="username" name="username" required>
        <div id="name" class="form-text">Enter your machine user.</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tyc" required>
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" name="register">Submit</button>
    </form>

    <script>
      $(document).ready(function() {
        $('#form').submit(function(event) {
          if ($('#password').val().length <= 6) {
            alert("La contraseña debe tener más de 6 caracteres.");
            event.preventDefault();
          } else {
            // alert($('#email').val());
          }
        });
      });
    </script>
</body>
</html>