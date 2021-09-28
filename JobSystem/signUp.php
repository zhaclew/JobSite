<?php
function getChar()
{

    // 生成随机中文名字
    $b = '';
    for ($i = 0; $i < 3; $i++) {
        // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
        $a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
        // 转码
        $b .= iconv('GB2312', 'UTF-8', $a);
    }
    return $b;
}

function signUp()
{

    // 1.连接数据库
    $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'jobsystem');

    if (!$conn) {
        exit('<h1>连接数据库失败</h1>');
    }

    // 2. 开始查询账号密码
    $user = mysqli_query($conn, "select Phone,Password from `user`;");

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
    $date = date('Y-m-t G-i-s');
    $type = $_POST['type'];
    $name = getChar();
    $enable = 1;

    // 4. 开始判断用户输入的账号，密码，验证码，身份是否正确

    // 账号检测
    if (empty($username)) {
        $GLOBALS['error_message'] = '请输入账号';
        return;
    }
    for ($i = 0; $i < count($value_Phone); $i++) {
        if ($username == $value_Phone[$i]) {
            $GLOBALS['error_message'] = '账号已注册';
            return;
        }
    }

    // 密码检测
    if (empty($password)) {
        $GLOBALS['error_message'] = '请输入密码';
        return;
    }
    if ($password == 0) {
        $GLOBALS['error_message'] = '请不要把密码设置成0';
        return;
    }
    // 验证码检测
    
    // if (empty($_REQUEST['authcode'])) {
    //     $GLOBALS['error_message'] = '请输入验证码';
    //     return;
    // }

    session_start();
    $_SESSION['authcode'] = 1234;
    if (strtolower($_REQUEST['authcode']) != $_SESSION['authcode']) {
        $GLOBALS['error_message'] = '验证码错误';
        return;
    }

    //检测身份是否有勾选
    if (!(isset($type) && $type !== '-1')) {
        $GLOBALS['error_message'] = '请选择自己的身份';
        return;
    }

    // 5. 开始向数据库插入数据
    $query = mysqli_query($conn, "insert into `user` (id,`name`,Phone,`Password`,Create_time,Type,`Enable`) values (null,'{$name}',{$username},{$password},'{$date}',{$type},{$enable}); ");

    if (!$query) {
        $GLOBALS['error_message'] = '注册失败';
        return;
    }

    $affected_rows = mysqli_affected_rows($conn);

    if ($affected_rows !== 1) {
        $GLOBALS['error_message'] = '请重新注册';
        return;
    }



    //释放查询结果集
    mysqli_free_result($user);
    //炸桥关闭连接
    mysqli_close($conn);
    // 一切成功开始跳转
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    signUp();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="box">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <input type="number" placeholder="请输入数字账号" name="username">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入数字密码" name="password">
                        </td>
                    </tr>
                    <tr class="code-tr">
                        <td>
                            <input type="text" name="authcode" placeholder="验证码">
                        </td>
                        <td>
                            <!-- <img src="./captcha.php?" id="captcha_img" border="1" onclick="codeFresh()" alt="" width="100" height="30"> -->
                            <div style="border: 1px #ccc solid;width: 80px;height: auto;text-align: center;">1234</div>
                        </td>
                    </tr>
                    <!-- <script type="text/javascript">
                        function codeFresh() {
                            document.getElementById("captcha_img").src = "./captcha.php?r=" + Math.random();
                        }
                    </script> -->
                    <tr>
                        <td>
                            <select name="type">
                                <option value="-1">请选择自己的身份</option>
                                <option value="1">企业用户</option>
                                <option value="2">求职者</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="sign">
                        <td><span>已有账号？</span><a class="zc" href="login.php">马上登录</a></td>
                    </tr>
                    <?php if (isset($GLOBALS['error_message'])) {
                        echo '<tr class="error-tr">';
                        echo '<td colspan="2">';
                        echo $GLOBALS['error_message'];
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="立即注册">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>