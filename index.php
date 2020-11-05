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
		
		<!--
		<?php
		require('fpdf/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World!');
		$pdf->Output();
		?>
		-->

		
		<header id="header" class="header">
			<h1><a  href=""><span class="titreMobile">Indice de Fragilité Numérique</span><img src="" class="logoMobile"></a></h1>
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
							<img class="logo l1" src="images/logoPack1.png">
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
				</form>
			</section>
			<section class="blocks">
				<div>
					<?php
						$codepostale = $_POST['postalcode'];
						$result = $db->query('SELECT * FROM ville LIMIT 1;');
						if ($result->rowCount() > 0) {
							while ($data = $result->fetch()){ 
					?>
								<p> <?php echo $data['name']?></p>
							<?php }
						}else{
							echo "Pas de données dans la table";
						}
						$result->closeCursor();
					?>
					<?php
						$result2 = $db->prepare('SELECT * FROM lien_codes_postaux WHERE Code_postal = ?');
						$result2->execute(array($codepostale));
						while ($data2 = $result2->fetch()){ 
					?>
							<p> <?php echo $data2['Nom_commune']. ' ' . $data2['Ligne_5']?></p>
					<?php }
						$result2 ->closeCursor();
					?>
				</div>
				
			<h2>Aglomération</h2>
				<p>Indice d'accès à l'information epci 1</p>
				<p>Indice d'ACCÈS AUX INTERFACES NUMERIQUES epci 1</p>
				<p>COMPETENCES ADMINISTATIVES epci 1</p>
				<p>COMPÉTENCES NUMÉRIQUES / SCOLAIRES epci 1</p>
				<p>GLOBAL ACCES epci 1</p>
				<p>GLOBAL COMPETENCES epci 1</p>
				<p>SCORE GLOBAL epci 1</p>
			<h2>département</h2>
				<p>Indice d'aCCES à L'INFORMATION departement 1</p>
				<p>ACCÈS AUX INTERFACES NUMERIQUES departement 1</p>
				<p>COMPETENCES ADMINISTATIVES departement 1</p>
				<p>COMPÉTENCES NUMÉRIQUES / SCOLAIRES departement 1</p>
				<p>GLOBAL ACCES departement 1</p>
				<p>GLOBAL COMPETENCES  departement 1</p>
				<p>SCORE GLOBAL departement 1</p>
			
			<h2>Région</h2>
				<p>ACCES A L'INFORMATION region * </p>
				<p>ACCES A L'INFORMATION region 1 </p>
				<p>ACCÈS AUX INTERFACES NUMERIQUES region *</p>
				<p>ACCÈS AUX INTERFACES NUMERIQUES region 1</p>
				<p>COMPETENCES ADMINISTATIVES region * </p>
				<p>COMPETENCES ADMINISTATIVES region 1 </p>
				<p>COMPÉTENCES NUMÉRIQUES / SCOLAIRES region *  </p>
				<p>COMPÉTENCES NUMÉRIQUES / SCOLAIRES region 1  </p>
				<p>GLOBAL ACCES region *</p>
				<p>GLOBAL ACCES region 1</p>
				<p>GLOBAL COMPETENCES region *  </p>
				<p>GLOBAL COMPETENCES region 1  </p>
				<p>SCORE GLOBAL region 1 </p>
				<p>SCORE GLOBAL region * </p>
				
			</section>
		</main>
	</body>
</html>