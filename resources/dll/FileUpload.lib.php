<?php
function HandleIncommingFiles() {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if ( !isset($_FILES['files']['error']) || is_array($_FILES['files']['error']) ):
        return 'Invalid parameters.';
    endif;

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['files']['error']):
        case UPLOAD_ERR_OK:
            return false;
        case UPLOAD_ERR_NO_FILE:
            return 'No file sent.';
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return 'Exceeded filesize limit.';
        default:
            return 'Unknown errors.';
	endswitch;

    // You should also check filesize here. 
    if ($_FILES['files']['size'] > 1000000):
        return 'Exceeded filesize limit.';
    endif;

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search($finfo->file($_FILES['files']['tmp_name']), array( 'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif' ), true)):
        return 'Invalid file format.';
    endif;

    return false;  
};
?>