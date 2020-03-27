<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-inputform.css">
    <title>Login</title>
</head>

<body>

    <div class="bg-image">
        <?php include './header.php' ?>
        <div class="form-input">
            <div class="div-relative">
                <form action="#" method="post" id="form-props">
                    <input class="texbox-styles" type="text" id="name" name="name" placeholder="Username">
                    <br>
                    <input class="texbox-styles" type="password" name="password" id="password" placeholder="Password">
                    <br>
                    <input type="submit" value="Login" class="button">
                    <a href="./reg_students_fom.php" class="button" id="sign-in-btn">sign up</a>
                </form>
            </div>

        </div>

    </div>



</body>

</html>