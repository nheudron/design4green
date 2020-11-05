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
							<img class="logo l3" src="images/logoPack1.jpg">
							<h3>Accès à l'information</h3>
							<p>Identifier des territoires mal couverts par une offre de service d'information ou des populations qui auront des difficultés à comprendre l'information.</p>
						</td>
						<td>
							<img class="logo l2" src="images/logoPack1.jpg">
							<h3>Capacité d'usage des interfaces numériques</h3>
							<p>Identifier des populations parmi lesquelles s'observe une fréquence d'illectronisme ou difficulté à utiliser internet.</p>
						</td>
					</tr>
					<tr>
						<td>
							<img class="logo l4" src="images/logoPack1.jpg">
							<h3>Accès aux interfaces numériques</h3>
							<p>Identifier des territoires mal couverts par les réseaux ou dans lesquels des populations auront des difficultés financières à y accéder.</p>
						</td>
						<td>
							<img class="logo l1" src="images/logoPack1.jpg">
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
						$i = 0;
						$codepostale = $_POST['postalcode'];
						$result2 = $db->prepare('SELECT * FROM lien_codes_postaux WHERE Code_postal = ?');
						$result2->execute(array($codepostale));
					
						if(isset($_POST['choixQuartier'])){
							
							$SQLville = $db->prepare('SELECT * FROM ville WHERE id LIKE ?');
							$SQLville->execute(array($_POST['choixQuartier']));	
							while ($data6 = $SQLville->fetch()){		
								$choixVille = $data6['iris_code'];			
							}
							echo "l'id du quartier sélectionné est : " . $_POST['choixQuartier']." et l'iris_code de la ville est ".$choixVille;
						}
						elseif(isset($_POST['choixVille'])){ ?>
							<?php $choixVille = $_POST['choixVille'];
							$choixVille .= '%';
							$SQLville = $db->prepare('SELECT * FROM ville WHERE iris_code LIKE ?');
							$SQLville->execute(array($choixVille));						

							if($SQLville->rowCount() > 1){
							 ?>
									<form action="" method="POST">
										<select name="choixQuartier" id="choixQuartier">
											<?php
											while ($data5 = $SQLville->fetch()){ ?>		
													<option value="<?php echo $data5['id']; ?>">
														<?php echo $data5['iris_name'];?>
													</option>
											<?php 
											}?>
										</select>
										<button>Selectionner</button>
									</form>
							<?php }else{
									
									printResults($SQLville);
								}
						}else{
							$i++;
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
							}elseif($i > 1){
								echo "Entrez un code postal valide.";
							}
						 }	
						$result2 -> closeCursor();
					
						function printResults($SQLville){
							while($data4 = $SQLville->fetch()){ ?>
								<?php if($data4['name'] == $data4['iris_name']){ ?>
										<p> <?php echo "La ville est : ".$data4['name']." identifiée par son iris_code : ".$data4['iris_code']?></p>
								<?php }else{ ?>
										<p> <?php echo "La ville est : ".$data4['name']." : ".$data4['iris_name']." identifiée par son iris_code : ".$data4['iris_code']?></p>
								<?php } 
							}
						}
					?>

					<h2>indices de votre ville</h2>
						<?php
						$SQLVille = $db->prepare('SELECT * FROM indices WHERE iris_code LIKE ?');
						$SQLVille->execute(array($choixVille));
						$dataVille = $SQLVille->fetch();

						echo "<p>Indice d'accès à l'information : " . $dataVille['ACCES_INFORMATION'] . "</p>";
						echo "<p>Indice d'accès aux interfaces numériques : " . $dataVille['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
						echo "<p>Indice de compétences administratives : " . $dataVille['COMPETENCES_ADMINISTRATIVES'] . "</p>";
						echo "<p>Indice de compétences numériques/scolaires : " . $dataVille['COMPETENCES_SCOLAIRES'] . "</p>";
						echo "<p><br>Indices d'Accès Global : " . $dataVille['GLOBAL_ACCES'] . "</p>";
						echo "<p>Indice de Compétence Global : " . $dataVille['GLOBAL_COMPETENCES'] . "</p>";
						echo "<p>SCORE GLOBAL : " . $dataVille['SCORE_GLOBAL'] . "</p>";
						?>
					<h2>indices zone départementale</h2>
						<?php
						$SQLdept = $db->prepare('SELECT * FROM departement WHERE iris_code LIKE ?');
						$SQLdept->execute(array($choixVille));
						$dataDept = $SQLdept->fetch();

						echo "<p>Indice d'accès à l'information : " . $dataDept['ACCES_INFORMATION'] . "</p>";
						echo "<p>Indice d'accès aux interfaces numériques : " . $dataDept['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
						echo "<p>Indice de compétences administratives : " . $dataDept['COMPETENCES_ADMINISTRATIVES'] . "</p>";
						echo "<p>Indice de compétences numériques/scolaires : " . $dataDept['COMPETENCES_SCOLAIRES'] . "</p>";
						echo "<p><br>Indices d'Accès Global : " . $dataDept['GLOBAL_ACCES'] . "</p>";
						echo "<p>Indice de Compétence Global : " . $dataDept['GLOBAL_COMPETENCES'] . "</p>";
						echo "<p>SCORE GLOBAL : " . $dataDept['SCORE_GLOBAL'] . "</p>";
						?>

					<h2>indices zone régionale</h2>
						<?php
						$SQLReg = $db->prepare('SELECT * FROM region WHERE iris_code LIKE ?');
						$SQLReg->execute(array($choixVille));
						$dataReg = $SQLReg->fetch();

						echo "<p>Indice d'accès à l'information : " . $dataReg['ACCES_INFORMATION'] . "</p>";
						echo "<p>Indice d'accès aux interfaces numériques : " . $dataReg['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
						echo "<p>Indice de compétences administratives : " . $dataReg['COMPETENCES_ADMINISTRATIVES'] . "</p>";
						echo "<p>Indice de compétences numériques/scolaires : " . $dataReg['COMPETENCES_SCOLAIRES'] . "</p>";
						echo "<p><br>Indices d'Accès Global : " . $dataReg['GLOBAL_ACCES'] . "</p>";
						echo "<p>Indice de Compétence Global : " . $dataReg['GLOBAL_COMPETENCES'] . "</p>";
						echo "<p>SCORE GLOBAL : " . $dataReg['SCORE_GLOBAL'] . "</p>";
						?>
				</div>
			</section>
		</main>
		<footer>
        	<p>© 2020 Équipe n°7 nommée NLN dans le cadre du Design4Green</p><p>&nbsp;&nbsp; - &nbsp;&nbsp; </p>
        	<p>Site hébergé sur un VPS par OVH.net</p> <p>&nbsp;&nbsp; - &nbsp;&nbsp;</p>
        	<p>Ce site ne collecte aucune donnée</p>
    	</footer>
	</body>
</html>