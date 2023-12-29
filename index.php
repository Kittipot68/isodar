<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <style>
        @media only screen and (min-width: 768px) {
    .container {
        width: 50%;
        margin: 0 auto;
    }
}
    </style>

    <div  class="container p-5 form-floating ">
        <h3 class="mt-4">เข้าสู่ระบบ</h3>
        <hr style="width: max;">
        <form  class="form-floating" action="process_login.php" method="post">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <div class="form-floating mb-3">
                <input name="fname" type="text" class="form-control" id="floatingInput" placeholder="UserName">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <!-- <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input style="width:max;" type="text" class="form-control" name="fname" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input style="width:max;" type="password" class="form-control" name="password">
            </div> -->
            <button type="submit" name="signin" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form>

    </div>

</body>

</html>