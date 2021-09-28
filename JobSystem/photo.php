<?php
	include "view/header.html";
	
	$photo=$_FILES['photo'];

	$photo_path="./uploads/".$_SESSION['id']."-".$photo['name'];
	

	if (isset($photo)) {
			move_uploaded_file($photo['tmp_name'], $photo_path);
			mysqli_query($conn,"update `user` set photo = '{$photo_path}' where id =".$_SESSION['id'].";");
			header('Location: photo.php');
		}	

	
?>



<div class="main-title">个人信息</div>
<div class="main-content">
	<table>
		<tr>
				<td>个人简介：</td>
				<?php if (!isset($user_valus["photo"])): ?>
				<td><img src="./images/default.png" alt="" style="width: 120px;"><br></td>
				<?php endif; ?>
				<?php if (isset($user_valus["photo"])): ?>
				<td><img src="<?php echo $user_valus["photo"];?>" alt="" style="width: 120px;"><br></td>
				<?php endif; ?>
		</tr>
	</table>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="photo" >
		<input type="submit" value="提交">
	</form>
</div>
		

<?php 
include "view/footer.html";
?>
