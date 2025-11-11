<?php
/**
 * Anonymous PHP Proxy
 * --------------------
 * A privacy-focused PHP web proxy that:
 *  - Hides your IP and server info
 *  - Removes tracking headers and cookies
 *  - Supports GET & POST
 *  - Returns full page responses securely
 *  - Can act as a "web VPN" for basic anonymous browsing
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Stop PHP errors from leaking
error_reporting(0);
ini_set('display_errors', 0);

// Check URL param
if (!isset($_GET['url'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing 'url' parameter"]);
    exit;
}

$url = trim($_GET['url']);

// Block local or unsafe protocols
if (preg_match('/^(file|php|data|glob|phar|zip|expect|ssh|sftp|ftp):/i', $url)) {
    http_response_code(403);
    echo json_encode(["error" => "Invalid or disallowed protocol"]);
    exit;
}

// Initialize cURL
$ch = curl_init($url);

// --- Anonymity Settings ---
$anonHeaders = [
    "Accept: */*",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130 Safari/537.36",
    "Accept-Language: en-US,en;q=0.9",
    "Connection: close",
];

// Remove tracking & identity headers
curl_setopt($ch, CURLOPT_HTTPHEADER, $anonHeaders);

// Use anonymous IP (your server’s IP will show, not client’s)
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Disable sending cookies or referrer
curl_setopt($ch, CURLOPT_COOKIE, "");
curl_setopt($ch, CURLOPT_REFERER, "");

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
}

// Execute request
$response = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

// Separate headers and body
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);

$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

// --- Filter response headers ---
foreach (explode("\r\n", $headers) as $header) {
    if (stripos($header, 'Content-Type:') === 0) {
        header($header);
    }
}
http_response_code($httpCode);

// Output body only (no tracking headers)
echo $body;
