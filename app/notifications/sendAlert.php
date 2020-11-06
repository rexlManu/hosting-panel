<?php

/*
 * Sweetalert 2
 */

//function sendError($message, $title = 'Fehler'){
//    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "error" ); </script>';
//}
//
//function sendInfo($message, $title = 'Info'){
//    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "info"); </script>';
//}
//
//function sendSuccess($message, $title = 'Erfolgreich'){
//    return '<script> Swal.fire( "'.$title.'", "'.$message.'", "success"); </script>';
//}

/*
 * iziToast
 */

function sendError($message, $title = 'Fehler'){
    return "<script> iziToast.error({ title: '".$title."', message: '".$message."',  position: 'topRight' }); </script>";
}

function sendInfo($message, $title = 'Info'){
    return "<script> iziToast.info({ title: '".$title."', message: '".$message."',  position: 'topRight' }); </script>";
}

function sendSuccess($message, $title = 'Erfolgreich'){
    return "<script> iziToast.success({ title: '".$title."', message: '".$message."',  position: 'topRight' }); </script>";
}
