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
		<?php
		$servername = "localhost";
		$username = "debian";
		$password = "XpyJqyYagNDn";
		$dbname = "data";
		try {
			$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8',$username,$password);
		} catch (Exception $e) {
			die('Error : '.$e->getMessage());
		}
		?>
		
		<header id="header" class="header">
			<h1><a  href=""><span class="titreMobile">Indice de Fragilité Numérique</span><img src="" class="logoMobile"></a></h1>
		</header>

		<main>
			<section class="blocks">
				<p class="introduction">Cet outil permet la visualisation d'indices de fragilité numérique territoire par territoire. La fragilité numérique est identifiée sur des critères liés à l'accès au numérique et sur le niveau de compétences de chacun et chacun.

				L'indice de fragilité numérique révèle les zones d'exclusion numérique sur un territoire donné. Cet outil permet, que vous soyez une commune, un département ou une région de comparer votre indice de fragilité numérique avec les autres territoires.</p>

				<h3>Les 4 indicateurs de fragilité</h3>

				<p>Les quatre indicateurs retenus permettent de créer une analyse globale s'appuyant sur l'accès d'une part (information, interfaces numériques) et sur les compétences d'autre part (utilisation d'une interface,compétences administratives).</p>

				<table>
					<tr>
						<td>
							<img class="logo l3" src="images/logoPack1.png">
							<h3>Accès à l'information</h3>
							<p>Identifier des territoires mal couverts par une offre de service d'information ou des populations qui auront des difficultés à comprendre l'information.</p>
						</td>
						<td>
							<img class="logo l2" src="images/logoPack1.png">
							<h3>Capacité d'usage des interfaces numériques</h3>
							<p>Identifier des populations parmi lesquelles s'observe une fréquence d'illectronisme ou difficulté à utiliser internet.</p>
						</td>
					</tr>
					<tr>
						<td>
							<img class="logo l4" src="images/logoPack1.png">
							<h3>Accès aux interfaces numériques</h3>
							<p>Identifier des territoires mal couverts par les réseaux ou dans lesquels des populations auront des difficultés financières à y accéder.</p>
						</td>
						<td>
							<img class="logo l1" src="images/logoPack1.png">
							<h3>Compétences administratives</h3>
							<p>Identifier des populations parmi lesquelles s'observent des difficultés à accomplir des procédures administratives.</p>
						</td>
					</tr>
				</table>

			</section>
			<section class="blocks search">
				<h2>Accédez aux indices de fragilité numérique de votre ville</h2>
				<form action="" method="post">
					<label for="postalcode">Entrez le code postal de votre ville </label><input type="number" name="postalcode" id="postalcode" placeholder="49000">
					<button>Rechercher</button>
				</form>
			</section>
			<section class="blocks">
				<div>
					<?php
						$codepostale = $_POST['postalcode'];
						$result2 = $db->prepare('SELECT * FROM lien_codes_postaux WHERE Code_postal = ?');
						$result2->execute(array($codepostale));
					
						if(isset($_POST['choixVille'])){ ?>
							<?php $choixVille = $_POST['choixVille'];
							$choixVille .= '%';
							$SQLville = $db->prepare('SELECT * FROM ville WHERE iris_code LIKE ?');
							$SQLville->execute(array($choixVille));						
														
							while($data4 = $SQLville->fetch()){ ?>

								<?php if($data4['name'] == $data4['iris_name']){ ?>
											<p> <?php echo "La ville est : ".$data4['name']?></p>
								<?php }else{ ?>
										<p> <?php echo "La ville est : ".$data4['name']." : ".$data4['iris_name']?></p>
								<?php } 
							}												
						}else{
							if ($result2->rowCount() > 0) {?>
								<form action="" method="POST">
									<select name="choixVille" id="choixVille">
									<?php
									while ($data2 = $result2->fetch()){ ?>		
											<option value="<?php echo $data2['Code_commune_INSEE']; ?>">
												<?php if($data2['Ligne_5'] == ''){ 
														echo $data2['Nom_commune'];
													}else{
														echo $data2['Ligne_5'];
													}
												?>
											</option>
									<?php 
									}?>
									</select>
									<button>Selectionner</button>
								</form>
								<?php
							}else{
								echo "Entrez un code postal valide.";
							}
						}	
						$result2 ->closeCursor();
					
						 //traitement pour récupérer code INSEE et ajouter un reg ex pour la fin
					?>
				</div>
				
			<h2>département</h2>
				<p>Indice d'accès à l'information</p>
				<p>Indice d'accès aux interfaces numériques</p>
				<p>Indice de compétences administratives</p>
				<p>Indice de compétences numériques/scolaires</p>
				<p>Indices d'Accès Global</p>
				<p>Indice de Compétence Global</p>
				<p>SCORE GLOBAL</p>
			
			<h2>Région</h2>
				<p>Indice d'accès à l'information</p>
				<p>Indice d'accès aux interfaces numériques</p>
				<p>Indice de compétences administratives</p>
				<p>Indice de compétences numériques/scolaires</p>
				<p>Indices d'Accès Global</p>
				<p>Indice de Compétence Global</p>
				<p>SCORE GLOBAL</p>
				
			</section>
		</main>
	</body>
</html>