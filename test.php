<?php
//
//function picValidate($f){
//    $filename = $f['name'];
//    if ($filename) {
//        $filename = $f['name'];
//        //文件类型的点最后一次出现的位置
//        $file_index = mb_strrpos($filename, '.');
//        //验证是不是图片
//        $is_img = getimagesize($f["tmp_name"]);
//        if(!$is_img){
//            exit('不是图片');    //根据自己需要返回
//               }
//
//        //验证类型
//        $image_type = ['image/png','image/jpg','image/jpeg'];
//
//        if(!in_array($f['type'], $image_type)){
//            exit('文件类型只能为png、JPG格式图片');    //根据自己需要返回数据
//        }
//        //验证后缀
//        $postfix = ['.png','.jpg','.jpeg'];
//        $file_postfix = strtolower(mb_substr($filename, $file_index));
//
//        if(!in_array($file_postfix, $postfix)){
//            exit('文件后缀只能是png，jpg，jpeg');    //根据自己需要返回数据
//        }
//
//        //文件大小限制200KB
//        if($f['size'] > 200*1024){
//            exit('图片过大');    //根据自己需要返回数据
//        }
//
//        return true;
//    }else{
//        return false;
//    }
//}
//
//if(!empty($files = $_FILES)){
////    var_dump($files);
//    foreach ($files as $f){
//        $result = picValidate($f);
//        if(!$result){
//            exit('图片出错');
//        }
//    }
//}
//
//?>
<!---->
<!--<body>-->
<!--<div>-->
<!--    <form action="" method="post" enctype="multipart/form-data" >-->
<!--        <label>从上到下的图片分别对应从小到大：</label><br>-->
<!--        --><?php //for($i=0; $i<3; $i++){ ?>
<!--            图片：<input type="file" name=--><?php //echo $i?>
<!--            ><br>-->
<!--        --><?php //} ?>
<!--        <input type="submit" value="提交">-->
<!--    </form>-->
<!--</div>-->
<!---->
<!--</body>-->
