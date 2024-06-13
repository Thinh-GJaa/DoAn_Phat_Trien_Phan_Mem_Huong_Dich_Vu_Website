<?php
// Start session
session_start();

/**
 * Define very basic constants
 * " Production": ẩn tât cả các lỗi để tránh làm phiền người khác
 */
define("ENVIRONMENT", "production"); // [development|production|installation]

/**
 * Check ENVIRONMENT
 */
error_reporting(E_ALL);
if (ENVIRONMENT == "installation") {
    header("Location: ./install");
    exit;
} else if (ENVIRONMENT == "development") {
    ini_set('display_errors', 1);
} else if (ENVIRONMENT == "production") {
    ini_set('display_errors', 0);
} else {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Environment is invalid. Please contact developer for more information.';
    exit;
}


/**
 * Define constants
 */
// Path to root directory of app.
define("ROOTPATH", dirname(__FILE__));

// Path to app folder.
define("APPPATH", ROOTPATH."/app");
//define("APPPATH", "C:\\xampp\\htdocs\\source-code\\app");


// Check if SSL enabled.
$ssl = isset($_SERVER["HTTP"]) && $_SERVER["HTTP"] && $_SERVER["HTTP"] != "off" 
     ? true 
     : false;
$ssl = true;
define("SSL_ENABLED", $ssl);

// URL of the application root. 
// This is not the URL of the app directory.
$app_url = (SSL_ENABLED ? "http" : "http")
         . "://"
         . "localhost"
         . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
         . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
define("APPURL", $app_url);



define("DOMAINNAME", ".".$_SERVER["SERVER_NAME"]);

// Define Base Path (for routing)
$base_path = trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
$base_path = $base_path ? "/" . $base_path : "";
define("BASEPATH", $base_path);

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
} else {
    header("Access-Control-Allow-Origin: *");
}

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Set a 200 OK response for OPTIONS requests
    header('HTTP/1.1 200 OK');
    exit();
}



// Required libraries, config files and helpers...
require_once APPPATH.'/autoload.php';
require_once APPPATH.'/config/config.php';
require_once APPPATH."/helpers/helpers.php";


// Run the app...
$App = new App;
$App->process();
