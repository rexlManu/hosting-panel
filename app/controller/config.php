<?php

$db_host = env('DB_HOST', 'localhost');
$db_name = env('DB_DATABASE');
$db_username = env('DB_USERNAME');
$db_password = env('DB_PASSWORD');

$siteName = env('APP_NAME');

$grecaptchaSiteKey = env('CAPTCHA_KEY');
$grecaptchaSecret = env('CAPTCHA_SECRET');

$url = env('APP_URL');
$cdnUrl = $url.env('CDN_URL');
$picUrl = $url.env('PIC_URL');
