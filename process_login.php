<script src="https://code.jquery.com/jquery-3.6.1.js" ></script>

<?php 

    session_start();
    require_once 'M/connectDB.php';

    if (isset($_POST['signin'])) {
        $fname = $_POST['fname'];
        $password = $_POST['password'];

      
        if (empty($fname)) {
            $_SESSION['error'] = 'กรุณากรอก Username';
            header("location: index.php");
        }  else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: index.php");
        }else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE fname = :fname");
                $check_data->bindParam(":fname", $fname);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($fname == $row['fname']) {
                        if ($password == $row['password']) {
                            if ($row['role'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: V/admin_page.php");
                            } else if($row['role'] == 'user')  {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: C/alert_login.php");
                            } else if($row['role'] == 'super')  {
                                $_SESSION['superuser_login'] = $row['id'];
                                header("location: C/alert_login_superuser.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Username ผิด';
                        header("location: index.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: index.php");
                }

                 

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>