<?php
 if ($handle = opendir('../../company/')) {
     $file = readdir($handle);
     echo "<li>$file</li>";
    $blacklist = array('.', '..', 'somedir', 'somefile.php');
    while (false !== ($file = readdir($handle))) {
//        echo "<li>$file</li>\n".is_dir(BASEPATH.$file.DIRECTORY_SEPARATOR);
//        if (!in_array($file, $blacklist)) {
//            if(is_dir(BASEPATH.$file.DIRECTORY_SEPARATOR)){
 //               echo "<li>$file xxxxx</li>\n";
//                    
//            }
//        }
    }
    closedir($handle);
}
?>