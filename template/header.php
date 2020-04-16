<?php
if (isset($_POST['upload']) &&
	isset($_POST['name']) &&
	isset($_POST['description']) &&
	isset($_POST['price']) &&
	isset($_FILES['file'])
) {
	$file = $_FILES['file'];
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActulaExt = strtolower(end($fileExt));

	$allowed = ['jpg', 'jpeg', 'png', 'pdf'];

	if (in_array($fileActulaExt, $allowed)) {
		if ($fileError === 0) {
			$fileNameNew = $fileExt[0] . "." . $fileActulaExt;
			(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/files')) ? mkdir($_SERVER['DOCUMENT_ROOT'] . '/files') : 0;
			$fileDestination = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $fileNameNew;
			move_uploaded_file($fileTmpName, $fileDestination);
			$file = $fileNameNew;
			$arr = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data.txt')) ?? [];
			$arr[] = ['name' => $_POST['name'], 'description' => $_POST['description'], 'price' => $_POST['price'], 'f_name' => $file];
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data.txt', serialize($arr));
		} else {
			throw new Exception('Ошибка при загрузке файла', 300);
		}
	} else {
		throw new Exception('Неверное расширение файла', 300);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Магазин</title>
	
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="menu">
		<div class="container">
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link <?=($_SERVER['REQUEST_URI'] == '/' ? 'active' : '')?>" href="/">Главная</a></li>
				<li class="nav-item"><a class="nav-link <?=($_SERVER['REQUEST_URI'] == '/about/' ? 'active' : '')?>" href="/about/">О нас</a></li>
				<?php if ($_SERVER['REQUEST_URI'] == '/') { ?>
					<li class="nav-item nav-link ml-auto" data-toggle="modal" data-target="#addProduct">Добавить продукт</li>
						<div class="modal fade" id="addProduct">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Добавление продукта</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        									<span aria-hidden="true">&times;</span>
        								</button>
        								<form action="" enctype="multipart/form-data" method="POST">
									</div>
									<div class="modal-body d-flex flex-column">
										<div class='preview'>
            								<img src="" id="img" width="100" height="100">
        								</div>
										<input class="mt-3" type="file" name="file" id="file" required>
										<span class="mr-auto mt-3 text-muted">Название:
											<input type="text" name="name" required>
										</span>
										<span class="mr-auto mt-3 text-muted">Описание:
											<input type="text" name="description" required>
										</span>
									</div>
									<div class="modal-footer">
											<span class="mr-auto text-muted">Цена(RUB):
												<input type="number" class="form-control form-control-sm" style="max-width:60px" min="1" name="price" value="1" required>
											</span>
											<div class="btn-group ml-auto mt-auto" style="height:30px">
												<button type="submit"  name="upload" class="btn btn-sm btn-success" id="btn_upload">Добавить</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function(){

    								$("#btn_upload").click(function(){

       								var fd = new FormData();
        								var files = $('#file')[0].files[0];
        								fd.append('file',files);

        								$.ajax({
            								url: '/upload.php',
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
						</div>
				<?php } ?>
			</ul>
		</div>
	</div>