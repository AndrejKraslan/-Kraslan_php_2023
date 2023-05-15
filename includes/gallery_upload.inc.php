<?php
if (isset($_POST['submit'])) {

    $newFileName = $_POST['filename'];
    if (empty($_POST['filename'])) {
        $newFileName = 'gallery';
    } else {
        $newFileName = strtolower(str_replace(" ", "_", $newFileName));#upravý názov na malé znaky a medzery na _
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];

    $file = $_FILES['file']; // info o subore

    $fileName = $file["name"]; // orig. nazov
    $fileType = $file["type"]; // jpg...
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);#odstráni z názvu tú časť pred bodkou. a vytvorý pole rozdelene podla bodky
    $fileActualExt = strtolower(end($fileExt));# Ak bude cast za bodkou CAP tak ju zmení na malé písmená end(ziska poslednu cast z pola)
    $povolene = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $povolene)) {
        if ($fileError === 0) {
            if ($fileSize < 200000) {
                #vytvorý unikátny názov súboru aby sa v db nemohol prepísať (filename.id.extention);
                $imageFullName = $newFileName . "." . uniqid("", true) . $fileActualExt; // true = viac znakov
                $fileDestination = "../images/gallery/" . $imageFullName;

                include_once "dbGallery.inc.php";
                if(empty($spoj2)){
                    $spoj2 = new stdClass(); // zakladny objektovy typ

                }
                 if (empty($imageTitle) || empty($imageDesc)) {
                     echo "Všetky polia formulára musia byť vyplnené!";
                    exit();
                } else {
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($spoj2);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL dotaz zlyhal";
                    } else {


                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery) VALUES (?,?,?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL dotaz zlyhal";
                        } else {
                            mysqli_stmt_bind_param($stmt, "sss", $imageTitle, $imageDesc, $imageFullName);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);

                            header("Location: ../index.php?upload=success");
                        }

                    }
                }
            } else {
                echo "Súbor je príliš veľký";
                exit();
            }
        } else {
            echo "Nastala chyba";
            exit();
        }
    } else {
        echo "Nesprávny typ súboru";
        exit();
    }

}
