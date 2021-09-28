<?php 

       function login () {

        // 1.连接数据库
        $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'jobsystem');

        if (!$conn) {
         exit('<h1>连接数据库失败</h1>');
        }

        // 2. 开始查询账号密码
        $user = mysqli_query($conn,"select Phone,Password from `user`;");

        if (!$user) {
          exit('<h1>查询数据库失败</h1>');
        }

        // 3. 遍历数据库内的账号和密码并保存它们
        while ($users = mysqli_fetch_assoc($user)) {
            $value_Phone[] = $users['Phone'];
            $value_Password[] = $users['Password'];
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        // 4. 开始判断用户输入的账号，密码，验证码是否正确
        if (empty($username)) {
            $GLOBALS['error_message'] = '请输入账号'; 
            return;
        }
        if (empty($password)) {
            $GLOBALS['error_message'] = '请输入密码'; 
            return;
        }
        if (empty($_REQUEST['authcode'])) {
            $GLOBALS['error_message'] = '请输入验证码'; 
            return;
        }

        session_start();
        $_SESSION['authcode'] = 2525;
        if (strtolower($_REQUEST['authcode'])!=$_SESSION['authcode']) {
            $GLOBALS['error_message'] = '验证码错误'; 
            return;
        }




        for ($i=0; $i < count($value_Phone); $i++) { 
            if ($username == $value_Phone[$i] && $password == $value_Password[$i]) {
                //在这里拿到了正确的账号和秘密，再根据账号拿id
                $query_id = mysqli_query($conn,"select id from `user` where Phone =".$value_Phone[$i].";");
                $id =  mysqli_fetch_assoc($query_id);
                //把id存到cookie里面
                session_start();
                $_SESSION['id'] =  $id['id'];
               
                // 释放查询结果集
                mysqli_free_result($user);
                // 炸桥关闭连接
                mysqli_close($conn);
                // 一切成功跳转页面
                header('Location: showInfo.php');
                return;

            }else{
                $GLOBALS['error_message'] = '账号或者密码错误'; 
            }
        }  
    }
    


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        login();
    }
       
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登录</title>
  <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="请输入账号" name="username">
                        </td>
                        
                    </tr>
                   
                    <tr>
                        <td colspan="2">
                            <input type="password" placeholder="请输入密码" name="password">

                        </td>
                    </tr>
                    <tr class="code-tr">
                        <td> 
                            <input type="text" name="authcode" placeholder="验证码">
                        </td>
                        <td>
                            <!-- <img src="./captcha.php?" id="captcha_img" border="1"  onclick="codeFresh()" alt="" width="100" height="30"> -->
                            <div style="border: 1px #ccc solid;width: 80px;height: auto;text-align: center;">2525</div>
                        </td>
                    </tr>

                    <!-- <script type="text/javascript">
                        function codeFresh(){
                            document.getElementById("captcha_img").src = "./captcha.php?r="+Math.random();
                        }
                    </script>  -->
                    <?php
                        if(isset($GLOBALS['error_message'])){
                            echo '<tr class="error-tr">';
                            echo '<td colspan="2">';
                            echo $GLOBALS['error_message'];
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                    <tr class="tt">
                        <td >
                            <input type="checkbox" name="remember"  value="1">记住账号？
                        </td>
                    </tr>
                    <tr class="join"><td><span>没有账号？</span><a class="zc" href="signUp.php">立即注册</a></td></tr>       
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="登录">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>
</html>