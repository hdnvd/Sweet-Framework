<?php
require_once("class.phpmailer.php");

// Get real path for our folder
$rootPath = realpath('/home/sweetsof/public_html/Apps/SweetOne/SweetOneSites/Sweet');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('/home/sweetsof/public_html/Apps/SweetOne/SweetsoftirBackup.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();


$email = new PHPMailer();
$email->From      = 'webmaster@sweetsoft.ir';
$email->FromName  = 'Sweet Software Group';
$email->Subject   = 'sweetsoft.ir site Files Backup';
$email->Body      = "WebHost Backup is Here";
$email->AddAddress( 'nahavandi.hadi@gmail.com' );

$file_to_attach = '/home/sweetsof/public_html/Apps/SweetOne/SweetsoftirBackup.zip';

$email->AddAttachment( $file_to_attach , 'SweetsoftirBackup-Backup-941222.tar.bz2' );

if($email->Send()) 
$result="Mail Sent";
else
$result="Mail Failed";
echo $result;
?>
