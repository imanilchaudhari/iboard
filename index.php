<?php
ini_set( "display_errors", 0);
$default_board="1.html";

if (isset($_REQUEST['submit'])) {
	$form_board=$_POST['form-board'];
	$file_content=$_POST['filecontent'];
	$fh = fopen($form_board, 'w') or die("can't open file");
        fwrite($fh, $file_content);
        fclose($fh);
}
if(isset($_REQUEST['board'])) {
	$board=$_REQUEST['board'];
	$board.= ".html";
	if (file_exists($board)) {
		$FileContent = file_get_contents($board);
	}
	else {
		echo "<font color='red'>Selected Board couldn't be found. Default board has been loaded.</font>";
		$board=$default_board;
		$FileContent = file_get_contents($board);
	}
	//echo $FileContent;
} else {
	$board="1.html";
	$FileContent = file_get_contents($board);
}
?>


<html>
<head>
	<title>iBoard</title>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
<form name="openboard" action="" method="post">
<input type="hidden" name="form-board" value="<?php echo $board; ?>">
<table border=0 width=100% >
<tr>
	<td><input type="submit" value="Save" name="submit"></td>
	<td><a href="">Refresh</a></td>
	<?php
	for($i=1;$i<=5;$i++) {
	?>
	<td><a href="?board=<?php echo $i; ?>">
	<?php
	if($board=="$i.html") {
	?>
	<span style="background-color:orange;">Board <?php echo $i; ?></span>
	<?php
	} else {
	?>
		Board <?php echo $i; ?>
	<?php
	}
	?>
	</a></td>
	<?php
	}
	?>
	<td ><a href="?board=rich">Rich Text Board</a></td>
	<td align ="right"><a href="file-manager/index.php" target="_blank">Upload Files</a></td>
	<td align="right"><input type="submit" value="Save" name="submit"></td>

	<!-- <td>&nbsp;</td>
	<td>Private Board</td>
	<td>View:<input type="text" name="PrivateBoardName"><input type="button" value="View"></td>
	<td>Create:<input type="text" name="PrivateBoardName"><input type="button" value="Create"></td> -->

</tr>
<tr>
<td width=100%  colspan=9>
<textarea name="filecontent" id="filecontent" cols="150" rows="25">
<?php echo $FileContent; ?>
</textarea>
<?php if ($board=="rich.html") { ?>
<script type="text/javascript">
                                    CKEDITOR.replace( 'filecontent',{toolbar:[
					[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
					[ 'FontSize', 'TextColor', 'BGColor' ],['Source']

				]
,
                                        height:400,width:'99%'
                                    } );

</script>
<?php } ?>
</td>
</tr>
<tr>
	<td colspan=8>
		<input type="submit" value="Save" name="submit">
	</td>

	<!-- <td>&nbsp;</td>

	<td>Private Board</td>

	<td>View:<input type="text" name="PrivateBoardName"> <input type="button" value="View"></td>
	<td>Create:<input type="text" name="PrivateBoardName"> <input type="button" value="Create"></td> -->

</tr>
</table>
</form>
<p align="center">Developed by <a href="" target="_blank">iBoard</a></span>
<p align="center">Powered by <a href="" target="_blank">iBoard</a></span>
</body>
</html>