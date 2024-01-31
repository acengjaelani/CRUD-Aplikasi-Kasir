<?php
    @ob_start();
    session_start();
    if(isset($_POST['register'])){
        require 'config.php';
        
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);
        $id_member = strip_tags($_POST['id_member']);

        if(empty($user) || empty($pass)){
            echo '<script>alert("Semua field harus diisi");history.go(-1);</script>';
            exit();
        }

        $getLastIdQuery = 'SELECT MAX(id_member) AS max_id FROM login';
        $getLastIdStmt = $config->prepare($getLastIdQuery);
        $getLastIdStmt->execute();
        $lastIdRow = $getLastIdStmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $lastIdRow['max_id'];

        $newIdMember = $lastId + 1;

        $checkQuery = 'SELECT * FROM login WHERE user = ?';
        $checkStmt = $config->prepare($checkQuery);
        $checkStmt->execute(array($user));
        $rowCount = $checkStmt->rowCount();

        if($rowCount > 0){
            echo '<script>alert("Username sudah terdaftar");history.go(-1);</script>';
            exit();
        }

        $insertQuery = 'INSERT INTO login (user, pass, id_member) VALUES (?, ?, ?)';
        $insertStmt = $config->prepare($insertQuery);
        $insertStmt->execute(array($user, md5($pass), $newIdMember));

        echo '<script>alert("Pendaftaran berhasil");window.location="login.php"</script>';
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-success">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="h4 text-gray-900 mb-4"><b>Register Member</b></h4>
                            </div>
                            <form class="form-register" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="user" placeholder="Username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="pass" placeholder="Password">
                                </div>
                                <button class="btn btn-success btn-block" name="register" type="submit"><i class="fa fa-user-plus"></i> REGISTER</button>
                                <p class="paragraf-sign-up">Sudah punya akun? <a href="login.php">Login disini</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>
</html>