<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; ?>


<div class="container">
	<h1>Главная</h1>
		<div class="row">
<?php
	$arr = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data.txt'));
	foreach ($arr as $product) { ?>
			<div class="col-md-4">
				<div class="card mb-4 shadow-sm">
				<img src="/files/<?=$product['f_name']?>" style="width: 350px; height: 350px; size: cover">
					<div class="card-body">
						<p class="card-text"><?=$product['name'].' - '.$product['description']?></p>
						<div class="d-flex justify-content-between align-item-center">
							<div class="btn-group">
								<button class="btn btn-sm btn-outline-secondary">Добавить</button>
								<button class="btn btn-sm btn-danger" id="deleteProduct">Удалить</button>
							</div>
							<small class="text-muted"><?=$product['price']?>(RUB)</small>
						</div>
					</div>
				</div>
			</div>
	<?php }?>
		</div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>