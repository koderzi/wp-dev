<?php
echo "Installing xdebug...\n";
$xdebug = exec("pecl install xdebug", $xdebugArray, $xdebugCode);
if ($xdebugCode !== 0) {
    echo "\nError installing xdebug: $xdebug\n";
    exit(1);
}
if (preg_match('/zend_extension=([^"]+)/', $xdebug, $matches)) {
    $zend_extension = $matches[0];
    exec("echo '$zend_extension\nxdebug.mode = debug\nxdebug.start_with_request = yes' > /usr/local/etc/php/conf.d/xdebug.ini");
} else {
    echo "\nCould not find xdebug zend_extension path.\n\n";
    exit(1);
}
echo "\n";