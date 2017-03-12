<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Optional, comment this out if you don't use a sub-folder.
 *
 * URL_INDEX_FILE:
 * Our index file that will be hit on every request to our application. No reason to change this in any way usually.
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', 'disneyparks');
define('URL_INDEX_FILE', 'index.php' . '/');

// the final URLs, constructed with the elements above
if (defined('URL_SUB_FOLDER')) {
    define('URL', URL_PROTOCOL . URL_DOMAIN . '/' . URL_SUB_FOLDER . '/');
    define('URL_WITH_INDEX_FILE', URL_PROTOCOL . URL_DOMAIN . '/' . URL_SUB_FOLDER . '/' . URL_INDEX_FILE);
} else {
    define('URL', URL_PROTOCOL . URL_DOMAIN . '/');
    define('URL_WITH_INDEX_FILE', URL_PROTOCOL . URL_DOMAIN . '/' . URL_INDEX_FILE);
}

/**
* Configuration for: CORS
* If you are using this as a remote API, you will need to enable CORS.
* Enable CORs here so you don't have to on your server.
**/

define('ENABLE_CORS', true);

/**
* Configuration for: Dashboard
* The dashboard is excellent for debugging.
* It allows you to run your API from the dashboard to check for errors.
*/

define('ENABLE_DASHBOARD', true);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 *
 * If you do not need SQL for your API make sure DB_ENABLE is 'false'.
 */
define('DB_ENABLE', false);
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'tiny');
define('DB_USER', 'root');
define('DB_PASS', '');
