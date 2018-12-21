<?php

if(isset($_FILES['avatar'])) {
  $avatar = $_FILES['avatar'];
  var_dump($avatar);
  $size = $avatar['size'];
  $type = $avatar['type'];
  $filename = $avatar['tmp_name'];
  $date = date('ymd');
  $dir = __DIR__.'/uploads/'.$date."-".$avatar['name'];
  if($size > 2000000 ) {
    echo 'The uploaded file exceeded the file size limit.';
  } elseif($type !== 'image/png') {
    echo 'The image file type is not allowed.';
  } else {
    move_uploaded_file($filename, $dir);
  }
};
