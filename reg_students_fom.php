<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-reg-inputform.css">
    <title>Sign up</title>
</head>

<body>
    <div class="bg-image">
        <div class="header">
            <?php include './header.php' ?>
        </div>

        <div class="form-input">
            <div class="div-relative">
                <form action="./dbOperations/db_add_student.php" method="POST" id="form-props">
                    <label for="Full Name">Full Name:</label>
                    <input class="texbox-styles" type="text" name="fname" value="<?php if (isset($_GET['fname'])) {
                                                                                        echo $_GET['fname'];
                                                                                    }  ?>" style="background: <?php if (isset($_GET['error']) && $_GET['error'] === "nameexist") {
                                                                                                                    echo "red";
                                                                                                                }  ?>"
                        required>
                    <br>
                    <label for="Name with initials">Name with initials:</label>
                    <input class="texbox-styles" type="text" name="iname" value="<?php if (isset($_GET['iname'])) {
                                                                                        echo $_GET['iname'];
                                                                                    }  ?>" style=" background: <?php if (isset($_GET['error']) && $_GET['error'] === "nameexist") {
                                                                                                                    echo "red";
                                                                                                                }  ?>"
                        required>
                    <br>

                    <label for="Birthday">Birthday:</label>
                    <input class="texbox-styles" type="date" name="Birthday" value="<?php if (isset($_GET['Birthday'])) {
                                                                                        echo $_GET['Birthday'];
                                                                                    }  ?>" required>
                    <br>


                    <label for="NIC">NIC:</label>
                    <input class="texbox-styles" type="text" name="NIC" value="<?php if (isset($_GET['NIC'])) {
                                                                                    echo $_GET['NIC'];
                                                                                }  ?>" required>
                    <br>

                    <label for="email">Email</label>
                    <input class="texbox-styles" type="text" name="email" value="<?php if (isset($_GET['email'])) {
                                                                                        echo $_GET['email'];
                                                                                    }  ?>" required>
                    <span><?php if (isset($_GET['error']) && $_GET['error'] === "invalidemail") {
                                echo "<script>alert('wrong email')</script>";
                            } ?></span>
                    <br>

                    <label for="Password">Password:</label>
                    <input class="texbox-styles" type="password" name="Password" id="password" required>
                    <br>

                    <label for="rep-Password">Repeat Password:</label>
                    <input class="texbox-styles" type="password" name="rep-Password" id="rep-password" required>
                    <script src="./js/confirm-pw.js"></script>
                    <br>

                    <input type="submit" class="button" value="submit" name="submit">


                </form>

            </div>

        </div>

    </div>

</body>

</html>