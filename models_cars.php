<?php require_once 'config.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">
		window.location.href = "index.php"; 
	</script>
<?php exit;}
?>

<?php require_once 'classes/car.class.php'; 
$car = new Car();
$brand_id =  filter_input(INPUT_POST, 'brand');


if(isset($brand_id) && !empty($brand_id)){
	
	$models['models'] = $car->getModelsForBrand($brand_id);
	echo json_encode($models);
}


