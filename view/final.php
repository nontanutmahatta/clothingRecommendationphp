<?php
	require_once('./inc/functions.php');
	require_once('./controller/clotheController.php');

	$functions = new Functions();
	$fishController = new fishController();

	if(!isset($_GET['clothe_id'])){

		exit();
	}
	
	$fishPurchased = json_decode($fishController->getfish($_GET['clothe_id']));

	
	$fishController->buy($fishPurchased->id);

	
	$top3 = $functions->getRecommendation($fishPurchased);	

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="view/style.css">
	</head>
	<body>
		<h1 class="title">Purchase made</h1>

		<div id="final" class="container">
			<div class="clothe-card">
				<img src="<?=$fishPurchased->image ?>" alt="<?= $fishPurchased->name ?>" />
				<h5><?= $fishPurchased->name ?></h5>

				<div class="purchased-info">
					<p>Price - <?= $fishPurchased->price ?></p>
					<p>Origin - <?= $fishPurchased->origin ?></p>
					<p>Type - <?= $fishPurchased->type ?></p>
				</div>
			</div>

			<p>The item <strong><?= $fishPurchased->name ?></strong> has been added to your shopping list.</p>
			<a href="?p=home">Go back</a>					
		</div>

		<?php echo ($top3)? "<h2 class='title'>Complete your collection</h2>": '' ?>

		<div id="recommendation">
			<?php
			if ($top3) {

				foreach ($top3 as $fishRecommended) {
			?>
				<div class="clothe-card">
					<img src="<?=$fishRecommended->image ?>" alt="<?= $fishRecommended->name ?>" />
					<h5><?= $fishRecommended->name ?></h5>

					<div class="info">
						<p>Price - <?= $fishRecommended->price ?></p>
						<p>Origin - <?= $fishRecommended->origin ?></p>
						<p>Type - <?= $fishRecommended->type ?></p>
					</div>
					
					<?php
						if($functions->alreadyPurchased($fishRecommended->id)){
							echo "<p class='purchased'>Purchased</p>";
						}else{
							echo "<a href='?p=final&clothe_id=".$fishRecommended->id."'>Purchase</a>";
						}
					?>

				</div>
			<?php
				}
			}else{
				?>
				<h2 style="color: #000;">Few parts available for recommendation</h2>
				<?php
			}
			?>
		</div>

		<footer>
		</footer>
	</body>
</html>