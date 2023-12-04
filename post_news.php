<?php @session_start();
include 'config/conf.php';
try {
  $sql = "SELECT * FROM new_type";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โพสต์ข่าวสาร</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="pubilc/css/style_card.css" rel="stylesheet">
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
</head>

<body>
    <?php 
    include('index.php');
    @$post = @$_GET['post'];
    if (@$post) { ?>
    <script>
    Swal.fire({
        title: 'โพสข่าวสารสำเร็จ',

        icon: 'success',

    });
    </script>
    <?php }?>
    <div class="container login">
        <div class="card"><br>
            <h2>โพสต์ข่าวสาร</h2>
            <div class="card-body">
                <form method="post" name="login-form" action="service/post_process.php">
                    <div class="card">
                        <div class="container"><br>
                            <label>ประเภทข่าวสาร</label>
                            <select class="form-control"  name="select">
                                <?php
                                if ($query->rowCount()>0) {
                                    $i = 1;
                                    while ($data = $query -> fetch(PDO::FETCH_OBJ)) {
                                ?>
                                <option><?=$data->new_type_name;?></option>
                                <?php }} ?>
                            </select>

                            <br>
                            <label>เนื้อหา:</label>
                            <textarea class="form-control" name="textarea" rows="4" required></textarea>
                            <input type="hidden"  name="name" value="<?php echo @$_SESSION['use_name']?>" />
                            <input type="hidden"  name="id_post" value="" />
                            <br>
                        </div>
                    </div>
                    <br>

                                    <div style="width:100%;text-align:center;">
                    <button type="submit" class="btn btn-success" aling="center">โพสต์</button>
                                    </dive>
                                    
                </form>
            </div>
        </div>
</body>

</html>