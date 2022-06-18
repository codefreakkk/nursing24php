<?php session_start();?>    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Nursing<span> 24</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="aboutus.php" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
			<?php
				if(isset($_SESSION['loggedin']) == true) {
					echo '<li class="nav-item"><a href="user/userdash/dashboard.php" class="nav-link">Dashboard</a></li>
					<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
				} else {
					echo '<li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
					<li class="nav-item"><a href="signup.php" class="nav-link">Sign Up</a></li>';
				}
			?>
		
	          <!-- <li class="nav-item cta"><a href="contact.html" class="nav-link" data-toggle="modal" data-target="#modalRequest"><span>Make an Appointment</span></a></li> -->
	        </ul>
	      </div>
	    </div>
	  </nav>