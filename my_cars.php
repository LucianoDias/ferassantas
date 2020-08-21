<?php require_once 'template/header.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">
		window.location.href = "index.php"; 
	</script>
<?php exit;}
?>
<div class="container">
	<h1> Carros cadastrados </h1>
    <a href="add_car.php" class="btn btn-success">Adicionar Carro</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Ano</th>
				<th>Preço</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
<?php require_once 'classes/car.class.php'; 
$car = new Car();
$filtros = array('status' =>'','price' =>'');

$p = 1;
$perpages = 4;
$totalcars = $car->getTotalCars($filtros);
$total_pages =  ceil($totalcars / $perpages);

if(isset($_GET['p']) && !empty($_GET['p'])){
   $p = addslashes($_GET['p']);
}
$cars = $car->getMycars($p, $perpages);


foreach($cars as $item):?>
			<tr>
				<td>
					<?php if(!empty($item['url'])): ?>
					<img src="assets/images/cars/<?php echo $item['url'];?>" width="40">
					<?php else: ?>
					<img src="assets/images/cars/default.png"  width="40">
					<?php endif ?>
				</td>
				<td><?php echo $item['brand_name'];?></td>
				<td><?php echo $item['model_name'];?></td>
				<td><?php echo $item['year'];?></td>
				<td>R$<?php echo number_format($item['price'],3, ',', '.');?></td>
				<td>
					<a href="edit_car.php?id=<?php echo $item['id_car'];?>" class="btn btn-sm btn-default">Editar</a>
					<a href="excluir_car.php?id=<?php echo $item['id_car'];?>" class="btn btn-sm btn-danger">Excluir</a>
				</td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<ul class="pagination">
         <?php for($q=1; $q <= $total_pages; $q++):?>
               <li class="<?php echo ($p ==$q)? 'active':''; ?>"><a href="my_cars.php?p=<?php echo $q;?>"><?php echo $q;?></a></li>
         <?php endfor;?>
   </ul>
</div>





<?php require_once 'template/footer.php'; ?>
