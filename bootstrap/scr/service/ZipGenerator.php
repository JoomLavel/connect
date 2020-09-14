<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 14.09.2020
 * Time: 23:01
 */

namespace App\Service;

use App\Service\FlxZipArchive;


class ZipGenerator
{
    public function zipDirectory(string $name, string $path)
    {
        $zipFile = new \PhpZip\ZipFile();
        try {
            $zipFile
                ->addDirRecursive($path)
                ->saveAsFile($name . '.zip');
            $allInfo = $zipFile->getAllInfo();
            $zipFile->close();
        } catch (\PhpZip\Exception\ZipException $e) {
            // handle exception
        } finally {
            $zipFile->close();
        }
        return $allInfo;
    }
}