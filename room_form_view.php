<?php session_start();$_SESSION['level']=4;?>
<!DOCTYPE html>
<html>
	<head>
		<title>fk zkk fzk</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link type="text/css" href="styles/dyss.css" rel="stylesheet" />
		<link type="text/css" href="styles/keplista.css" rel="stylesheet" />
	</head>
	<body>
		<header>
			<div>
				<h1><a href="#">hhhhhhhhgggggg</a></h1>
				<p><a href="#" class="button"><span>dfghkdtzjk etzj j </span></a></p>
			</div>
		</header>
		<div id="content">
			<aside>
				<nav>
					<ul>
						<li><a href="#">Bemutatóim</a></li>
						<li><a href="#">Profilom</a></li>
						<li><a href="#">Kilépés</a></li>
					</ul>
				</nav>
			</aside>
			<div id="main_content">
				<div id="inner_content">
					<h2>Bejelentkezés után tölteni kell! bemutatói</h2>
							<div class="fo">
								<div class="info">
								<form name="room_mesage" method="post" action="room_insert_msg.php">
								<textarea name="uzenet"></textarea><br>
								<input type="text" name="szid" value="<?php print $szid;?>"><br>
								<input type="submit" name="sub" value="Küldés">
								</form>
								</div>
							</div>
							<div class="funkciok">
							</div>
					<!-- Dinamikus tartalom vége: bemutatólista -->
					
					<div class="separator"></div>
				</div>
			</div>
			<div class="separator"></div>
		</div>
		<footer></footer>
	</body>
</html>
