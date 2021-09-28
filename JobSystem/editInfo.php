<?php

	
	include "view/header.html";
		error_reporting(0);
	
		//获取更改后的默认值
		$name = $_POST['username'];
		$gender = $_POST['gender'];
		$intro = $_POST['intro'];
		$save = $_POST['save'];

		//根据默认值修改数据库内对应的数据

		if (isset($intro)) {
			$intro_path = "./data/".$_SESSION['id'].".txt";
			file_put_contents($intro_path, $intro);
			mysqli_query($conn,"update `user` set txt = '{$intro_path}' where id =".$_SESSION['id'].";");
		}
		
		if (isset($gender)) {
			mysqli_query($conn,"update `user` set Gender = {$gender} where id =".$_SESSION['id'].";");
		}	
		
		if (isset($name)) {
			mysqli_query($conn,"update `user` set name = '{$name}' where id =".$_SESSION['id'].";");
		}


		if (isset($save)) {
			header('Location: showInfo.php');
		}

		
?>

<div class="main-title">编辑信息</div>
<div class="main-content">
	<form action="" method="post">
		<table>
			<tr>
				<td>姓名：</td>
				<td><input type="text" name="username" value="<?php echo $user_valus["name"];?>"></td>
			</tr>
			<tr>
		 	 	<td>性别 : </td>
		 	 	<td>			        
			        <select name="gender">
				        <option value="1">男</option>
				        <option value="0">女</option>
			        </select>	  
			    </td>  	
		 	</tr>
		 		<td>个人简介：</td>
		 		<td>
		 			<textarea name="intro" cols="50" rows="10" placeholder="请填写自己的信息......">
		 				<?php echo file_get_contents($user_valus["txt"]); ?>
		 			</textarea>
		 		</td>
		 	</tr>
		</table>
		<button name="save" value="111">保存</button>
	</form>
	

</div>
<?php include "view/footer.html"; ?>
		