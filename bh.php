<!DOCTYPE html>
<html>

	<head>
		<?php session_start(); ?>
		<title>Board Hoarder - Buy Longboards Cheap</title>
		<meta charset="utf-8" />
		<link href="bhstyle.css" type="text/css" rel="stylesheet" />		
		<link href = "lb.jpg" type = "image/png" rel = "shortcut icon"/>
	</head>

	<body>
		<img id="logo" src="logo.png" type="image/png" >
		
		<div id="menu">
		<ul id="nav">
			<li><a href="?section=home">Home</a></li>

			<li class="sub"><a href="?section=Brands">Brands</a>
                <ul>
                	<li><a href="?section=Bustin">Bustin</a></li>
                	<li><a href="?section=Sector9">Sector 9</a></li>
                	<li><a href="?section=Landyachtz">Landyachtz</a></li>
                	<li><a href="?section=Arbor">Arbor</a></li>
                	<li><a href="?section=Comet">Comet</a></li>
                </ul>
            </li>
			<li><a href="?section=about">About</a></li>
			<li><a href="?section=Contacts">Contacts</a></li>
			<li><a href="?section=cart">Cart</a></li>
			<li class="sub"><a href="?section=SignIn">Sign In</a>
                <ul>
                	<li class ="sub"><a href="?section=Register">Sign Up</a></li>
					<li><a href="?section=logout">Log Out</a></li>
                	<li><a href="#">Help</a></li>
                </ul>
            </li>
            </li>
			
		</ul>
		</div>

		<?php 
			$section = (isset($_GET['section'])) ? $_GET['section']: "";
			$action = (isset($_GET['action'])) ? $_GET['action']: "";
			
			if($section != 'home'){
				
				// Because of problems reading from files we have to make separate if statements for about, contacts, brands
				
				if($section == 'about'){
				?>
				
				<div id="cont">
				At Board Hoarder we work very hard to provide a large variety.
				<br></br> Whether you're interested in Longboarding, we've got it all at very reasonable prices. 
				<br></br>Feel free to browse around!
				</div>
				<?php
				}
				
				else if($section == 'Brands'){
				?><div id="cont">
				<a href="bh.php?section=Bustin"><img id="brand_logo" src="Products/Logo/Bustin.jpg" type="image/jpg" height="120" width="120" ></a>
				<a href="bh.php?section=Sector9"><img id="brand_logo" src="Products/Logo/Sector9.jpg" type="image/jpg" height="120" width="120"></a>
				<a href="bh.php?section=Comet"><img id="brand_logo" src="Products/Logo/Comet.png" type="image/png" height="120" width="120"></a>
				<a href="bh.php?section=Landyachtz"><img id="brand_logo" src="Products/Logo/Landy.jpg" type="image/jpg" height="120" width="120"></a>
				<a href="bh.php?section=Arbor"><img id="brand_logo" src="Products/Logo/arbor.jpg" type="image/jpg" height="120" width="120"></a>
				</div>
				<?php
				}
				
				else if($section == 'Contacts'){
				?>
				<div id="cont">
				Since we're online, we're open all the time! <br></br> 
				If you need support, want to report faulty products or need to return an item, call us at (845) 555-5555.
				<br></br> If you need service on your gear call (845) 555-FIXD. 
				<br></br>Located in A'Discrete Lecation, NY 10666
				</div>
				<?php
				}
				
				else if($section == 'SignIn'){

					?>
					<div id="cont">
					
					<?php					
					if(isset($_POST['login_button']))
					{
						$first = $_REQUEST['first'];
						$last = $_REQUEST['last'];
						$username = $_REQUEST['username'];
						$password = $_REQUEST['password'];
						$address = $_REQUEST['address'];
						$file = fopen("register.txt", "a");
						$register = "$first,$last,$username,$password,$address\n";							
						fwrite($file, $register);
						fclose($file);
					}
					?>
						<form name="myForm" method="post" action="bh.php?action=login_attempt" id="login_form" onsubmit="return validateForm()">
						Username:
						<input type="text" placeholder="Username" name="username" id="login_username" /><br />
						<br />
						Password:
						<input type="password" placeholder="Password" name="password" id="login_password" /><br />
						<br />
						<input type = "submit" name="login_attempt">
						
						<script>
						function validateForm()
						{
						var x=document.forms["myForm"]["username"].value;
						var y=document.forms["myForm"]["password"].value;
						if (x==null || x=="" && y==null || y=="")
						  {
						  alert("USERNAME AND PASSWORD REQUIRED");
						  return false;
						  }
						}
						</script>
						</form>
					</div>
					<?php
				}
				
				else if ($section == 'Register') {
				?>
					<div id ="cont">
					<form name="myForm1" method="post" action="bh.php?section=SignIn" id="login_form" onsubmit="return validateForm()">
						First Name:
						<input type="text" placeholder="First Name" name="first" id="first" /><br />
						Last Name:
						<input type="text" placeholder="Last Name" name="last" id="last" /><br />
						Username:
						<input type="text" placeholder="Username" name="username" id="login_username" /><br />
						Password:
						<input type="password" placeholder="Password" name="password" id="login_password" /><br />
						Address:
						<input type="text" placeholder="address" name="address" id="address" /><br />
						<input type = "submit" name="login_button">
						
						<script>
						function validateForm()
						{
						var x=document.forms["myForm1"]["username"].value;
						var y=document.forms["myForm1"]["password"].value;
						if (x==null || x=="" && y==null || y=="")
						  {
						  alert("ALL TEXT FIELDS REQUIRED");
						  return false;
						  }
						}
						</script>
						
						</form>
					</div>
				<?php
				}
				
				else if($action == 'login_attempt'){
					$username = $_REQUEST['username'];
					$password = $_REQUEST['password'];
					$file = file_get_contents("register.txt");
					$user = explode("\n",$file);
					$bool = false;
					
					for($x=0; $x < sizeof($user); $x++){
						$match = explode(",", $user[$x]);			
						$compare_user = $match[2];
						$compare_pw = $match[3];
						if($compare_user  == $username && $compare_pw == $password){	
							$bool = true;
							?>
							<?php
							

							if (file_exists("user/$username.txt")) {
								$newfile = fopen("user/$username.txt", "r+");
							?>
								<div id="cont" ><p>Successful Login.<br/>Welcome back, <?=$username?>!<br/>Redirecting to home page...</p></div>
							<?php
							}
							else {
								$newfile = fopen("user/$username.txt", "x+");
							?>
								<div id="cont" ><p>Successful Login.<br/>Thanks for joining us, <?=$username?>!<br/>Redirecting to home page...</p></div>
							<?php
							}
							$_SESSION['user'] = $username;
							header('Refresh: .5; URL=?section=home');							
						}
					}
										
					if($bool == false){
					?><div id="cont" ><p>Invalid username/password.</p></div><?php
					}	
				}
				
				else if ($section == 'Bustin' or $section == 'Arbor' or $section == 'Sector9' or $section == 'Landyachtz' or $section == 'Comet'){
					branditem($section);
				}
				
				else if ($section == 'logout') {
					
					if (isset($_SESSION['user'])) {
						session_destroy();
				?>
						<div id="cont" ><p>Successful Log out. <br> Goodbye <?=$_SESSION['user']?>.</p></div>
				<?php
					}
					else {
				?>
						<div id="cont" ><p>You haven't logged in yet!<br/>Redirecting to log-in...</p></div>
				<?php
						header('Refresh: .5; URL=?section=SignIn');
					}					
				}
				else if($section == 'addtocart'){
					$username = $_SESSION['user'];
					$item_name = $_REQUEST['brand'];
					$brand = $_REQUEST['item_name'];
					$price_deck = $_REQUEST['price_deck'];
					$price_complete = $_REQUEST['price_complete'];
					
					$file = fopen("user/$username.txt", "a");
					$data = "\n$brand,$item_name,$price_deck,$price_complete";							
					fwrite($file, $data);
					
					?><div id="cont"><p>Item Added to Cart!</p></div><?php
					header('Refresh: .5; URL=?section=cart');
				}
				
				
				else if($section == 'cart'){
					$username = $_SESSION['user'];
					$fileopen = file_get_contents("user/$username.txt");
					$useritem = explode("\n", $fileopen);
					?>
					<div id = "cont">
					
					<h3><?=$username?>'s Cart</h3>
					<center><table border = '1'>
						<tr id = "row">
							<td>Brand</td>
							<td>Item</td>
							<td>Price Deck</td>
							<td>Price Complete</td>
						</tr>
						<tr>
						<?php 
						$count_deck = 0;
						$count_comp = 0;
						
						if($useritem)
							for ($x = 0; $x < (sizeof($useritem)); $x++) {
							
								$cart = explode(",", $useritem[$x]);							
								?>
									
										<td><?=$cart[0]?></td>
										<td><?=$cart[1]?></td>
										<td>$<?=$cart[2]?></td>
										<td>$<?=$cart[3]?></td>
										</tr>
								<?php
								$deck = (int)$cart[2];
								$comp = (int)$cart[3];
								
								$count_deck = $count_deck + $deck;
								$count_comp = $count_comp + $comp;
								
							}
						?>
					</table></center>
					<p>Deck Total: $<?=$count_deck;?></p>
					<p>Complete Total: $<?=$count_comp;?></p>
					<form method="post" action="">
					<input type ="submit" value="Remove Last Item" name="pop">
					<input type="submit" value="Checkout">					
					
					<?php
					//REMOVE FROM CART
					if(isset($_POST['pop']))
					{
						array_pop($useritem);
						$newuseritem = implode("\n", $useritem);
						$file = fopen("user/$username.txt", "w");
						fwrite($file, $newuseritem);
						header('Refresh: .5; URL=?section=cart');
					}
					?>
					</form>
					</div>
					
					<?php

				}
				
				else
					prodpage($section);
			}
		?>	
	</body>
