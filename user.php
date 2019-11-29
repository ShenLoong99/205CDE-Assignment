<?php 
    session_start();
    require_once 'component/db.php';
    $sql = "SELECT `name`, `email`, `username`, `phone`, `desc` FROM `user` WHERE `id` = ".$_SESSION["id"]."";
    $result = $con->query($sql);
    while($row = $result->fetch_object()){
        $_SESSION["name"] = $row->name;
        $_SESSION["email"] = $row->email;
        $_SESSION["username"] = $row->username;
        $_SESSION["phone"] = $row->phone;
        $_SESSION["desc"] = $row->desc;
    }
    $con->close(); // disconnect 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User</title>
        <?php include('component/head.php') ?>
        <style>
            .special {
                list-style: none;
            }
            
            .special li::before {
                content: "\2022";
                color: green;
                font-size: 20px;
                display: inline-block; 
                width: 1em;
                margin-left: -1em;
                pading: 0px;
            }
        </style>
    </head>
    <body>
        <?php include('component/login-navbar.php') ?>
        <div class="container p-2 path">
            <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> 
            <i class="fas fa-angle-double-right"></i> User
        </div>
        <div class="container d-block">
            <div class="row">
                <div class="p-3 col-8 bg-light ">
                    <span class="h3">
                        Logged in successfully.<br>
                        Hello <b><?php echo $_SESSION["username"] ?></b>. <br>
                        <a class="text-danger text-decoration-none" href="home.html">Click here</a> go visit our homepage. 
                        <a class="text-danger text-decoration-none" href="home.html">Mangakakalot.com</a><br><br>
                        <span>User Details:</span>
                        <table class="table table-sm table-bordered h5">
                            <tr>
                                <td width="30%">Name: </td>
                                <td><?php echo $_SESSION['name']; ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Username: </td>
                                <td><?php echo $_SESSION['username']; ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Email: </td>
                                <td><?php echo $_SESSION['email']; ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Phone number: </td>
                                <td><?php echo $_SESSION['phone']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Description: </td>
                            </tr>
                            <tr>
                                <td colspan="2"><p class="text-justify"><?php if (strlen($_SESSION['desc']) != 0) { echo $_SESSION['desc']; } else { echo 'Updating...'; } ?></p></td>
                            </tr>
                        </table>
                    </span>
                </div>
                <?php include('component/aside-login.php') ?>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
