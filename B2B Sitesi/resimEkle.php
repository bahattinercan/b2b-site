<!DOCTYPE html>
<html lang="tr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php
	if (count($_FILES) > 0) {
		if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			require_once "db.php";
			$imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
			$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

			$sql = "INSERT INTO urunler(imageType ,imageData)
			VALUES('{$imageProperties['mime']}', '{$imgData}')";
			$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
			if (isset($current_id)) {
				header("Location: listImages.php");
			}
		}
	}
	?>

	<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
		<label>Fiyat:</label><br />
		<input type="number">
		<br>
		<label>Yüklenecek Resim:</label><br>
		<input name="userImage" type="file" /> <br><br>
		<input type="submit" value="Kaydet" />
	</form>
</body>

</html>