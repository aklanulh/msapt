<?php

/**
 * MSAPT Laravel Application Entry Point
 * This handles both development server and production deployment
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// For development server - serve static files directly
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// For production - always redirect to public/index.php
require_once __DIR__.'/public/index.php';
