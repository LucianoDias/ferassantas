<?php 
require_once 'config.php'; 
require_once 'classes/car.class.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">
		window.location.href = "index.php"; 
	</script>
<?php exit;}



if(isset($_GET['id']) && !empty($_GET['id'])){
	$photo = addslashes($_GET['id']);
	$car = new Car();
	$id_car = $car->deletePhoto($photo);
}
if(isset($id_car)){
	header("Location: edit_car.php?id=".$id_car);
}else{
	header("Location: my_cars.php");

}
