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
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <header
      style="
        background-image: url('images/login-image.jpg');
        background-repeat: no-repeat;
        padding: 4rem 7rem;
        height: 120vh;
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
        <h1>Welcome back!</h1>
        <p class="subtle">Please login to your account.</p>
        <form action="check-login.php" method="post">
          <label for="username">Username</label>
          <input
          type="text"
          name="username"
          id="username"
          placeholder="e.g Computer Matrix"
          />
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="............"
          />

          <div class="mb-1">
            <label class="form-label">Select User Type:</label>
          </div>
          <select
            class="form-select mb-3"
            name="role"
            aria-label="Default select example"
          >
            <option selected value="user">User</option>
            <option value="admin">Admin</option>
          </select>
          <div class="form-buttons">
            <button name="submit" class="btn">Login</button>
              <a href="register.php" class="btn account">Create Account</a>
          </div>
        </form>

        <p class="terms">
          Tour Nigeria awakens the adventurer in you, taking you on a journey
        </p>
      </div>
    </header>
  </body>
</html>
