<?php
// 自动上传部署

require_once './index.php';
require_once './pack_zip.php';

function toAsset($time)
{
    $sizes = [52, 80, 108, 119, 152, 183, 193, 258, 308, 309, 408];

    $listName = ['ad16ccdc-975e-4393-ae7b-8ac79c3795f2.png',
        '0cbb3dbb-2a85-42a5-be21-9839611e5af7.png',
        'd0c676e4-0956-4a03-90af-fee028cfabe4.png',
        '74237057-2880-4e1f-8a78-6d8ef00a1f5f.png',
        '132ded82-3e39-4e2e-bc34-fc934870f84c.png',
        '03c33f55-5932-4ff7-896b-814ba3a8edb8.png',
        '665a0ec9-6c43-4858-974c-025514f2a0e7.png',
        '84bc9d40-83d0-480c-b46a-3ef59e603e14.png',
        '5fa0264d-acbf-4a7b-8923-c106ec3b9215.png',
        '564ba620-6a55-4cbe-a5a6-6fa3edd80151.png',
        '5035266c-8df3-4236-8d82-a375e97a0d9c.png'];
    $lists = array('ad', '0c', 'd0', '74', '13', '03', '66', '84', '5f', '56', '50');


    // 获取源文件 ===>>> 保存至对应目录
    $arr = get_file_list($time);
    $baseSrcPath = 'src\\' . $time . '\\';
//    $basePath = 'raw-assets\\';
    $basePath = 'melon/'.$time.'/res/raw-assets/';

    // 1、处理成对应尺寸的矩形
    for($i=0; $i<11; $i++){
        $img = resize_image($baseSrcPath.$arr[$i],$sizes[$i],$sizes[$i],'jpg');
        // 保存覆盖原图片
        imagepng($img,$baseSrcPath.$arr[$i]);
    }


    // 2、调用修改函数 => 遍历读取文件夹下图片进行修改成圆形png
    for($i=0; $i<11; $i++){
//        $path = $basePath.$lists[$i]."\\";
        $path = $basePath.$lists[$i]."/";
        $name = $listName[$i];
        $dest =  $path.$name;
        // 图片转换成圆形png ==>> 保存至新建的文件夹
        z_image2circle($baseSrcPath.$arr[$i], $dest);
    }

//    // 生成压缩包
//    $filename = $time;
//    create_zip($filename);
//    $zipname = 'zip/'.$filename.'.zip';
//    // 返回下载
//    ///Then download the zipped file.
//
//    header('Content-Type: application/zip');
//
//    header('Content-disposition: attachment; filename='.$zipname);
//
//    header('Content-Length: ' . filesize($zipname));
//
//    readfile($zipname);
}

/**
 * Notes: 读取文件目录下的文件名
 * User: yyc
 * Date: 2021/2/4
 * Time: 15:52
 * @param $time
 * @return array 文件名数组
 */
function get_file_list($time): array
{
    $arr = [];
    $path = 'src'.'\\'.$time;
    $handler = opendir($path);
    while (($filename = readdir($handler)) !== false){
        if($filename != '.' && $filename != '..'){
            array_push($arr, $filename);
        }
    }
    // 拼接字符串
    closedir($handler);
    return $arr;
}

