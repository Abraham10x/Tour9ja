<?php
  include 'db_conn.php';
  error_reporting(0);

  // session_start();

  if (isset($_SESSION['username'])) {
      header("Location: index.php");
  }

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if (!$result->num_rows > 0) {
        $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          echo "<script>alert('Wow! User Registration Completed.')</script>";
          $username = "";
          $email = "";
          $_POST['password'] = "";
          $_POST['cpassword'] = "";
        } else {
          echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
      } else {
        echo "<script>alert('Woops! Email Already Exists.')</script>";
      }
      
    } else {
      echo "<script>alert('Password Not Matched.')</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/5a5a633a88.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="register.css" />
  </head>
  <body>
    <header 
      style="
        background-image: url('images/Register-img.jpg'); 
        background-repeat: no-repeat; 
        padding: 4rem 7rem; 
        height: 130vh; 
        background-position: right;
        text-align: left;
      "
    >
      <nav>
        <img src="images/Logo.svg" alt="brand logo" class="logo" />
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="bookings.php">Bookings</a></li>
        </ul>
        <div class="nav-btn">
          <a href="login.php"><button class="login btn">Login</button></a>
          <a href="register.php"
            ><button class="Register btn">Register</button></a
          >
        </div>
      </nav>

      <div class="form-element">
        <h1>Get Started.</h1>
        <p class="subtle">
          Already have an account? Login
          <span><a href="login.php">Login</a></span>
        </p>
        <form method="POST" action="">
          <label for="username">Username</label>
          <input
            type="text"
            name="username"
            id="username"
            placeholder="e.g Computer Matrix"
            value="<?php echo $username; ?>" required
          />
          <label for="email-address">Email Address</label>
          <input
            type="email"
            name="email"
            id="email-address"
            placeholder="e.g janesmith@gmail.com"
            value="<?php echo $email; ?>" required
          />
          <label for="password">Password</label>
          <input 
            type="password" 
            name="password" 
            id="password" 
            placeholder="........"
            value="<?php echo $_POST['password']; ?>" required
            />
          <label for="confirm-password">Confirm Password</label>
          <input
            type="password"
            name="cpassword"
            id="confirm-password"
            placeholder="........"
            value="<?php echo $_POST['cpassword']; ?>" required
          />
          <div class="form-buttons">
            <button name="submit" class="btn account">Create Account</button>
          </div>
        </form>

        <p class="terms">
          Tour Nigeria awakens the adventurer in you, taking you on a journey
        </p>
      </div>
    </header>
  </body>
</html>
