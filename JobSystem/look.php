<?php 
	include "view/header.html";

	   $enterprise = mysqli_query($conn,"select Logo,Name,Domain,Stage,Scale,address,detail from `enterprise` where id ={$_SESSION['id']};");

	    if (!$enterprise) {
	          exit('<h1>查询数据库失败</h1>');
	    }

	    $enterprise_valus = mysqli_fetch_assoc($enterprise);
?>

<!--招聘信息开始 -->
<div class="main-title">查看企业信息</div>
	<div class="zpfb main-content">
		<?php if (empty($enterprise_valus["Logo"])): ?>
				<img src="images/default.png" alt="">
		<?php endif; ?>
		<?php if (!empty($enterprise_valus["Logo"])): ?>
				<img src="<?php echo $enterprise_valus['Logo'];?>" alt="">
		<?php endif; ?>
		
		<p class="space">企业的名称：<?php echo $enterprise_valus['Name']; ?></p>
		<p class="space">企业的领域：<?php echo $enterprise_valus['Domain']; ?></p>
		<p>发展阶段：<?php echo $enterprise_valus['Stage']; ?></p>
		<p>企业的规模：<?php echo $enterprise_valus['Scale']; ?></p>
		<p>企业的地址：<?php echo $enterprise_valus['address']; ?></p>
		<p>公司详情：<?php echo $enterprise_valus["detail"]; ?></p>
	</div>
<!-- 招聘信息结束 -->

<?php 
include "view/footer.html";
?>