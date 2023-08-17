<?php
session_start();
if(isset($_POST["login"])){
  require_once("dbconfig.php");
  $email     = $_POST["email"];
  $password  = $_POST["password"];
  $regex = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';
  $ip = $_SERVER["REMOTE_ADDR"];
  $captcha = $_POST["g-recaptcha-response"];

  $cap_key = "6LfI-bAnAAAAAOt1iZA3VhBcshdr4n9HT6GrddeC";

  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = ['secret' => $cap_key, 'response' => $captcha, 'remoteip' => $ip];
  $options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === false) {
  /* Handle error */
}else{
$rst_captcha = json_decode($result, TRUE);
}if($rst_captcha["success"])
  print("validacion Recaptcha OK");
else
  print("validacion Recaptcha MAL");
  
if (1 === preg_match($regex , $email, $matches)) {
  if (strlen($password > 5)) {
    $password_md5 = md5($password);
    // Comparar contraseñas encriptadas
    $sql = "SELECT * FROM usertbl WHERE email = '".$email."' AND password = '".$password_md5."';";
    $result = mysqli_query($con,$sql);
    $num_rows = mysqli_num_rows($result);
  
    if($num_rows > 0){
      $_SESSION["session_username"] = $email;
      header("location:intropage.php");
    }
  } else {
    echo 'pass';
  }
} else {
  echo 'malll';
}

  

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guia 1 demo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body style="margin: 10%;">
    <h1>Login</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
    <form name="loginform" id="form" action="login.php" method="POST" >
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" required name="email" class="form-control" id="email" aria-describedby="emailHelp" 
            pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password" required class="form-control" id="pass" name="password">
          </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out tyc</label>
        </div>
        <div class="g-recaptcha" data-sitekey="6LfI-bAnAAAAAKpuW30Xo7_c_pbKETR2vkMv_xP5"></div>
        <button type="submit" name="login" class="btn btn-primary">Submit</button>
    </form>

    <script>
      $(document).ready(function() {
        $('#form').submit(function(event) {
          if ($('#pass').val().length <= 5) {
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
