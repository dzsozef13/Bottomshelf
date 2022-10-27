<?php

/*

*/
function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('MESSAGE: " . $output . "' );</script>";
}

function console_error($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

        $key = array_search(__FUNCTION__, array_column(debug_backtrace(), 'function'));
        $source = debug_backtrace()[$key]['file'];

    echo "<script>console.error('WARNING: " . $output . " in " . $source . "' );</script>";
}