<?php 
	include "view/header.html";

			//获取用户填写的默认值
			$Name = $_POST['Name'];
			$Low_salary = $_POST['Low_salary'];
			$High_salary = $_POST['High_salary'];
			$Address = $_POST['Address'];
			$Experience = $_POST['Experience'];
			$Education = $_POST['Education'];
			$Is_parttime = $_POST['Is_parttime'];
			$Create_time = date('Y-m-t G:i:s');
			$enterprise = $_SESSION['enterprise'];
			$save = $_POST['save'];
			
			if (!empty($save)) {
				if (empty($Name)||empty($Low_salary)||empty($High_salary)||empty($Address)||empty($Experience)||empty($Education)||empty($Is_parttime)) {
				$GLOBALS['error_message'] = '<p style="color: red;">请把信息填完整</p>'; 
				retrun; 
				}
			}
			
		
			if (!empty($Name)&&!empty($Low_salary)&&!empty($High_salary)&&!empty($Address)&&!empty($Experience)&&!empty($Education)&&!empty($Is_parttime)) {
				$job_add = mysqli_query($conn, "insert into `job` (id,`Name`,Low_salary,High_salary,Address,Experience,Education,Is_parttime,Create_time,enterprise) values (null,'{$Name}',{$Low_salary},{$High_salary},'{$Address}','{$Experience}','{$Education}',{$Is_parttime},'{$Create_time}','{$enterprise}'); ");
				header('Location: lookWork.php');
			}

	    
?>

<div class="main-title">发布招聘信息</div>
<div class="main-content">
	<form action="" method="post">

		<table>
			<tr>
				<td>要求岗位：</td>
				<td><input type="text" name="Name"></td>
			</tr>

			<tr>
				<td>工资范围：</td>
				<td><input type="number" name="Low_salary" placeholder="最低薪酬"> - <input type="number" name="High_salary" placeholder="最高薪酬"></td>

			</tr>
			<tr>
		 		<td>工作地点：</td>
		 		<td><input type="text" name="Address"></td>
		 	</tr>
		 	<tr>
		 		<td>经验要求:</td>
		 		<td><input type="text" name="Experience"></td>
		 	</tr>
		 	<tr>
		 		<td>学历要求:</td>
		 		<td><input type="text" name="Education"></td>
		 	</tr>
		 	<tr>
		 		<td>是否兼职:</td>
		 		<td>
		 			<select name="Is_parttime" >
                                <option value="1">兼职</option>
                                <option value="2">全职</option>
                    </select>		
		 		</td>
		 	</tr>
		 	<?php if(isset($GLOBALS['error_message'])){ 
                echo '<tr class="error-tr red">' ; 
                echo '<td colspan="2">' ;
                echo $GLOBALS['error_message']; 
                echo '</td>' ; echo '</tr>' ; 
        	} ?>
		</table>
		
		<button name="save" value="111">保存</button>
	</form>
	

</div>
<?php include "view/footer.html"; ?>