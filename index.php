<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Instagram</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>


	<div class="wrapper">
		<div class="container">
			<div class="content">
				<h2 class="title">Instagram foydalanuvchilarini ma'lumotlarinig olish</h2>
				<div class="navigation">
					<div class="logo">
					<img src="img/insta_logo.png" alt="Instagram Logo" width="150px" height="150px">
				</div>
				<div class="inputs">
					<form action="index.php" method="post">
						<input type="text" name="usename" placeholder="Instagram usernameni kiriting...." class="input_username">
					<input type="submit" name="submit" value="Ok" class="submit_ok">
					</form>
				</div>
			
			</div>

			<?php 
			// error_reporting (E_ALL ^ E_NOTICE);
			$username = $_POST['usename'];

			if(isset($_POST['submit'])){

				if(trim($username) == ''){
					echo "<h3 style='text-align: center; color: red; font-size: 30px;'>Usernameni kiriting</h3>";
				}
				else{
					$user = $username;
					$url = "https://www.instagram.com/".$user."/?__a=1";
					$file = @file_get_contents($url);
					if($file !== false){
						$json = json_decode($file, true);
					
					if($json !== null){
						$json = $json['graphql']['user'];
						$name = $json['full_name'];
						$username = $json['username'];
						$bio = $json['biography'];
						$count = $json['edge_followed_by']['count'];
						$follow = $json['edge_follow']['count'];
						$id = $json['id'];
					}}else{
						$user = $user.'NOT FOUND';
					}
				}
			
			
		}

	?>


		</div>
		<div class="result">
			<div class="result_block">
				<div class="navigation_result">
					<div class="username">
					<img src="https://img.icons8.com/fluency/48/000000/username.png"/>
					<h3 class="bio_par"><?=$username; ?></h3>
				</div>
			<div class="full_name">
				<img src="https://img.icons8.com/ios-filled/50/000000/name.png">
				<h3 class="bio_par"><?= $name; ?></h3>
			</div>
			<div class="follow">
				<img src="https://img.icons8.com/doodle/48/000000/follow--v1.png"/>
				<p class="bio_par"><?php echo number_format($follow);  ?></p>
			</div>
			<div class="followers">
				<img src="https://img.icons8.com/external-wanicon-flat-wanicon/64/000000/external-followers-influencer-marketing-wanicon-flat-wanicon.png"/>
				<p class="bio_par">Obunachilari: <?php echo number_format($count);  ?></p>
			</div>
			<div class="bio">
				<img src="https://img.icons8.com/external-becris-flat-becris/64/000000/external-biography-literary-genres-becris-flat-becris.png"/>
				<p class="bio_par"><?php echo mb_substr($bio, 0, 74, "UTF-8"); ?></p>
			</div>
			<div class="id">
				<img src="img/id.png" alt="" width="70px" height="70px">
				<span class="bio_par"><?= $id; ?></span>
			</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</body>
</html>