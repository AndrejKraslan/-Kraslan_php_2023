<?php
session_start();
?>

<button onclick="location.href='index.php'">Domov</button>
<h2>Log In</h2>
<div>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Používatelské meno/Email">
        <input type="password" name="pwd" placeholder="Heslo">
        <button type="submit" name="submit">Log In</button>
    </form>
</div>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "zlylogin") {
        echo "<p>Doplňte všetky polia formuláru!</p>";
    } else if ($_GET["error"] == "zlylogin") {
        echo "<p>Nesprávne prihlasovacie informácie</p>";
    } else if ($_GET["error"] == "zleheslo") {
        echo "<p>Nesprávne heslo!</p>";
    } else {
        header("location: ../login.php");
        exit();
    }
}
?>
