<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(empty($spoj)){
        $spoj = new stdClass();
    }

    if (prazdnyVstup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=prazdnyVstup");
        exit();
    }
    if (zleUid($username) !== false) {
        header("location: ../signup.php?error=zleUid");
        exit();
    }
    if (zlyEmail($email) !== false) {
        header("location: ../signup.php?error=zlyEmail");
        exit();
    }
    if (pwdZhoda($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=heslasanezhoduju");
        exit();
    }
    if (uidExistuje($spoj, $username, $email) !== false) {
        header("location: ../signup.php?error=puzivatelexistuje");
        exit();
    }

    // Hash hesla pred uložením do databázy
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    vytvor($spoj, $name, $email, $username, $hashedPwd);
} else {
    header("location: ../signup.php");
    exit();
}
