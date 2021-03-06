  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center banner">
    <h1><div class="heads">Heaven Car Rental</div></h1>      
    <p class="heads">Fast, Smooth &amp; Affordable!</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="./images/logo.png" height="20"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset($_SESSION['userID'])) { ?>
		<li><a href="my-account.php"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
		<?php } else { ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
        <li><a href="register.php"> Register</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>


	
<?php if(isset($_SESSION['name'])) { ?>
	<div class="alert alert-success">
		<div class="text-center">
			<span class="glyphicon glyphicon-user"></span>
				Welcome, <strong><?php echo $_SESSION['name']; ?></strong>!
		</div>
	</div>
<?php } ?>
	


<div class="container">    
  <div class="row">
  <div class="text-center">
  <h1>Welcome to Heaven Car Rental</h1>
  <p>We provide you a various car to rent for your needs with affordable price!</p>
  </div><br>
  </div>