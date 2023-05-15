<?php
include_once 'header.php';
?>


    <!-- MAIN POSTS -->
    <div class="main-posts">
    <div class="container">

<?php
if (isset($_SESSION["useruid"])) {
    echo "<p>Vitajte " . $_SESSION["useruid"] . "</p>";
}
?>

<?php
include_once 'includes/dbGallery.inc.php';

if(empty($spoj2)){
    $spoj2 = new stdClass();
}
$sql = "SELECT * FROM gallery ORDER BY idGallery DESC;";
$vys = mysqli_query($spoj2, $sql);
while ($row = mysqli_fetch_assoc($vys)) {
    echo '<div>
            <img src="images/gallery/' . $row['imgFullNameGallery'] . '" alt="' . $row['titleGallery'] . '">
            <h3>' . $row['titleGallery'] . '</h3>
            <p>' . $row['descGallery'] . '</p>
          </div>';
}
?>


<?php
include_once 'footer.php';
?>