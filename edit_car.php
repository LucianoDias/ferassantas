<?php require_once 'template/header.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">window.location.href = "index.php"; </script>
<?php exit;} ?>
<div class="container">
<?php require_once 'classes/car.class.php'; 
$car = new Car();
$brands = $car->getBrands();

if(isset($_POST['year']) && !empty($_POST['year'])){
	$brand = addslashes($_POST['brand']);
	$model =  addslashes($_POST['model']);
	$price =  str_replace(['.',','],'', $_POST['price']);
	$description = $_POST['description'];
	$status = addslashes($_POST['status']);
	$year = addslashes($_POST['year']);


	if(isset($_FILES['photos'])){
		$photos = $_FILES['photos'];
	}else{$photos = array(); }
	

	$car->editarCar($brand,$model,$price,$description,$status, $year,$photos, $_GET['id']); ?>
	<div class="alert alert-success">Carro atualizando com sucesso!</div>
<?php 
}

if(isset($_GET['id']) && !empty($_GET['id'])){
	$info = $car->getCarForId($_GET['id']);

}else{ ?>
	<script type="text/javascript">window.location.href = "my_cars.php"; </script>
<?php
}


?>

	
	<fieldset><legend><h1> Editar <small>carro</small></h1></legend>
		<form  method="POST"  enctype="multipart/form-data">
			<div class="row">

				<div class="col-sm-3">
					<div class="form-group">
							<label for="brand">Marca</label>
							<select name="brand" id="brand" class="form-control brands">
								<option value="" selected="">Selecione  a marca</option>
							<?php foreach($brands as $brand): ?>
								<option value="<?php echo $brand['id_brand'];?>">
									<?php echo $brand['brand_name'];?>		
								</option>
							<?php endforeach;?>
							</select>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group">
							<label for="model">Modelo</label>
							<select name="model" id="model" class="form-control models">
								<option value="" selected="">Selecione  o modelo</option>
							</select>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
							<label for="brand">Ano</label>
							<input type="text" name="year" id="year" maxlength="4"value="<?php echo $info['year'];?>" class="form-control">
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group">
							<label for="brand">Preço</label>
							<input type="text" name="price" id="price"value="<?php echo $info['price'];?>" class="form-control">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
							<label for="brand">Descrição</label>
							<textarea name="description" id="description" maxlength="500" class="form-control"><?php echo $info['description'];?></textarea>
					</div>
				</div>

				<div class="col-sm-5">
					<div class="form-group">
							<label for="model">Combustível</label>
							<select name="status" id="status" class="form-control">
								<option value="1"<?php echo($info['status'] == 1)? 'selected="selected"':'';?>>Gasolina</option>
								<option value="2"<?php echo($info['status'] == 2)? 'selected="selected"':'';?>>Álcool</option>
								<option value="3"<?php echo($info['status'] == 3)? 'selected="selected"':'';?>>Total flex</option>
							</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
							<label for="photo">Foto do carro</label>
							<input type="file" name="photos[]" multiple class="form-control"><br>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="panel panel-default">
							<div class="panel-heading">Fotos do Carro</div>
							<div class="panel-body">
								<?php foreach($info['photos'] as $photo):?>
									<div class="photo_item">
										<img src="assets/images/cars/<?php echo $photo['url'];?>" border="0"  class="img-thumbail"><br>
										<a href="del_photo.php?id=<?php echo $photo['id_imagem'];?>" class="btn btn-default">excluir</a>
									</div>
								<?php endforeach;?>
							</div>
					</div>
			   </div>
			</div>
 
			  <div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<input type="submit" value="Salvar" class="btn btn-primary">
					</div>
				</div>

			</div>

		</form>
	</fieldset>
</div>
<script src="assets/js/ajax_add_car.js" type="text/javascript"></script>
<?php require_once 'template/footer.php'; ?>