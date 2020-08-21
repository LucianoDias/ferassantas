<?php
 require_once 'template/header.php';
 require_once 'classes/car.class.php'; 
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id_car = addslashes($_GET['id']);
    $car = new Car();
    $info = $car->getCarForId($id_car);
    
}else{?>
  <script type="text/javascript">window.location.href = "index.php"; </script>
<?php 
}

?>

 
<div class="container-fluid">
    <div class="row">
   	  	<div class="col-sm-4">
          <div class="carousel slide" data-ride="carousel" id="meuCarousel">
            <div class="carousel-inner" role="listbox">
               <?php foreach($info['photos'] as $chave => $photo):?>
                  <div class="item <?= ($chave =='0')? 'active':''?>">
                     <img  src="assets/images/cars/<?= $photo['url'];?>"/>
                  </div>
               <?php endforeach;?>
            </div>
             <a class="left carousel-control" href="#meuCarousel" role="button" data-slide="prev"><span><</span></a>
              <a class="right carousel-control" href="#meuCarousel"  role="button" data-slide="next"><span>></span></a>
         </div>
          
        </div>
   	  	<div class="col-sm-8">
          <h1><strong>Marca:</strong><?=$info['brand'];?></h1>
          <h4><strong>Model:</strong> <?= $info['model'];?></h4>
          <p><strong>Descrição:</strong><?=$info['description'];?></p><br/><br/>
          <h3>R$ <?= number_format($info['price'], 2); ?></h3>
          <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Proposta</button>
        </div>
    </div>
</div>

<div id ="loginModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-tilte">Contato</h4>
         </div>
         <div class="modal-body">
            <div class="col-sm-6">
              <label>Nome:</label>
              <input type="text"  name="namecliente" id="namecliente" class="form-control"/><br>
            </div>
             <div class="col-sm-6">
                <label>Email:</label>
                <input type="email" name="emailcliente" id="emailcliente" class="form-control"/>
            </div>
            <div class="col-sm-12">
              <label>Mensagem::</label>
              <textarea name="msg"  id="msg" class="form-control"></textarea><br>
           </div>
         <div class="modal-footer">
             <button class="btn btn-danger" data-dismiss="modal">fechar</button>
             <button  id="send_button"  class="btn btn-success">Enviar</button>
         </div>
      </div>
   </div>
</div>


<script  type="text/javascript">
   $(document).ready(function(){
      $('#send_button').click(function(){
         var namecliente = $('#namecliente').val();
         var emailcliente = $('#emailcliente').val();
         var msg = $('#msg').val();
         if(namecliente !='' && emailcliente !=''){
            $.ajax({
               method: 'POST',
               url: 'send_email.php',
               data: {namecliente:namecliente, emailcliente:emailcliente, msg:msg},
               success:function(data){
                  if(data == "No"){
                     alert("Erro no  usúario");
                  }else{
                     $('#loginModal').hide();
                     window.location.href = "index.php";
                  }
               }
            });
         }else{
            alert("Ambos os campos é obrigatório");
         }
      });
   });
</script>





<?php require_once 'template/footer.php';?>
