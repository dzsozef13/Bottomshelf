<?php

/*

*/
function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Console: " . $output . "' );</script>";
}