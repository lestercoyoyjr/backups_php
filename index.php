<?php
    // path
    $bklac = "C:\\xampp\\htdocs\\backups_php\\";
    // db name
    $db_name = 'excel';
    // backup's name
    $fileName = $db_name."_".date("Ymd-His")."_BK.sql";
    // where we're going to save backup
    $location = $bklac.$fileName;

    echo "DB backup is started!".PHP_EOL; // PHP_EOL = php end of file
    $salida_sql = "C:\\xampp\\mysql\\bin\\mysqldump.exe -uroot ".$db_name." >".$location;
    exec($salida_sql);

    // Enter the name to creating zipped directory
    $zipcreated = $db_name."_".date("Ymd-His").".zip";
  
    // Create new zip class
    $zip = new ZipArchive();

    if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
      
        // Store the path into the variable
        $dir = opendir($bklac);
           
        while($salida_sql = readdir($dir)) {
            if(is_file($salida_sql)) {
                $zip -> addFile($salida_sql, $fileName);
            }
        }
        $zip ->close();
    }
    
    // // Create zip file
    // $zip = new ZipArchive();

    // $salida_zip = $db_name.'_'.date("Ymd-His").'.zip';

    // if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) {
    //     $zip->addFile($salida_sql);
    //     $zip->close();
    // }

    echo "DB backup is done!";

    // for zip file
    // echo "Creating a zip file".PHP_EOL;
    // exec("WinRAR a ".$salida_sql.".zip".$salida_sql);
    // echo "Zip file is created".PHP_EOL;

    // // delete sql file
    // //unlink($location);

    // echo "DB backup is done!";
    
?>