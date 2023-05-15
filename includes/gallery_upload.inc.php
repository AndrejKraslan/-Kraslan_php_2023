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

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);#odstráni z názvu tú časť za bodkou. a vytvorý array rozdelenú podla bodky
    $fileActualExt = strtolower(end($fileExt));# Ak bude casť za bodkou CAP tak ju zmení na malé písmená
    #vytvorý array s povolenýmy koncovkamy
    $povolene = array("jpg", "jpeg", "png");
    #osledujeme ci je koncovka v array povolene
    if (in_array($fileActualExt, $povolene)) {#je právny typ súboru
        if ($fileError === 0) {
            if ($fileSize < 200000) {
                #vytvorý unikátny názov súboru aby sa v db nemohol prepísať (filename.id.extention);
                $imageFullName = $newFileName . "." . uniqid("", true) . $fileActualExt;
                $fileDestination = "../images/gallery/" . $imageFullName;
                # zistíme ci mozeme nahrat data do db

                include_once "dbGallery.inc.php";
                if(empty($spoj2)){
                    $spoj2 = new stdClass();

                }
                #Kontrola ci nejaká časť formulára je prázdna
                if (empty($imageTitle) || empty($imageDesc)) {
                    echo "Všetky polia formulára musia byť vyplnené!";
                    exit();
                } else {
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($spoj2);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL dotaz zlyhal";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, OrderGallery) VALUES (?,?,?,?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL dotaz zlyhal";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
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
