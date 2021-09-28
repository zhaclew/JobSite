<?php 
   
	    error_reporting(0);
	    // 连接数据库
		$conn = mysqli_connect('127.0.0.1', 'root', '123456', 'jobsystem');

		if (!$conn) {
		 exit('<h1>连接数据库失败</h1>');
		}
   		

    	if (isset($_GET['job'])) {
    		
		    // 根据岗位id拿到该岗位发布企业的所有信息
		    $job = mysqli_query($conn,"select `Name`,Low_salary,High_salary,Address,Experience,Education,Is_parttime,Create_time,enterprise from `job` where id ={$_GET['job']};");

		    if (!$job) {
		     exit('<h1>查询失败</h1>');
		    }

		  	$job_valus = mysqli_fetch_assoc($job);

		  	$id = mysqli_query($conn,"select `id` from `enterprise` where `Name` = '{$job_valus['enterprise']}';");
		  	$user_id = mysqli_fetch_assoc($id);
		  	$job_id = mysqli_query($conn,"select `Phone` from `user` where `id` = {$user_id['id']};");
		  	$job_Phone = mysqli_fetch_assoc($job_id); 
           
    	}

    	
    	if (isset($_GET['enterprise'])) {

		    // 根据企业id拿到该企业的所有信息
		    $enterprise = mysqli_query($conn,"select Logo,`Name`,Domain,Stage,Scale,address,detail from `enterprise` where id ={$_GET['enterprise']};");

		    if (!$enterprise) {
		     exit('<h1>查询失败</h1>');
		    }

		  	$enterprise_valus = mysqli_fetch_assoc($enterprise);
		  	$user_valus = mysqli_fetch_assoc($user);
		  	$id = mysqli_query($conn,"select `Phone` from `user` where id = {$_GET['enterprise']};");
		  	$user_Phone = mysqli_fetch_assoc($id);
    	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>人才招聘网</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/common.css">
</head>

<body>
    <!-- 导航栏 -->
    <nav>
        <ul>
            <li><a href="index.php">首页</a></li>
            <li><a href="#">职位</a></li>
            <li><a href="#">校园</a></li>
            <li><a href="#">公司</a></li>
            <li><a href="#">APP</a></li>
            <li><a href="#">咨询</a></li>
            <li><a href="showInfo.php">个人中心</a></li>
        </ul>
    </nav>
    <!-- 搜索框 -->
    <header id="container">
        <div class="search bar">
            <form>
                <input type="text" placeholder="请输入要搜索职位、公司" name="name" autocomplete="off" />
                <button type="submit"></button>
            </form>
        </div>
    </header>
    <!-- 招聘信息 -->
    <div class="jobs play">
    	<?php if (!empty($_GET['job'])):?>
		<ul>
			<li>要求岗位：<?php echo $job_valus['Name']; ?></li>
			<li>工资范围：<?php echo $job_valus['Low_salary']; ?> ~ <?php echo $job_valus['High_salary']; ?></li>
			<li>工作地点：<?php echo $job_valus['Address']; ?></li>
			<li>经验要求：<?php echo $job_valus['Experience']; ?></li>
			<li>学历要求：<?php echo $job_valus['Education']; ?></li>
			<li>工作要求：<?php echo $job_valus['Is_parttime']==1?'兼职':'全职'; ?></li>
			<li>发布时间：<?php echo $job_valus['Create_time']; ?></li>
			<li>联系电话：<?php echo $job_Phone['Phone']; ?></li>
			<li>发布企业：<?php echo $job_valus['enterprise']; ?></li>
		</ul>
		<?php endif; ?>
		<?php if (!empty($_GET['enterprise'])):?>
		<ul class="enterprise_img">
			<?php if (empty($enterprise_valus["Logo"])): ?>
					<li><img src="images/default.png" alt=""></li>
			<?php endif; ?>
			<?php if (!empty($enterprise_valus["Logo"])): ?>
					<li><img src="<?php echo $enterprise_valus['Logo'];?>" alt=""></li>
			<?php endif; ?>
			<li>企业的名称：<?php echo $enterprise_valus['Name']; ?></li>
			<li>企业的领域：<?php echo $enterprise_valus['Domain']; ?></li>
			<li>发展阶段：<?php echo $enterprise_valus['Stage']; ?></li>
			<li>企业的规模：<?php echo $enterprise_valus['Scale']; ?></li>
			<li>企业的地址：<?php echo $enterprise_valus['address']; ?></li>
			<li>公司详情：<?php echo $enterprise_valus["detail"]; ?></li>
			<li>联系电话：<?php echo $user_Phone['Phone']; ?></li>
		</ul>
		<?php endif; ?>
    </div>
    <!-- 底部信息 -->
    <footer class="banner-engine normal-header index-page">
        <div class="footer-banner">
            <div class="footer-bubble bubble-1"></div>
            <div class="footer-bubble bubble-2"></div>
            <div class="footer-bubble bubble-3"></div>
            <div class="footer-banner-text font-color-black"> 致力于打造最受欢迎的中国招聘网站 </div>
            <div class="footer-banner-button"> <a class=" font-color-blue" href="login.php">立即免费注册</a> </div>
        </div>
        <div class="footer">
            <div class="auto clearfix">
                <!-- footer主要-->
                <div class="five-superiority">
                    <ul class="five-superiority-list clearfix">
                        <li class="compensate_ico"> <a> <span>安全分享 保障安全</span> </a> </li>
                        <li class="retreat_ico"> <a> <span>资源齐全 互惠互助</span> </a> </li>
                        <li class="technology_ico"> <a> <span>7*24小时 服务支持</span> </a> </li>
                        <li class="prepare_ico"> <a> <span>权威认证 安全可信</span> </a> </li>
                    </ul>
                </div>
                <div class="footer-floor1">
                    <div class="footer-left">
                        <div class="company-box">
                            <h3>8888-8888888</h3>
                            <h4>周一至周日00：00-24：00</h4>
                            <a href="#">联系在线客服</a>
                        </div>
                    </div>
                    <div class="footer-list">
                        <ul>
                            <li class="flist-title">常见问题</li>
                            <li><a href="#">帮助中心</a></li>
                            <li><a href="#">注册教程</a></li>
                            <li><a href="#">登录教程</a></li>
                        </ul>
                        <ul>
                            <li class="flist-title">企业文化</li>
                            <li><a href="#">关于我们</a></li>
                            <li><a href="#">发展历程</a></li>
                            <li><a href="#">企业资质</a></li>
                        </ul>
                        <ul>
                            <li class="flist-title">商务合作</li>
                            <li><a href="#">账号注册</a></li>
                            <li><a href="#">投诉建议</a></li>
                            <li><a href="#" target="_blank">服务协议</a></li>
                        </ul>
                        <ul class="flist-4">
                            <li class="flist-title">招贤纳士</li>
                            <li><a href="#">免责申明</a></li>
                            <li><a href="#">使用条款</a></li>
                            <li><a href="#">联系我们</a></li>
                        </ul>
                        <div class="clear-float"></div>
                    </div>
                    <div class="footer-right"> <img src="images/ewm.png" width="134" height="134">
                        <p>浏览器扫描下载APP</p>
                    </div>
                    <div class="clear-float"></div>
                </div>
            </div>
            <div class="footer_bot">
                <div class="footer_copy">
                    <span style="color:#FFFFFF;">
                        <p>Copyright © 1998-2020 人才招聘网，All rights reserved. </p>
                    </span>
                    <span class="footer-img">
                        <a href="#">
                            <img src="images/aqlm.png"></img></a>
                        <a href="#">
                            <img src="images/ipckexin.png"></img></a>
                        <a href="#">
                            <img src="images/qg.png"></img></a>
                    </span>
                    </span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>