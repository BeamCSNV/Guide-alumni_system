<?php @session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .login {
        margin-top: 2.5rem;
        padding-bottom: 10rem;
    }

    .card {
        margin: 0rem 10rem;
    }

    h2 {
        margin-left: 2.5rem;
    }

    input {
        margin-bottom: 2.5rem;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php 
    include('index.php');
    @$login_error = @$_GET['login_error'];
    if (@$login_error) { ?>
    <script>
    Swal.fire({
        title: 'ข้อมูลไม่ถูกต้อง',
        text: 'กรุณาลองใหม่อีกครั้ง',
        icon: 'error',

    });
    </script>
    <?php }?>
    
    <div class="container login">
        <div class="card"><br>
            <h2>เข้าสู่ระบบ</h2>
            <div class="card-body">
                <form method="post" name="login-form" action="service/login_process.php">
                    <div class="card">
                        <div class="container"><br>
                            <label>อีเมล:</label>
                            <input type="email" class="form-control" value="admin@admin" required name="email">
                            <br>
                            <label>รหัสผ่าน:</label>
                            <input type="password" class="form-control" value="1234" required name="pass">
                            <br>
                        </div>
                    </div>
                    <br>


                    <div style="width:100%;text-align:center;">
                    <button type="submit" class="btn btn-success" aling="center">เข้าสู่ระบบ</button>
                    </div>
                    
                </form>
            </div>
        </div>
</body>
</html>