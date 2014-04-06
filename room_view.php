<?php session_start();$_SESSION['level']=5;?><!DOCTYPE html>
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
					<ul class="lista">
					<!-- Dinamikus tartalom kezdete: bemutatólista -->
					<?php foreach ($bemutatok as $bemutato) : ?>
						<li>
							<div class="fo">
								<div class="info">
									<h4><?php print $bemutato['id'].'-'.$bemutato['user']; echo '('.date("m/d H:i",$bemutato['date']).')';?></h4>
									<p class="kisbetu"><?php echo $bemutato['hsz']; ?></p>
									<p class="kisbetu">
										Küldve: <?php //echo date("m/d H:i",$bemutato['send_date']); ?>
									</p>
								</div>
							</div>
							<?php if ($_SESSION['level']>=3 && $_SESSION['level']>$bemutato['level'] || $_SESSION['level']==5): ?>
							<div class="funkciok">
								<ul>
									<li><a href="#">Megtekint</a></li>
									<li><a href="bemutato_szerkeszt.php?id=<?php echo $bemutato['id']; ?>">Szerkeszt</a></li>
									<li><a href="bemutato_torol.php?id=<?php echo $bemutato['id']; ?>">Töröl</a></li>
								</ul>
							</div>
							<?php endif; ?>
						</li>
					<?php endforeach;?>
					<!-- Dinamikus tartalom vége: bemutatólista -->
					</ul>
					<div class="separator"></div>
					<?php for($i=1;$i<count($pages);$i++) : ?>
						<a href="room.php?page=<?php print $pages[$i];?>"><?php print $pages[$i];?></a>
					<?php endfor;print $rowscount;?>
				</div>
			</div>
			<div class="separator"></div>
		</div>
		<footer></footer>
	</body>
</html>
