<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet'
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
<?php session_start();
if(!isset($_SESSION['login'])){
      echo '<span class="right"><a href="signUp.html">SignUp</a>&nbsp;&nbsp;</span>
            <span class="right"><a href="SignIn.php">LogIn</a> </span>';
} else {
      echo '<i>' . $_SESSION['login'] . '</i> barruan da.<br/>';
      echo '<span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
            <div align="right">
            <form method="post" action="LogOut.php" id="logout" name="logout" enctype="multipart/form-data">
            <input type="submit" class="button" name="logout" value="Log out" /></form>
            </div>';
}
?>

	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='ShowQuizzes.php'>Quizzes</a></span>
		<?php if(isset($_SESSION['login'])){
			echo "<span><a href='handlingQuizzes.php'>Galderak sortu</a></span>";
			if($_SESSION['erabmota']=="irakasle"){
				echo "<span><a href='reviewingQuizes.php'>Galderak berrikusi</a></span>";
			}
		      }
		?>
		<span><a href='credits.html'>Credits</a></span>
	</nav>
    <section class="main" id="s1">
    
	
	<div>
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
