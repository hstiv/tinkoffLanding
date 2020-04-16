<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; ?>


<div class="container">
	<h1>Главная</h1>
		<div class="row">
<?php
	$arr = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data.txt'));
	for ($i = 0; $i < count($arr); $i++) { ?>
			<div class="col-md-4">
				<div class="card mb-4 shadow-sm">
				<img src="/files/<?=$arr[$i]['f_name']?>" style="width: 350px; height: 350px; size: cover">
					<div class="card-body">
						<p class="card-text"><?=$arr[$i]['name'].' - '.$arr[$i]['description']?></p>
						<div class="d-flex justify-content-between align-item-center">
							<div class="btn-group">
								<a href="/product_page/?id=<?=$i?>" class="btn btn-sm btn-outline-secondary">...</a>
								<button class="btn btn-sm btn-danger" id="deleteProduct">Удалить</button>
							</div>
							<small class="text-muted"><?=$arr[$i]['price']?>(RUB)</small>
						</div>
					</div>
				</div>
			</div>
	<?php }?>
		</div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>