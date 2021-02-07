<?php
function resize_image($filename, $newx, $newy, $ext)
{
    //根据后缀，由文件或 URL 创建一个新图象(内置函数)
    if($ext == "jpg" || $ext == "jpeg")
        $im = imagecreatefromjpeg($filename);
    elseif($ext == "png")
        $im = imagecreatefrompng($filename);
    elseif($ext == "gif")
        $im = imagecreatefromgif($filename);

    //获取当前待修改图片像素（内置函数）
    $x = imagesx($im);
    $y = imagesy($im);

    //新建一个真彩色图像(内置函数)
    $im2 = imagecreatetruecolor($newx, $newy);

    //重采样拷贝部分图像并调整大小(内置函数)
    imagecopyresampled($im2, $im, 0, 0, 0, 0, floor($newx), floor($newy), $x, $y);
    return $im2;
}



/*
 * @fun 图片转换成圆形png，传入源路径和转换后的路径，均用相对于当前程序文件的路径
 * @memo 对于非正方形的图片，以短边作为图片的直径
 * @param string $src 源路径
 * @param string $dst 转换后的路径
 * @return void
 * @call z_image2circle("circleimage.jpg", './circleimage-'.uniqid().'.png');
 */
function z_image2circle($src, $dst){

    //获取原图尺寸，并设置新图片的宽度和高度
    list($w, $h) = getimagesize($src);
    if( $w >= $h ){
        $w = $h;
    }else{
        $h = $w;
    }

    $oimgSrc = imagecreatefromstring(file_get_contents($src));
    $oimgDst = imagecreatetruecolor($w, $h);
//    $oimgDst = imagecreatetruecolor($size, $size);

    imagealphablending($oimgDst,false);
    $transparent = imagecolorallocatealpha($oimgDst, 0, 0, 0, 127);
    $r=$w/2;
    for($x=0;$x<$w;$x++){
        for($y=0;$y<$h;$y++){
            $c = imagecolorat($oimgSrc,$x,$y);
            $_x = $x - $w/2;
            $_y = $y - $h/2;
            if((($_x*$_x) + ($_y*$_y)) < ($r*$r)){
                imagesetpixel($oimgDst,$x,$y,$c);
            }else{
                imagesetpixel($oimgDst,$x,$y,$transparent);
            }
        }
    }
    // 修改图片尺寸

    imagesavealpha($oimgDst, true);
    imagepng($oimgDst, $dst);


    imagedestroy($oimgDst);
    imagedestroy($oimgSrc);
}

/**
 * Notes: 验证图片
 * User: yyc
 * Date: 2021/2/5
 * Time: 20:33
 * @param $f
 * @return bool
 */
function picValidate($f): bool
{
    $filename = $f['name'];
    if ($filename) {
        $filename = $f['name'];
        //文件类型的点最后一次出现的位置
        $file_index = mb_strrpos($filename, '.');
        //验证是不是图片
        $is_img = getimagesize($f["tmp_name"]);
        if(!$is_img){
            exit('不是图片');    //根据自己需要返回
        }

        //验证类型
        $image_type = ['image/jpg','image/jpeg'];

        if(!in_array($f['type'], $image_type)){
            exit('文件类型只能为JPG格式图片');    //根据自己需要返回数据
        }
        //验证后缀
        $postfix = ['.jpg','.jpeg'];
        $file_postfix = strtolower(mb_substr($filename, $file_index));

        if(!in_array($file_postfix, $postfix)){
            exit('文件后缀只能是jpg');    //根据自己需要返回数据
        }

        //文件大小限制2M
        if($f['size'] > 2000*1024){
            exit('图片过大');    //根据自己需要返回数据
        }

        return true;
    }else{
        return false;
    }
}

/**
 * Notes: 创建文件夹
 * User: yyc
 * Date: 2021/2/4
 * Time: 20:33
 * @param $name
 */
function make_dir($name){

    $dir = iconv("UTF-8", "GBK",$name);
    $dir = "src/".$dir;
    if(!file_exists($dir)){
        mkdir($dir,0777,true);
    }
}

//调用示例
//z_image2circle('1.jpg','circleimage-'.uniqid().'.png');
