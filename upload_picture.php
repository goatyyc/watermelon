<?php
require_once 'saveToAssets.php';
require_once 'index.php';
$lists = ['葡萄','樱桃','橘子','柠檬','猕猴桃','西红柿','桃','菠萝','椰子','西瓜','大西瓜'];
$ls = ['a','b','c','d','e','f','g','h','i','j','k'];
// 上传图片
if(!empty($file = $_FILES)){
    // 图片校验:数量、格式
    foreach ($file as $f) {
        $result = picValidate($f);
        if (!$result) {
            exit('图片出错,请重试');
        }
    }


    $file = $_FILES;
    $time = time();
    make_dir($time);
    $upload_path = 'src\\'.$time.'\\';
    // 按顺序命名存放
    for($i=0; $i<sizeof($file); $i++){
        $f = $file[$i];
        $filename = $ls[$i].$f['name'];
        $new_file = $upload_path.$filename;
        move_uploaded_file($f['tmp_name'],$new_file);
    }

    sleep(1);
    // 调用返回下载
    toAssets($time);
    // 跳转回本页面
    header("Location:upload_picture.php");
}





// sizeof($lists)
?>
<body>
<div>
    <form action="" method="post" enctype="multipart/form-data" >
        <label>从上到下的图片分别对应从小到大：</label><br>
        <?php for($i=0; $i<sizeof($lists); $i++){ ?>
        <?php echo $lists[$i],":"?><input type="file" name=<?php echo $i?>
            ><br>
        <?php } ?>
        <input type="submit" value="提交">
    </form>
</div>

</body>
