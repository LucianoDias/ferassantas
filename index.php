<?php
 require_once 'template/header.php';
 require_once 'classes/car.class.php'; 
$car = new Car();
$filtros = array('status' =>'','price' =>'');

$p = 1;
$perpages = 3;

$filtros = array('status' =>'','price' =>'');

 if(isset($_GET['filtros'])){
   $filtros = $_GET['filtros'];
 }
$totalcars = $car->getTotalCars($filtros);

if(isset($_GET['p']) && !empty($_GET['p'])){
   $p = addslashes($_GET['p']);
}
$total_pages =  ceil($totalcars / $perpages);
$salesforcars = $car->getSalesForCars($filtros,$p, $perpages);

?>

 
<div class="container-fluid">
     <div class="jumbotron jumbotron2">
   	  	<h3>Compre o Seu Carro Zero KM com Ofertas Imperdíveis. Acesse e Aproveite! O Melhor da Tecnologia, Design e Segurança Você Encontra Aqui.</h3><br>
         <p><mark>Temos <?php echo $totalcars;?> Carros a venda hojé</mark></p>
     </div>


    <div class="row">
   	  	<div class="col-sm-3"><h4>Pesquisa Avançada</h4>
            <form method="GET">
               <div class="form-group">
                  <label for="preco">Preço:</label>
                  <select name="filtros[price]" class="form-control" id="price">
                        <option></option>
                        <option value="10000-50000"<?php echo ($filtros['price']=='10000-50000') ? 'selected="selected"':'';?>>R$ 10.000 - 50.000</option>
                        <option value="55000-100000"<?php echo ($filtros['price']=='55000-100000') ? 'selected="selected"':'';?>>R$ 55.000 - 100.000</option>
                        <option value="110000-200000"<?php echo ($filtros['price']=='110000-200000') ? 'selected="selected"':'';?>>R$ 110.000 - 200.000</option>
                        <option value="250000-500000"<?php echo ($filtros['price']=='250000-500000') ? 'selected="selected"':'';?>>R$ 250.000 - 500.000</option>
                  </select>
               </div><br>
                <div class="form-gourp">
                  <input type="submit" value="filtrar" class="btn btn-info">
                </div>
            </form>
         </div>

   	  	<div class="col-sm-9"><h4>Ùltimos Anuncios</h4>
            <table class="table table-striped">
               <body>
                  <?php foreach($salesforcars as $item):?>
                        <tr>
                           <td>
                              <?php if(!empty($item['url'])): ?>
                              <img src="assets/images/cars/<?php echo $item['url'];?>" width="40">
                              <?php else: ?>
                              <img src="assets/images/cars/default.png"  width="40">
                              <?php endif ?>
                           </td>
                        <td>
                           <a href="sales_car.php?id=<?php echo $item['id_car'];?>"><?php echo $item['model_name'];?></a><br>
                        </td>
                        <td>Valor: R$<?php echo number_format($item['price'],3, ',', '.');?> </td>
                     </tr>
                  <?php endforeach; ?>
               </body>
            </table>
            <ul class="pagination">
               <?php for($q=1; $q <= $total_pages; $q++):?>
                  <li class="<?php echo ($p ==$q)? 'active':''; ?>"><a href="index.php?p=<?php echo $q;?>"><?php echo $q;?></a></li>
               <?php endfor;?>
            </ul>
             <br><br>
   	  	</div>
      </div>




<?php require_once 'template/footer.php';?>
