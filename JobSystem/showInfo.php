
<?php 
	include "view/header.html";

?>

<div class="main-title">个人信息</div>
<div class="main-content">

	<table>
		<tbody>
			<tr>
				<td>用户名：</td>
				<td><?php echo $user_valus["name"];?></td>
			</tr>
			<tr>
				<td>性别：</td>
				<td><?php echo $user_valus["Gender"]==1?'男':'女 ';?></td>
			</tr>
			<tr>
				<td>手机号码：</td>
				<td><?php echo $user_valus["Phone"];?></td>
			</tr>
			<tr>
				<td>身份信息：</td>
				<td><?php echo $user_valus["Type"]==1?'企业':'求职者';?></td>
			</tr>
			<tr>
				<td>个人简介：</td>
				<?php if (!isset($user_valus["txt"])): ?>
				<td><?php echo "这家伙太懒了什么都没留下...";?></td>
				<?php endif; ?>
				<?php if (isset($user_valus["txt"])): ?>
				<td><?php echo file_get_contents($user_valus["txt"]); ?></td>
				<?php endif; ?>
			</tr>
			<tr>
				<td>创建时间：</td>
				<td><?php echo $user_valus["Create_time"];?></td>
			</tr>
		</tbody>
	</table>
	
</div>

<?php 
include "view/footer.html";
?>