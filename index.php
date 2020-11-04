<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Indice de Fragilité Numérique</title>
		<link rel="stylesheet" href="index.css" />
		<link rel="icon" href="images/favicon.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	</head>
	<body>
		
		<header id="header" class="header">
			<h1><a  href="index.php"><span class="titreMobile">Fragilité Numérique</span><img src="" class="logoMobile"></a></h1>
			<!--<nav id="menu" class="menu">
				<ul id="navbar" class="navbar">
					<li><a href="buy.php">Buy</a></li><li><a href="rent.php" >Rent</a></li><li><a href="sale.php">Sale</a></li><li><a href="#contact" class="mediumScreen">Contact</a></li><li><a id="accountButton" href="#deroulant" class="account"><i class="fa fa-user-circle fa-2x"></i></a></li>
				</ul>
			</nav>-->
		</header>

		<main>

			<section class="blocks">
				<h1>Indice de Fragilité Numérique</h1>

				<p>Cet outil permet la visualisation d'indices de fragilité numérique territoire par territoire. La fragilité numérique est identifiée sur des critères liés à l'accès au numérique et sur le niveau de compétences de chacun et chacun.

				L'indice de fragilité numérique révèle les zones d'exclusion numérique sur un territoire donné. Cet outil permet, que vous soyez une commune, un département ou une région de comparer votre indice de fragilité numérique avec les autres territoires.</p>

				<h2>Les quatre indicateurs de fragilité</h2>

				<p>Les quatre indicateurs retenus permettent de créer une analyse globale s'appuyant sur l'accès d'une part (information, interfaces numériques) et sur les compétences d'autre part (utilisation d'une interface,compétences administratives).</p>

				<table>
					<tr>
						<td>
							<h3>Accès à l'information</h3>
							<p>Identifier des territoires mal couverts par une offre de service d'information ou des populations qui auront des difficultés à comprendre l'information.</p>
						</td>
						<td>
							<h3>Accès aux interfaces numériques</h3>
							<p>Identifier des territoires mal couverts par les réseaux ou dans lesquels des populations auront des difficultés financières à y accéder.</p>
						</td>
					</tr>
					<tr>
						<td>
							<h3>Capacité d'usage des interfaces numériques</h3>
							<p>Identifier des populations parmi lesquelles s'observe une fréquence d'illectronisme ou difficulté à utiliser internet.</p>
						</td>
						<td>
							<h3>Compétences administratives</h3>
							<p>Identifier des populations parmi lesquelles s'observent des difficultés à accomplir des procédures administratives.</p>
						</td>
					</tr>
				</table>

				<h2>La méthode d'analyse</h2>
				<p>Vous pouvez débuter par une analyse globale d'un territoire puis affiner pour vous concentrer sur les indicateurs liés à l'accès d'une part et ceux liés aux compétences d'autre part. Vous pouvez ensuite comparer des territoires (régions, départements, villes) en fonction de votre besoin.</p>
			</section>
			<section class="blocks">
				<h1>zone de recherche</h1>
				<form action="" method="post">
					<input type="number" name="postalcode" placeholder="49000">
					<button>Rechercher</button>
				</form>/
			</section>
			<section class="blocks">
				<h1>tableau de réponses</h1>
			</section>
		</main>
	</body>
</html>

<?php 
$servername = "146.59.196.29";
	$username = "debian";
	$password = "XpyJqyYagNDn";
	$dbname = "data";

	try {
		$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8',$username,$password);
	} catch (Exception $e) {
		die('Error : '.$e->getMessage());
	}
?>