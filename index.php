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
		session_start();
		$servername = "localhost";
		$username = "debian";
		$password = "XpyJqyYagNDn";
		$dbname = "data";
		$i = 0;
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
				<p class="introduction">Cet outil permet la visualisation d'indices de fragilité numérique territoire par territoire. La fragilité numérique est identifiée sur des critères liés à l'accès au numérique et sur le niveau de compétences de chacun et chacun.

				L'indice de fragilité numérique révèle les zones d'exclusion numérique sur un territoire donné. Cet outil permet, que vous soyez une commune, un département ou une région de comparer votre indice de fragilité numérique avec les autres territoires.</p>

				<h2>Les 4 indicateurs de fragilité</h2>

				<p>Les quatre indicateurs retenus permettent de créer une analyse globale s'appuyant sur l'accès d'une part (information, interfaces numériques) et sur les compétences d'autre part (utilisation d'une interface,compétences administratives).</p>
				<section class="logos">
					<div>
						<img class="logo l3" src="images/logoPack1.jpg">
						<h3>Accès à l'information</h3>
						<p>Identifier des territoires mal couverts par une offre de service d'information ou des populations qui auront des difficultés à comprendre l'information.</p>
					</div>
					<div>
						<img class="logo l4" src="images/logoPack1.jpg">
						<h3>Accès aux interfaces numériques</h3>
						<p>Identifier des territoires mal couverts par les réseaux ou dans lesquels des populations auront des difficultés financières à y accéder.</p>
					</div>
					<div>
						<img class="logo l2" src="images/logoPack1.jpg">
						<h3>Capacité d'usage des interfaces numériques</h3>
						<p>Identifier des populations parmi lesquelles s'observe une fréquence d'illectronisme ou difficulté à utiliser internet.</p>
						
					</div>
					<div>
						<img class="logo l1" src="images/logoPack1.jpg">
						<h3>Compétences administratives</h3>
						<p>Identifier des populations parmi lesquelles s'observent des difficultés à accomplir des procédures administratives.</p>
					</div>
				</section>
			
				<h2>Accédez aux indices de fragilité numérique de votre ville</h2>
				<form action="" method="post">
					<center><label for="postalcode">Entrez le code postal de votre ville<br><hr width=300px></label><input type="number" name="postalcode" id="postalcode" placeholder="49000">
					<button>Rechercher</button></center>
				</form>
				<div>
					<?php
						$codepostale = $_POST['postalcode'];
						$result2 = $db->prepare('SELECT * FROM lien_codes_postaux WHERE Code_postal = ?');
						$result2->execute(array($codepostale));
					

						if(isset($_POST['choixVille'])){ ?>
							<?php $choixVille = $_POST['choixVille'];
							$choixVille .= '%';					

						}else{
							if ($result2->rowCount() >= 1) {?>
								<br><br>
								<form action="" method="POST">
									<center><label for="postalcode">Selectionnez votre ville<br><hr width=300px></label>
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
									<button>Selectionner</button></center><br>
								</form>
								
								<?php 
							}else{
								echo "<br><center>Entrez un code postal valide.</center>";
							}
						 }	
						$result2 -> closeCursor();
					if(isset($choixVille)){?>
					<section class="resultats">
						<div>
							<h3>indices de votre ville</h3>
							<?php
							$SQLVille = $db->prepare('SELECT * FROM indices WHERE iris_code LIKE ?');
							$SQLVille->execute(array($choixVille));
							$dataVille = $SQLVille->fetch();

							echo "<p>Accès à l'information : " . $dataVille['ACCES_INFORMATION'] . "</p>";
							echo "<p>Accès aux interfaces numériques : " . $dataVille['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
							echo "<p>Compétences administratives : " . $dataVille['COMPETENCES_ADMINISTRATIVES'] . "</p>";
							echo "<p>Compétences numériques/scolaires : " . $dataVille['COMPETENCES_SCOLAIRES'] . "</p>";
							echo "<p><br>Accès Global : " . $dataVille['GLOBAL_ACCES'] . "</p>";
							echo "<p>Compétence Global : " . $dataVille['GLOBAL_COMPETENCES'] . "</p>";
							echo "<p>SCORE GLOBAL : " . $dataVille['SCORE_GLOBAL'] . "</p>";
							$_SESSION["ACCES_INFORMATION_Ville"] =  $dataVille['ACCES_INFORMATION'];
							$_SESSION["ACCES_INTERFACES_NUMERIQUES_Ville"] =  $dataVille['ACCES_INTERFACES_NUMERIQUES'];
							$_SESSION["COMPETENCES_ADMINISTRATIVES_Ville"] =  $dataVille['COMPETENCES_ADMINISTRATIVES'];
							$_SESSION["COMPETENCES_SCOLAIRES_Ville"] =  $dataVille['COMPETENCES_SCOLAIRES'];
							$_SESSION["GLOBAL_ACCES_Ville"] =  $dataVille['GLOBAL_ACCES'];
							$_SESSION["GLOBAL_COMPETENCES_Ville"] =  $dataVille['GLOBAL_COMPETENCES'];
							$_SESSION["SCORE_GLOBAL_Ville"] =  $dataVille['SCORE_GLOBAL'];

							$_SESSION["ville"] = $dataVille['name'];
							?>
						</div>
						<div>
							<h3>Données départementales</h3>
							<?php
							$SQLdept = $db->prepare('SELECT * FROM departement WHERE iris_code LIKE ?');
							$SQLdept->execute(array($choixVille));
							$dataDept = $SQLdept->fetch();

							echo "<p>Accès à l'information : " . $dataDept['ACCES_INFORMATION'] . "</p>";
							echo "<p>Accès aux interfaces numériques : " . $dataDept['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
							echo "<p>Compétences administratives : " . $dataDept['COMPETENCES_ADMINISTRATIVES'] . "</p>";
							echo "<p>Compétences numériques/scolaires : " . $dataDept['COMPETENCES_SCOLAIRES'] . "</p>";
							echo "<p><br>Accès Global : " . $dataDept['GLOBAL_ACCES'] . "</p>";
							echo "<p>Compétence Global : " . $dataDept['GLOBAL_COMPETENCES'] . "</p>";
							echo "<p>SCORE GLOBAL : " . $dataDept['SCORE_GLOBAL'] . "</p>";
							$_SESSION["ACCES_INFORMATION_Dep"] =  $dataDept['ACCES_INFORMATION'];
							$_SESSION["ACCES_INTERFACES_NUMERIQUES_Dep"] =  $dataDept['ACCES_INTERFACES_NUMERIQUES'];
							$_SESSION["COMPETENCES_ADMINISTRATIVES_Dep"] =  $dataDept['COMPETENCES_ADMINISTRATIVES'];
							$_SESSION["COMPETENCES_SCOLAIRES_Dep"] =  $dataDept['COMPETENCES_SCOLAIRES'];
							$_SESSION["GLOBAL_ACCES_Dep"] =  $dataDept['GLOBAL_ACCES'];
							$_SESSION["GLOBAL_COMPETENCES_Dep"] =  $dataDept['GLOBAL_COMPETENCES'];
							$_SESSION["SCORE_GLOBAL_Dep"] =  $dataDept['SCORE_GLOBAL'];
							?>
						</div>
						<div>
							<h3>Données régionales</h3>
							<?php
							$SQLReg = $db->prepare('SELECT * FROM region WHERE iris_code LIKE ?');
							$SQLReg->execute(array($choixVille));
							$dataReg = $SQLReg->fetch();

							echo "<p>Accès à l'information : " . $dataReg['ACCES_INFORMATION'] . "</p>";
							echo "<p>Accès aux interfaces numériques : " . $dataReg['ACCES_INTERFACES_NUMERIQUES'] . "</p>";
							echo "<p>Compétences administratives : " . $dataReg['COMPETENCES_ADMINISTRATIVES'] . "</p>";
							echo "<p>Compétences numériques/scolaires : " . $dataReg['COMPETENCES_SCOLAIRES'] . "</p>";
							echo "<p><br>Accès Global : " . $dataReg['GLOBAL_ACCES'] . "</p>";
							echo "<p>Compétence Global : " . $dataReg['GLOBAL_COMPETENCES'] . "</p>";
							echo "<p>SCORE GLOBAL : " . $dataReg['SCORE_GLOBAL'] . "</p>";
							$_SESSION["ACCES_INFORMATION_Reg"] =  $dataReg['ACCES_INFORMATION'];
							$_SESSION["ACCES_INTERFACES_NUMERIQUES_Reg"] =  $dataReg['ACCES_INTERFACES_NUMERIQUES'];
							$_SESSION["COMPETENCES_ADMINISTRATIVES_Reg"] =  $dataReg['COMPETENCES_ADMINISTRATIVES'];
							$_SESSION["COMPETENCES_SCOLAIRES_Reg"] =  $dataReg['COMPETENCES_SCOLAIRES'];
							$_SESSION["GLOBAL_ACCES_Reg"] =  $dataReg['GLOBAL_ACCES'];
							$_SESSION["GLOBAL_COMPETENCES_Reg"] =  $dataReg['GLOBAL_COMPETENCES'];
							$_SESSION["SCORE_GLOBAL_Reg"] =  $dataReg['SCORE_GLOBAL'];
							?>
						</div>

						<p>Dans chaque catégorie, plus les valeurs des indices sont grandes, plus la précarité informatique de cette catégorie est importante. Pour information, si l'indice est en dessous de 100, vous pouvez estimer que le territoire a une faible fragilité numérique enregistrée. Au contraire, si l'indice est supérieure à 100, le territoire présente une certaine lacune numérique.</p>
					</section>
					
					<br>
					<center><a href="pdf.php" target="_blank"><button>Afficher et télécharger le PDF des résultats</button></a></center>
					<?php } ?>
				</div>
		</main>
		<footer>
        	<p>©2020-Design4Green Équipe NLN n°7</p>
        	<p>Site hébergé par OVH.net</p>
        	<p>Ce site ne collecte aucune donnée</p>
    	</footer>
	</body>
</html>