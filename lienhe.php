
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<button class="back2"><a href="index.php">Back</a></button>
<table style="margin-top:70px;width:380px;font-size: 20px;line-height: 2.0rem;"border="0"align="center"cellpadding="0"cellspacing="0">
	<tr>
		<td bgcolor="#cc0066">
		<?php
		$file=fopen("lienhe.txt","r",1);
		if(!$file){
			echo "<br> Khong the mo duoc file nay.<br>";
			exit;
		}else {
			echo "<p align='center' class='style1'><font color='#ffffff'";
			echo "<b></b><br>";
			while(!feof($file))
			{
				$noi_dung=fgets($file);
				echo nl2br($noi_dung);
			}
			
			echo "</font></p>";
		}
		fclose($file);
		?>
		</td>
	</tr>

</table>

</body>
</html>