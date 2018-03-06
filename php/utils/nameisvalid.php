<?php
 function isvalid($str) {
    return !preg_match('/[^A-Za-z0-9]/', $str);
}
?>
