<?php 
class Car {

	// adidicionar carro
	public function addCar($brand,$model,$price,$description,$fuel, $year) {
		global $pdo;

		$sql = "INSERT INTO cars SET description =:dsc, year =:year, price =:price, brand_id =:brand, status =:fuel, model_id =:model";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":dsc", $description);
		$sql->bindValue(":year", $year);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":brand", $brand);
		$sql->bindValue(":fuel", $fuel);
		$sql->bindValue(":model", $model);
		$sql->execute();
	}

	// atualizar o carro
	public function editarCar($brand,$model,$price,$description,$status, $year,$photos, $id) {
		global $pdo;
        
		$sql = "UPDATE   cars SET description =:dsc, year =:year, price =:price, brand_id =:brand, status =:fuel, model_id =:model WHERE id_car =:id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":dsc", $description);
		$sql->bindValue(":year", $year);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":brand", $brand);
		$sql->bindValue(":fuel", $status);
		$sql->bindValue(":model", $model);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if(count($photos)>0){
			for($q=0;$q<count($photos['tmp_name']); $q++){
				$tipo = $photos['type'][$q];
				if(in_array($tipo,array('image/jpeg','image/png'))){
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($photos['tmp_name'][$q], 'assets/images/cars/'.$tmpname);
					list($width_orig, $height_orig) = getimagesize('assets/images/cars/'.$tmpname);
					$ratio = $width_orig/$height_orig;
					$width =500;
					$height =500;
					if($width/$height > $ratio){
						$width = $height *$ratio;
					}else{
						$height = $width/$ratio;
					}
					$img = imagecreatetruecolor($width, $height);
					if($tipo == 'image/jpeg'){
						$origi = imagecreatefromjpeg('assets/images/cars/'.$tmpname);
					}elseif($tipo == 'image/png'){
						$origi = imagecreatefrompng('assets/images/cars/'.$tmpname);
					}
					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
					imagejpeg($img, 'assets/images/cars/'.$tmpname,80);
					$sql = $pdo->prepare("INSERT INTO cars_imagens SET car_id =:car_id,
						url =:url");
					$sql->bindValue(":car_id",$id);
					$sql->bindValue(":url",$tmpname);
					$sql->execute();
				}
			}
		}
		
}
    
    // lista  os carros 
	public function getMycars($page,  $perpage) {
		global $pdo;
		$data = array();
		$offset = ($page -1) * $perpage;

		$sql = "SELECT cars.id_car,cars.description,cars.year,cars.price,cars.status,cars.brand_id,cars.model_id,
			brands.name as brand_name,
			models.name as model_name,
		(select img.url from cars_imagens as img where img.car_id = cars.id_car limit 1) as url
		 FROM  cars
		 INNER JOIN brands ON brands.id_brand = cars.brand_id
		 INNER JOIN models ON models.id_model = cars.model_id LIMIT $offset, $perpage";
		$sql = $pdo->query($sql);
		$sql->execute();

		if($sql->rowCount() > 0){
			$data = $sql->fetchAll();
		}
		return $data;
	}

	public function getSalesForCars($filtros, $page,  $perpage ) {
		global $pdo;
		$data = array();
		$filtrosstring = array('1=1');

		if(!empty($filtros['price'])){
			$filtrosstring[] = 'cars.price BETWEEN  :price1 AND :price2';
		}
		$offset = ($page -1) * $perpage;


		$sql = "SELECT cars.id_car,cars.description,cars.year,cars.price,cars.status,cars.brand_id,cars.model_id,
			brands.name as brand_name,
			models.name as model_name,
		(select img.url from cars_imagens as img where img.car_id = cars.id_car limit 1) as url
		 FROM  cars
		 INNER JOIN brands ON brands.id_brand = cars.brand_id
		 INNER JOIN models ON models.id_model = cars.model_id 
		 WHERE ".implode(' AND ',$filtrosstring)." LIMIT $offset, $perpage";
         $sql = $pdo->prepare($sql);

		 if(!empty($filtros['price'])){
		 	$price = explode('-', $filtros['price']);
		 	$sql->bindValue(":price1",$price[0]);
		 	$sql->bindValue(":price2",$price[1]);	
		}

		 $sql->execute();
	
		if($sql->rowCount() > 0){
			$data = $sql->fetchAll();
		}
		return $data;

	}


	// editar carro
	public function getCarForId($id_car) {
		global $pdo;
		$data = array();
		$sql = "SELECT cars.id_car, cars.description, cars.price, cars.status, cars.brand_id, 		cars.model_id
				,brands.name as brand, models.name as model  FROM cars
				INNER JOIN brands ON brands.id_brand = cars.brand_id
				INNER JOIN models ON models.id_model = cars.model_id
				WHERE cars.id_car  =:id_car";

		//$sql = "SELECT * FROM cars WHERE id_car =:id_car";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":id_car",$id_car);
		$sql->execute();

		if($sql->rowCount() > 0){
			$data = $sql->fetch();
			$data['photos'] = array();

			$sql = $pdo->prepare("SELECT * FROM cars_imagens WHERE car_id =:id ");
			$sql->bindValue(":id",$id_car);
			$sql->execute();

			if($sql->rowCount() >0){
				$data['photos'] = $sql->fetchAll();
			}
		}
		return $data;

	}

	// Excluir carro
	public function deleteCar($id_car) {
		global $pdo;

		$sql = $pdo->prepare("DELETE FROM cars_imagens WHERE car_id =:id_car");
		$sql->bindValue(":id_car", $id_car);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM cars WHERE id_car =:id_car");
		$sql->bindValue(":id_car", $id_car);
		$sql->execute();
	}
    
    // listar todas as marcas de carros
	public function getBrands() {
		global $pdo;
		$data = array();
		$sql = "SELECT id_brand, name AS brand_name FROM brands";
		$sql = $pdo->query($sql);

		if($sql->rowCount() > 0){
			$data = $sql->fetchAll();
		}
		return $data;
	}

	// listar os modelos dos carros por id da marca
	public function getModelsForBrand($brand_id){
		global $pdo;
		$data = array();
		$sql = "SELECT id_model, name as model_name FROM models WHERE brand_id =:brand_id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":brand_id", $brand_id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
		}
		return $data;
	}


	// Excluir photo do carro
	public function deletePhoto($photo) {
		global $pdo;
       
        $sql = $pdo->prepare("SELECT car_id FROM cars_imagens WHERE id_imagem =:id_img");
		$sql->bindValue(":id_img", $photo);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$id_car = $row['car_id'];
		}

		$sql = $pdo->prepare("DELETE FROM cars_imagens WHERE id_imagem =:id_imagem");
		$sql->bindValue(":id_imagem",$photo);
		$sql->execute();

		return $id_car;
	}

	public function getTotalCars($filtros) {
		global $pdo;

        $filtrosstring = array('1=1');
		if(!empty($filtros['price'])){
			$filtrosstring[] = 'cars.price BETWEEN  :price1 AND :price2';
		}

		$sql = $pdo->prepare("SELECT count(*) as c FROM cars WHERE ".implode(' AND ', $filtrosstring));
		if(!empty($filtros['price'])){
		 	$price = explode('-', $filtros['price']);
		 	$sql->bindValue(":price1",$price[0]);
		 	$sql->bindValue(":price2",$price[1]);	
		}
		$sql->execute();
        $sql = $sql->fetch();
		$total = $sql['c'];
		return $total;
	}




}