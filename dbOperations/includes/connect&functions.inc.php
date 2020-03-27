<?php
function connect($dbhost, $dbname, $dbusername, $dbpassword)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //all it's doing is reporting all errors, while converting them to exceptions, using the mysqli_sql_exception class.
    try {
        $db = mysqli_connect(
            $dbhost,
            $dbusername,
            $dbpassword,
            $dbname
        );
        $db->set_charset("utf8mb4"); // Please do use set_charset("utf8") after establishing the connection if you want to avoid weird string issues.

    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Error connecting to database'); //Should be a message a typical user could understand
    }




    // if ($db->connect_error) {
    //     die("cannot connect to the database"
    //         . $db->connect_error . "\n" .
    //         $db->connect_errno);
    // } else {
    //     echo "connection successful with database" . $dbname;
    // } this also correct for error handling



    return $db;
}

function insertRecord(mysqli $db, array $record)
{


    // without prepared statements

    // $sql = "INSERT INTO student_details";
    // $sql .= "(fname,iname,birthday,NIC,PASSWORD,email)";
    // $sql .= " VALUES ";
    // $sql .= "(";
    // $sql .= "'" . $record['fname'] . "',";
    // $sql .= "'" . $record['iname'] . "',";
    // $sql .= "'" . $record['birthday'] . "',";
    // $sql .= "'" . $record['NIC'] . "',";
    // $sql .= "'" . $record['hash'] . "',";
    // $sql .= "'" . $record['email'] . "'";
    // $sql .= ")";


    // try {
    //     $result = $db->query($sql);
    //     if (!$result) {
    //         throw new Exception($meassage = "data has not been recorded");
    //     } else {
    //         echo '<script>alert("data has been recorded!");</script>';
    //         header("Location: ../reg_students_fom.php");
    //     }
    // } catch (Exception $e) {
    //     echo "<br>error" . $e->getMessage();
    // }

    // prepared statements

    $sql = "INSERT INTO student_details";
    $sql .= "(fname,iname,birthday,NIC,PASSWORD,email)";
    $sql .= " VALUES ";
    $sql .= "(";
    $sql .= "?,";
    $sql .= "?,";
    $sql .= "?,";
    $sql .= "?,";
    $sql .= "?,";
    $sql .= "?";
    $sql .= ")";
    // try {
    $stmt = $db->prepare($sql);
    $stmt->bind_param(
        'ssssss',
        $record['fname'],
        $record['iname'],
        $record['birthday'],
        $record['NIC'],
        $record['hash'],
        $record['email']
    );
    $stmt->execute();
    $stmt->close();
    header("Location: ../reg_students_fom.php");
    //     if (!$result) {
    //         throw new Exception($meassage = "data has not been recorded");
    //     } else {
    //         echo '<script>alert("data has been recorded!");</script>';
    //         header("Location: ../reg_students_fom.php");
    //     }
    // } catch (Exception $e) {
    //     echo "<br>error" . $e->getMessage();
    // }
}

function check(mysqli $database, $fname, $iname)
{
    $sql = "SELECT fname FROM student_details";
    $sql .= " WHERE ";
    $sql .= " fname=? OR iname=? ";

    $stmt = mysqli_stmt_init($database);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../reg_students_fom.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'ss', $fname, $iname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultcheck = mysqli_stmt_num_rows($stmt);
        if ($resultcheck > 0) {
            echo "name exist";
            return true;
            exit();
        }
    }
}