<?php
    require_once "db.php";
    $sql = "SELECT id FROM urunler ORDER BY id DESC"; 
    $result = mysqli_query($conn, $sql);
?>
<HTML>
<HEAD>
<TITLE>List BLOB Images</TITLE>
</HEAD>
<BODY>
<?php
	while($row = mysqli_fetch_array($result)) {
	?>
		<img src="imageView.php?id=<?php echo $row["id"]; ?>" /><br/>
	
<?php		
	}
    mysqli_close($conn);
?>
</BODY>
</HTML>