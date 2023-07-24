<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'oneshadow_fun' );

/** Database username */
define( 'DB_USER', 'oneshadow_fun' );

/** Database password */
define( 'DB_PASSWORD', 'root123123' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'xgG(H=H9[OCF,ecD5oXc8bAcHT&5:v}H.M`*j<>OYPg{lI2U9g-O@q(Maq VS4Jd' );
define( 'SECURE_AUTH_KEY',  ';`D|kr[3~EADW;Y+Lb<}QAF>cTh.AH5]|#f0>Hv,DwKgXzqvMFTaUP)Yg-_85n7C' );
define( 'LOGGED_IN_KEY',    'CH{j(n[`H%w%I7m{ NO8U x6*n^&1F=etsoqk8{x<io3&_G7v?;^@5_KD%krb3[3' );
define( 'NONCE_KEY',        'v_IE#iN0_}Z]pj_[ZUWFwoJ%#@O)A1oiMiRc:I?<U<e/[C`9Z^QQd&N-1DOefPy)' );
define( 'AUTH_SALT',        '&/!pWRN0Qysh=Sk,|hiI`5^GC:-%rIfB@/yh/5mOV@BF_.Zr:>Ej`4cAVSk7dUbh' );
define( 'SECURE_AUTH_SALT', 'j13uim8?qA`$d{j!y%]hYs@?p!X>ssC`Hl==?[Yqb[Og9y{y(uEAgd_}!y2)]9LO' );
define( 'LOGGED_IN_SALT',   'w^mKYwgim}{7B(I{~:UVUZC@q ?M zm1zq]<[s:8(21:<uT$5|LFwu;b@hJIu)bU' );
define( 'NONCE_SALT',       'As}RHpJ {?)iLNIXb2SO<%K&1o}|e4e)I%h^%_b@d]ZY2v;/[er3+xKzazk.js,J' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define('WP_ALLOW_REPAIR', true);