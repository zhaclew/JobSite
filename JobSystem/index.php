<?php 
    session_start();
    error_reporting(0);
    
    // 1.连接数据库
    $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'jobsystem');

    if (!$conn) {
     exit('<h1>连接数据库失败</h1>');
    }

    // 2. 开始获取所有企业用户id
    $user = mysqli_query($conn,"select id from `user` where Type = 1;");

    if (!$user) {
      exit('<h1>查询数据库失败</h1>');
    }
    while ($user_valus = mysqli_fetch_assoc($user)) {
             //把所有企业用户的id保存起来
             $enterprise_id[] = $user_valus['id'];
    }
      
    //根据id查找企业名称
    for ($i=0; $i < count($enterprise_id); $i++) { 
        //把所有企业名称保存起来
       $enterprise_query = mysqli_query($conn,"select Name from `enterprise` where id = ".$enterprise_id[$i].";");
       $enterprise_fetch = mysqli_fetch_assoc($enterprise_query);
       $enterprise_name[] = $enterprise_fetch['Name'];
    }
   

    //  开始获取所有岗位信息和id
    $job = mysqli_query($conn,"select id,`Name`,High_salary from `job`");

    if (!$job) {
          exit('<h1>查询数据库失败</h1>');
    }

     // 遍历数据库内的信息并保存它们
    while ($job_valus = mysqli_fetch_assoc($job)) {
        $Name_arr[] = $job_valus['Name'];
        $job_id_arr[] = $job_valus['id'];
        $High_salary_arr[] = $job_valus['High_salary'];
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
    <div class="jobs">
        <div class="occupation">
        	<h3 class="box-title">热招职位</h3>
        	<div class="occupation-sort">
        		<span id="font-color-blue-bold">IT-互联网</span>
        		<span>金融</span>
        		<span>房地产·建筑</span>
        		<span>教育培训</span>
        		<span>娱乐传媒</span>
        		<span>医疗健康</span>
        		<span>法律咨询</span>
        		<span>供应链·物流</span>
        		<span>采购贸易</span>
        	</div>
        	<ul class="jobs-box">
                <?php for ($i=0; $i < count($job_id_arr); $i++) :?>
                <li title="最高工资：<?php echo $High_salary_arr[$i]?>"><a href="play.php?job=<?php echo $job_id_arr[$i]; ?>"><?php echo $Name_arr[$i]; ?></a></li>
                <?php endfor; ?>
        	</ul>
        </div>
        <div class="enterprise">
        	<h3 class="box-title">热门企业</h3>
        	<ul class="jobs-box">
                <?php for ($i=0; $i < count($enterprise_name); $i++):?>
        		<li><a href="play.php?enterprise=<?php echo $enterprise_id[$i]; ?>"><?php echo $enterprise_name[$i]?></a></li>
                <?php endfor; ?>
        	</ul>
        </div>
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