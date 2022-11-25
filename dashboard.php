<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<?php 

      // Create database connection
  $db = mysqli_connect("localhost", "root", "", "upload-travel");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (images, text) VALUES ('$image', '$image_text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");

?>  

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="bookings.css" />
  </head>
  <body>
    <header 
      style=
        "background-image: url('images/dashboard-img.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        padding: 4rem 7rem;
        height: 55vh;
        text-align: center;
      "
    >
      <nav>
        <img src="images/Logo.svg" alt="brand logo" class="logo" />
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="bookings.php">Bookings</a></li>
          <li><a href="comments.php">feedbacks</a></li>
        </ul>
        <div class="nav-btn">
            <a href="logout.php"><button class="login btn">Logout</button></a>
          </div>
      </nav>

      <h1>My Dashboard</h1>
      <h2 style="color: #fff; font-size: 3.6rem;" id="welcome">Welcome <?=$_SESSION['username']?>!</h2>
    </header>



      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->
      		<div class="card" style="width: 18rem;">
			  <img src="images/admin-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			<div class="p-3">
				<?php include 'members.php';
                 if (mysqli_num_rows($res) > 0) {?>
                  
				<h1 class="display-4 fs-1">Members</h1>
				<table class="table" 
				       style="">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Email</th>
				      <th scope="col">User name</th>
				      <th scope="col">Role</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['email']?></td>
				      <td><?=$rows['username']?></td>
				      <td><?=$rows['role']?></td>
				    </tr>
				    <?php $i++; }?>
				  </tbody>
				</table>
				<?php }?>
			</div>
      	<?php }else { ?>
      		<!-- FORE USERS -->
      		<div class="card" style="width: 18rem;">
			  <img src="images/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h3 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h3>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
      <div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['images']."' >";
      	echo "<p>".$row['text']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="dashboard.php" enctype="multipart/form-data" class="form">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input class="input-group" type="file" name="image">
  	</div>
  	<div>
      <textarea 
        class="input-group textarea"
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<button type="submit" class="btn" name="upload">POST</button>
  	</div>
  </form>
</div>

      	<?php } ?>
      </div>




    <footer>
      <div class="brand">
        <img src="images/Logo.svg" alt="" class="logo-footer" />
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>

      <div class="resources-links">
        <h3>Resources</h3>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="bookings.php">Bookings</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="register.php">Register</a></li>
        </ul>
      </div>

      <div class="get-started-links">
        <h3>Get Started</h3>
        <ul class="footer-links">
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Sign Up</a></li>
        </ul>
      </div>

      <div class="social">
        <h3>Socials</h3>
        <ul class="footer-links">
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Twitter</a></li>
        </ul>
          <p class="copyright">Copyright © 2022</p>
        </div>
      </div>
    </footer>
  </body>
</html>
<?php }else{
	header("Location: index.php");
} ?>
