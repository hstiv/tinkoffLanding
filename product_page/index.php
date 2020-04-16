<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; ?>

<?php $arr = (unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data.txt')))[$_GET['id']]; ?>

<div class="container">
	<h1><?=$arr['name']?></h1>
	<div class="row">
		<div>
			<img src="/files/<?=$arr['f_name']?>" style="width: 250px; height: 250px;">
		</div>
		<div class="d-flex flex-column ml-5">
			<p>Цена: <?=$arr['price']?>(RUB)</p>
			<p>Описание: <?=$arr['description']?></p>
		</div>
	</div>
	<form class="row mt-5 justify-content-between align-item-center" style="max-width: 250px" method="post">
		<input class="form-control" style="max-width:100px" type="number" name="count" value="1" min="1" required>
		<button class="btn btn-sm btn-success" type="submit" id="btn_pay" name="pay">Оплатить</button>
		<script type="text/javascript">
								$(document).ready(function(){

    								$("#btn_pay").click(function(){

        								$.ajax({
            								url: 'https://oplata.tinkoff.ru/landing/develop/documentation/Init',
            								type: 'post',
            								data: fd,
            								contentType: false,
           								 	processData: false,

            								success: function(response){
                								if(response != 0){
                    								$("#img").attr("src",response); 
                    								$(".preview img").show();
                								}el								se{
                    								alert('Файл не загружен!');
                								}
            								},
        								});
    								});
								});
							</script>
		<input type="hidden" name="price" value="<?=$_GET['id']?>" required>
	</form>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>