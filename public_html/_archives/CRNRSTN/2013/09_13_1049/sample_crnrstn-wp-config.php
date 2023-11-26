<?php
//
// CRNRSTN INTEGRATION
include_once('crnrstn/_crnrstn.config.inc.php');

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $oENV::$resource_ARRAY['DATABASE_DBNAME']);

/** MySQL database username */
define('DB_USER', $oENV::$resource_ARRAY['DATABASE_USERNAME']);

/** MySQL database password */
define('DB_PASSWORD', $oENV::$resource_ARRAY['DATABASE_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $oENV::$resource_ARRAY['DATABASE_HOST']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $oENV::$resource_ARRAY['DATABASE_CHARSET']);

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', $oENV::$resource_ARRAY['DATABASE_COLLATE']);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         $oENV::$resource_ARRAY['AUTH_KEY']);
define('SECURE_AUTH_KEY',  $oENV::$resource_ARRAY['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY',    $oENV::$resource_ARRAY['LOGGED_IN_KEY']);
define('NONCE_KEY',        $oENV::$resource_ARRAY['NONCE_KEY']);
define('AUTH_SALT',        $oENV::$resource_ARRAY['AUTH_SALT']);
define('SECURE_AUTH_SALT', $oENV::$resource_ARRAY['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT',   $oENV::$resource_ARRAY['LOGGED_IN_SALT']);
define('NONCE_SALT',       $oENV::$resource_ARRAY['NONCE_SALT']);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = $oENV::$resource_ARRAY['DATABASE_TABLE_PREFIX'];

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', $oENV::$resource_ARRAY['WPLANG']);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', $oENV::$resource_ARRAY['WP_DEBUG']);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', $oENV::$resource_ARRAY['ABSPATH']. '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
