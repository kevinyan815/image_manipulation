<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$groundImagePath = './file/LargeFrame.png';
$groundImage = imagecreatefrompng($groundImagePath);//大框架图
$waterImagePath = './file/qrcode.jpg';
$waterImage = imagecreatefromjpeg($waterImagePath);//水印图

$dstX = 948;
$dstY = 1630;
$srcX = $srcY = 0;
$dstW = $dstH = 517;
list($srcW, $srcH) = getimagesize($waterImagePath);
//将水印图放入框架图中
imagecopyresampled($groundImage, $waterImage, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);

$textColor = imagecolorallocate($groundImage, 255, 255, 255);
$stationTitle = "联想3C服务中心(惠阳区 原惠阳市店)";
$stationCode = '13002905';

$fontFile = './file/microyahei.ttf';
$nameTextBox = imagettfbbox(50, 0, $fontFile, $stationTitle);
$imageWidth = imagesx($groundImage);
$StationNameCoordX = ($imageWidth - $nameTextBox[2]) / 2;//让文字居中对齐，计算第一个文字所在的X坐标
imagettftext($groundImage, 50, 0, $StationNameCoordX, 2600, $textColor, $fontFile, $stationTitle);
imagettftext($groundImage, 52, 0, 1159, 2870, $textColor, $fontFile, $stationCode);

$smallImg = imagecreate(1181, 1476);//小合成图
imagecopyresampled($smallImg, $groundImage, 0, 0, 0, 0, imagesx($smallImg), imagesy($smallImg), imagesx($groundImage), imagesy($groundImage));

//生成合成图
imagecreatetruecolor($groundImage, './bigPic.png');
imagepng($smallImg, './smallPic.png');

//释放图片资源
imagedestroy($groundImage);
imagedestroy($smallImg);

exit('Done');
