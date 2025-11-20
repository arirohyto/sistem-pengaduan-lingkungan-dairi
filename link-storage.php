<?php
$target = __DIR__ . '/storage/app/public';
$link   = __DIR__ . '/public/storage';

if (is_link($link) || file_exists($link)) {
    echo 'Link already exists: ' . $link;
    exit;
}

if (symlink($target, $link)) {
    echo 'Storage link created: ' . $link . ' -> ' . $target;
} else {
    echo 'Failed to create storage link';
}