<button onclick="location.href='index.php'">Domov</button>
<h2>Sign Up</h2>
<form class="cl" action="includes/signup.inc.php" method="post">
    <input type="text" name="name" placeholder="Meno">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="uid" placeholder="Používateľské meno">
    <input type="password" name="pwd" placeholder="Heslo">
    <input type="password" name="pwdrepeat" placeholder="Potvrdenie hesla">
    <button type="submit" name="submit">Sign Up</button>
</form>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "prazdnyVstup") {
        echo "<p>Doplňte všetky polia formuláru!</p>";
    } else if ($_GET["error"] == "zleUid") {
        echo "<p>Vyberte správne užívateľské meno!</p>";
    } else if ($_GET["error"] == "zlyEmail") {
        echo "<p>Vyberte správny email!</p>";
    } else if ($_GET["error"] == "heslasanezhoduju") {
        echo "<p>Heslá sa nezhodujú!</p>";
    } else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Niečo sa pokazilo, skúste to prosím neskôr!</p>";
    } else if ($_GET["error"] == "puzivatelexistuje") {
        echo "<p>Užívateľské meno už existuje!</p>";
    } else if ($_GET["error"] == "none") {
        echo "<p>Úspešne ste sa zaregistrovali.</p>";
    }
}
?>
