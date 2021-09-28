<?php 
	include "view/header.html";

	$user_admin = mysqli_query($conn,"select `id`,`name`,Phone,Enable,Type from `user`");

	while ($admin_valus = mysqli_fetch_assoc($user_admin)) {
		$admin_id[] = $admin_valus['id'];
		$admin_Phone[] = $admin_valus['Phone'];
		$admin_name[] = $admin_valus['name'];
		$admin_Enable[] = $admin_valus['Enable'];
		$admin_Type[] = $admin_valus['Type'];
	}

	if (!empty($_GET['id'])) {
		$del_user = mysqli_query($conn,"delete from `user` where id = {$_GET['id']};");
		if (!$del_user) {
         exit('<h1>删除失败</h1>');
        }
        if ($_GET['type']!=2) {
        	$enterprise = mysqli_query($conn,"select `Name` from `enterprise` where id ={$_GET['id']};");
        	$enterprise_valus = mysqli_fetch_assoc($enterprise);

        	$job_id = mysqli_query($conn,"select `id` from `job` where enterprise = '{$enterprise_valus['Name']}';");
        	while ($job_valus = mysqli_fetch_assoc($job_id)) {
        		$job_del[] = $job_valus['id'];
        	}
        	for ($k=0; $k < count($job_del); $k++) { 
        		mysqli_query($conn,"delete from `job` where id = {$job_del[$k]};");
        	}
        	mysqli_query($conn,"delete from `enterprise` where id = {$_GET['id']};");

        }
        header('Location: admin.php');
	}

?>

<!--招聘信息开始 -->
<div class="main-title">管理网站账号</div>
	<div class="main-content">
		<ul class="admin">
			<?php for ($i=0; $i < count($admin_id); $i++):?>
			<li>
				<span>用户ID：<?php echo $admin_id[$i]; ?></span>
				<span>电话号码：<?php echo $admin_Phone[$i]; ?></span>
				<span>用户姓名：<?php echo $admin_name[$i]; ?></span>
				<span>账号状态：<?php echo $admin_Enable[$i]==1?'可用':'不可用'; ?></span>
				<a href="admin.php?id=<?php echo $admin_id[$i];?>&&type=<?php echo $admin_Type[$i]; ?>">删除该账号</a>
			</li>
			<?php endfor; ?>
		</ul>
	</div>
<!-- 招聘信息结束 -->

<?php 
include "view/footer.html";
?>