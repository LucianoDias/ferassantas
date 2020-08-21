<?php 
require_once 'config.php'; 
require_once 'classes/car.class.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">
		window.location.href = "index.php"; 
	</script>
<?php exit;}



if(isset($_GET['id']) && !empty($_GET['id'])){
	$id_car = addslashes($_GET['id']);
	$car = new Car();
	$car->deleteCar($id_car);
}
header("Location: my_cars.php");
