<?php

function checkExtensionImage( $ext ) {
    $extImg = [
        'ai',
        'bmp',
        'gif',
        'ico',
        'jpeg',
        'jpg',
        'png',
        'ps',
        'psd',
        'svg',
        'tif',
        'tiff'
    ];

    if (in_array(strtolower($ext), $extImg)) return true;
    
    return false;
}

function getUrlFileUpload($ext, $str) {
    if (checkExtensionImage($ext)) return "upload/{$str}";

    return $str;
}

function getExtension($file) {
    $len = strlen($file);
    for ( $i = $len - 1; $i >= 0; $i-- ) {
        if ( $file[$i] == '.' ) {

            return substr($file, $i-$len+1);
        }
    }
}
