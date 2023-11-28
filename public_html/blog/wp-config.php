<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/**
* @package CRNRSTN

// J5
// Code is Poetry */
require_once('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');
//
// ULTIMATELY, THE PLAN IS TO MANAGE THIS (AND OTHER) THIRD PARTY ACCOUNT META
// THROUGH OUR OWN CUSTOM AND SUPER SLEEK LOGIN ADMIN INTERFACE.
//
// NOTE: THERE IS NO WordPress CONFIGURATION DATA HERE.
// FOR THE POINT OF COLLECTION OF THIS INFORMATION (BY CRNRSTN ::),...
//
// ...PLEASE SEE:
// /_crnrstn/_config/config.wp.secure/_crnrstn.wp_config.inc.php
//
//
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $oCRNRSTN->get_resource_wp('DB_NAME', 0, 'CRNRSTN::WP::INTEGRATIONS'));

/** MySQL database username */
define( 'DB_USER', $oCRNRSTN->get_resource_wp('DB_USER'));

/** MySQL database password */
define( 'DB_PASSWORD', $oCRNRSTN->get_resource_wp('DB_PASSWORD'));

/** MySQL hostname */
define( 'DB_HOST', $oCRNRSTN->get_resource_wp('DB_HOST'));

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', $oCRNRSTN->get_resource_wp('DB_CHARSET'));

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', $oCRNRSTN->get_resource_wp('DB_COLLATE'));

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         $oCRNRSTN->get_resource_wp('AUTH_KEY'));
define( 'SECURE_AUTH_KEY',  $oCRNRSTN->get_resource_wp('SECURE_AUTH_KEY'));
define( 'LOGGED_IN_KEY',    $oCRNRSTN->get_resource_wp('LOGGED_IN_KEY'));
define( 'NONCE_KEY',        $oCRNRSTN->get_resource_wp('NONCE_KEY'));
define( 'AUTH_SALT',        $oCRNRSTN->get_resource_wp('AUTH_SALT'));
define( 'SECURE_AUTH_SALT', $oCRNRSTN->get_resource_wp('SECURE_AUTH_SALT'));
define( 'LOGGED_IN_SALT',   $oCRNRSTN->get_resource_wp('LOGGED_IN_SALT'));
define( 'NONCE_SALT',       $oCRNRSTN->get_resource_wp('NONCE_SALT'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = $oCRNRSTN->get_resource_wp('TABLE_PREFIX');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', $oCRNRSTN->get_resource_wp('DB_NAME'));

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';