</html>		
		
		
		
<?php 
	function prodpage($section){
		?><div id="cont"><?php
		$contents = file_get_contents('boardinfo.txt');
		$item = explode("\n", $contents);
		
		for($x=0; $x < sizeof($item); $x++){
			$single_item = explode(" ", $item[$x]);
			
			if ($section == $single_item[4]) {

				?>
				<img id = "pic" src = "<?=$single_item[1]?>" />
				<h1><?=$section?></h1>
				<h2><?=$single_item[0]?></h2>
				<h2>Length: <?=$single_item[5]?></h2>
				<h2>Deck: <?=$single_item[2]?></h2>
				<h2>Complete: <?=$single_item[3]?></h2>
				
				<br><br><br>
				<h4>Description: </h4><p>
				<?php
				for ($x = 5; $x < sizeof($single_item); $x++) {
					echo $single_item[$x];
					echo " ";
				}
				?></p><br>
				
				<?php
				if(isset($_SESSION['user'])){
				?>
				<form method="post" action="bh.php?section=addtocart">
					<input type="hidden" name="brand" value="<?=$section?>"/>
					<input type="hidden" name="item_name" value="<?=$single_item[0]?>"/>
					<input type="hidden" name="price_deck" value="<?=$single_item[2]?>" />
					<input type="hidden" name="price_complete" value="<?=$single_item[3]?>" />
					<input type="submit" value="Add to Cart">
				</form>
				<?php
				}
			}
		}
		?></div><?php
	}


	function branditem($section){
		?><div id="cont"><?php
		$contents = file_get_contents('boardinfo.txt');
		$item = explode("\n", $contents);

		for($x=0; $x < sizeof($item); $x++){
			$single_item = explode(" ", $item[$x]);

			if($section == $single_item[0]){
				$name = $single_item[5];
			
				?>
				<div class="item">
				<a href='bh.php?section=<?=$single_item[4]?>'><input id="inputimg" type="image" src='<?=$single_item[1]?>' alt="product page"></a>
				<p>Deck: <?=$single_item[2]?></p>
				<p>Complete: <?=$single_item[3]?></p>
				<p id=deck_name><?=$single_item[4]?> <?=$single_item[5]?></p>
				</div>
				<?php
			}
		}
		?></div><?php
	}
?>
