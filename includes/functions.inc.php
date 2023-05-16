<?php
function prazdnyVstup($name, $email, $username, $pwd, $pwdRepeat)
{
    $vys = false;
    // ak je prazdny vstup;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $vys = true;// ak je prazdny;
    } else {
        $vys = false;
    }
    return $vys;
}

function zleUid($username)
{
    $vys = false;
    //ak sa uid nezhoduje s reg. výrazom mame chybu;
    if (!preg_match("/^[a-zA-Z0-9ľščťžýáíéô]*$/u", $username)) {
        $vys = true;
    } else {
        $vys = false;
    }
    return $vys;
}

function zlyEmail($email)
{
    $vys = false;
    // sleduje ci je email korektný;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $vys = true;
    } else {
        $vys = false;
    }
    return $vys;
}

function pwdZhoda($pwd, $pwdRepeat)
{
    $vys = false;
    if ($pwd !== $pwdRepeat) {
        $vys = true;
    } else {
        $vys = false;
    }
    return $vys;
}

function uidExistuje($spoj, $username, $email)
{
    // sleduje či uid alebo email už je v dB;
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($spoj);// inicializácia príkazového objektu;
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed"); # vráti na lokáciu v prípade nesprávneho zadania formuláru
        exit();# zastavý skript
    }
    // nastavia sa parametre pre vstupné premenné;
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    // výsledok dotazu sa uloží do $vysData
    $vysData = mysqli_stmt_get_result($stmt);
    // riadok z dotazu
    if ($row = mysqli_fetch_assoc($vysData)) {
        return $row;
    } else {
        $vys = false; // row neexistuje;
        mysqli_stmt_close($stmt);
        return $vys;
    }
}

function vytvor($spoj, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($spoj);// inicializácia príkazového objektu
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    // naviazanie hodnôt a vykonanie dotazu;
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../signup.php?error=none");
    exit();
}

function prazdnyVstupLogin($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        $vys = true;
    } else {
        $vys = false;
    }
     $vys;
}

function loginUser($spoj, $username, $pwd)
{      // ci existuje v dB ;
    $uidExistuje = uidExistuje($spoj, $username, $username); # Kôly sql dotazu $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    if ($uidExistuje == false) {
        header("location: ../login.php?error=zlylogin");
        exit();
    }
    $pwdHashed = $uidExistuje["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=zleheslo");
        exit();
    } else if ($checkPwd === true) {#sessions
        session_start();
        $_SESSION["userid"] = $uidExistuje["usersId"];
        $_SESSION["useruid"] = $uidExistuje["usersUid"];
        header("location: ../index.php");
        exit();
    }
}