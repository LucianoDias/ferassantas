<?php require_once 'template/header.php';
if(empty( $_SESSION['cLogin'])) { ?>
	<script type="text/javascript">
		window.location.href = "index.php"; 
	</script>
<?php exit;} ?>
<div class="container">
<?php require_once 'classes/car.class.php'; 
$car = new Car();
$brands = $car->getBrands();

if(isset($_POST['year']) && !empty($_POST['year'])){
	$brand = addslashes($_POST['brand']);
	$model =  addslashes($_POST['model']);
	$price =  str_replace([','],'', $_POST['price']);
	
	$description = $_POST['description'];
	$status = addslashes($_POST['status']);
	$year = addslashes($_POST['year']);
	$car->addCar($brand,$model,$price,$description,$status, $year); ?>
	<div class="alert alert-success">Carro adicionado com sucesso!</div>
<?php 
}

?>

	
	<fieldset><legend><h1> Adicionar <small>carro</small></h1></legend>
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
							<input type="text" name="year" id="year" maxlength="4" class="form-control">
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group">
							<label for="brand">Preço</label>
							<input type="text" name="price" id="price" class="form-control">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
							<label for="brand">Descrição</label>
							<textarea name="description" id="description" maxlength="500" class="form-control"></textarea>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
							<label for="model">Combustível</label>
							<select name="status" id="status" class="form-control">
								<option value="1">Gasolina</option>
								<option value="2">Álcool</option>
								<option value="3">Total flex</option>
							</select>
					</div>
				</div>
			</div>

			  <div class="row">
				<div class="col-sm-2">
					<div class="form-group">
						<input type="submit" value="Cadastrar" class="btn btn-primary">
					</div>
				</div>

			</div>

		</form>
	</fieldset>
</div>
<script src="assets/js/ajax_add_car.js" type="text/javascript"></script>
<?php require_once 'template/footer.php'; ?>