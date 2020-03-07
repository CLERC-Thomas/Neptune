<?php

if(empty($_POST['facture'])){
    echo "Il n'existe pas de facture pour cette reservation<br>";
    echo "<a href='visualisation_admin.php'>
    <button>Retour</button></a>";
}else{
    $b64=$_POST['facture'];
# Decode the Base64 string, making sure that it contains only valid characters
    $bin = base64_decode($b64, true);

# Perform a basic validation to make sure that the result is a valid PDF file
# Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
# Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
    if (strpos($bin, '%PDF') !== 0) {
        throw new Exception('Missing the PDF file signature');
    }

# Write the PDF contents to a local file
    file_put_contents('file.pdf', $bin);

    header('Content-type: application/pdf');

// Il sera nommé downloaded.pdf
    header('Content-Disposition: inline; filename="facture.pdf"');//attachment

// Le source du PDF original.pdf
    readfile('file.pdf');
}
