<?php

// 压缩一个目录

/**
 * @param $path 文件夹路径
 * @param $zip zip 对象
 */
function addFileToZip($path, $zip)
{
    $handler = opendir($path); //打开当前文件夹由$path指定。

    while (($filename = readdir($handler)) !== false) {
        if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归

                addFileToZip($path . "/" . $filename, $zip);
            } else { //将文件加入zip对象
                $zip->addFile($path . "/" . $filename);
            }
        }
    }
    @closedir($path);
}


function create_zip($zipName){
    $zip = new ZipArchive();
//    $zipName = 'test.zip';
    $file = 'zip\\'.$zipName.'.zip';
    try {

        $zip->open($file, ZipArchive::CREATE);
        addFileToZip('raw-assets', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
        $zip->close(); //关闭处理的zip文件

    } catch (\Exception $exception) {
        return $exception->getMessage();
    }
}

