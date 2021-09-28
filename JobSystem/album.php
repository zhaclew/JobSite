<?php

	
	include "view/header.html";
		
		//开始绑定企业id
		mysqli_query($conn, "insert into `enterprise` (id) values ({$_SESSION['id']});");

        // 2. 开始获取账号内容
        $enterprise = mysqli_query($conn,"select Logo,Name,Domain,Stage,Scale,address,detail from `enterprise` where id ={$_SESSION['id']};");

        if (!$enterprise) {
          exit('<h1>查询数据库失败</h1>');
        }

        $enterprise_valus = mysqli_fetch_assoc($enterprise);
        $save = $_POST['save'];

		$_SESSION['enterprise'] = $enterprise_valus['Name'];

		//一切成功后跳转发布页面
		if (isset($save)) {
			
			//获取更改后的默认值

			$Name = $_POST['Name'];
			$Domain = $_POST['Domain'];
			$Stage = $_POST['Stage'];
			$Scale = $_POST['Scale'];
			$address = $_POST['address'];
			$detail = $_POST['detail'];
			

			//根据默认值修改数据库内对应的数据
			$Logo = $_FILES['Logo'];
			
			//更改logo
			if (!$Logo['size']==0) {
					$Logo_path="./logo/".$_SESSION['id']."-".$Logo['name'];
					move_uploaded_file($Logo['tmp_name'], $Logo_path);
					mysqli_query($conn,"update `enterprise` set Logo = '{$Logo_path}' where id =".$_SESSION['id'].";");
			}	

			//更改修改后的默认值
			if (!empty($Name)) {
				mysqli_query($conn,"update `enterprise` set Name = '{$Name}' where id =".$_SESSION['id'].";");
			}	
			
			if (!empty($Domain)) {
				mysqli_query($conn,"update `enterprise` set Domain = '{$Domain}' where id =".$_SESSION['id'].";");
			}	
			if (!empty($Stage)) {
				mysqli_query($conn,"update `enterprise` set Stage = '{$Stage}' where id =".$_SESSION['id'].";");
			}	
			if (!empty($Scale)) {
				mysqli_query($conn,"update `enterprise` set Scale = '{$Scale}' where id =".$_SESSION['id'].";");
			}	
			if (!empty($address)) {
				mysqli_query($conn,"update `enterprise` set address = '{$address}' where id =".$_SESSION['id'].";");
			}	
			if (!empty($detail)) {
				mysqli_query($conn,"update `enterprise` set detail = '{$detail}' where id =".$_SESSION['id'].";");
			}	

			header('Location: look.php');
		}

	
?>

<div class="main-title">编辑企业信息</div>
<div class="main-content">
	<form action="" method="post" enctype="multipart/form-data">

		<table>
			<tr>
				<td>企业的logo：</td>
				<?php if (!isset($enterprise_valus["Logo"])): ?>
				<td><img src="images/default.png" alt="" style="width: 60px;"><br></td>
				<?php endif; ?>
				<?php if (isset($enterprise_valus["Logo"])): ?>
				<td><img src="<?php echo $enterprise_valus["Logo"];?>" alt="" style="width: 60px;"><br></td>
				<?php endif; ?>	
				<td>上传企业logo: <input type="file" name="Logo"></td>
			</tr>

			<tr>
				<td>企业的名称：</td>
				<td><input type="text" name="Name" placeholder="<?php echo $enterprise_valus["Name"];?>"></td>
			</tr>
			<tr>
		 		<td>企业的领域：</td>
		 		<td>
		 			<input type="text" name="Domain"  placeholder="<?php echo $enterprise_valus["Domain"]; ?>">
		 				
		 		</td>
		 	</tr>
		 	<tr>
		 		<td>发展阶段:</td>
		 		<td>
		 			<input type="text" name="Stage"  placeholder="<?php echo $enterprise_valus["Stage"]; ?>">
		 				
		 			
		 		</td>
		 	</tr>
		 	<tr>
		 		<td>企业的规模:</td>
		 		<td>
		 			<input type="text" name="Scale"  placeholder="<?php echo $enterprise_valus["Scale"]; ?>">
		 				
		 			
		 		</td>
		 	</tr>
		 	<tr>
		 		<td>企业的地址:</td>
		 		<td>
		 			<input type="text" name="address"  placeholder="<?php echo $enterprise_valus["address"]; ?>	">
		 				
		 		</td>
		 	</tr>
		 	<tr>
		 		<td>公司详情:</td>
		 		<td>
		 			<textarea class="detail" name="detail" cols="50" rows="10">
		 				<?php echo $enterprise_valus["detail"]; ?>
		 			</textarea>
		 		</td>
		 	</tr>
		</table>
		<button name="save" value="111">保存</button>
	</form>
	

</div>
<?php include "view/footer.html"; ?>
		