<?php 
	include "view/header.html";
	
	$enterprise = $_SESSION['enterprise'];
		
	   $job = mysqli_query($conn,"select id,`Name`,Low_salary,High_salary,Address,Experience,Education,Is_parttime,Create_time,enterprise from `job` where enterprise = '{$enterprise}';");

	    if (!$job) {
	          exit('<h1>查询数据库失败</h1>');
	    }

	     // 遍历数据库内的信息并保存它们
        while ($job_valus = mysqli_fetch_assoc($job)) {
            $Name_arr[] = $job_valus['Name'];
            $Low_salary_arr[] = $job_valus['Low_salary'];
            $High_salary_arr[] = $job_valus['High_salary'];
            $Address_arr[] = $job_valus['Address'];
            $Experience_arr[] = $job_valus['Experience'];
            $Education_arr[] = $job_valus['Education'];
            $Is_parttime_arr[] = $job_valus['Is_parttime'];
            $Create_time_arr[] = $job_valus['Create_time'];
            $enterprise_arr[] = $job_valus['enterprise'];
        }

?>

<!--招聘信息开始 -->
<div class="main-title">查看已发布招聘</div>
	<div class="main-content LW-box">
		<?php for ($i=0; $i < count($enterprise_arr); $i++):?>
		<ul>
		<li>岗位：<?php echo $Name_arr[$i]; ?></li>
		<li>工资范围：<br><?php echo $Low_salary_arr[$i]; ?> ~ <?php echo $High_salary_arr[$i]; ?></li>
		<li>工作地点：<?php echo $Address_arr[$i]; ?></li>
		<li>经验要求：<?php echo $Experience_arr[$i]; ?></li>
		<li>学历要求：<?php echo $Education_arr[$i]; ?></li>
		<li>是否兼职：<?php echo $Is_parttime_arr[$i]==1?'兼职':'全职'; ?></li>
		<li>发布时间：<br><?php echo $Create_time_arr[$i]; ?></li>
		<li>发布企业：<?php echo $enterprise_arr[$i]; ?></li>
		</ul>
		<?php endfor;?>
	</div>
<!-- 招聘信息结束 -->

<?php 
include "view/footer.html";
?>