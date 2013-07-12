<?php
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
define('DB_NAME', 'sdi_sdi');

/** MySQL database username */
define('DB_USER', 'sdi_root');

/** MySQL database password */
define('DB_PASSWORD', 'DugTaxingSheathFrizzy59');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'It>JT=21e<Vm$Cl`-5_2|!E5mkD{Qon->mu09G/]:ky|=f4AJX6]uVR?bI,1deVw');
define('SECURE_AUTH_KEY',  '([=-|#&^b7{;T(LuO&?8/-4sGdDQi&zkxdz/Z{Lc)wg)Iy_nPV=0N.*,gpfpc|1X');
define('LOGGED_IN_KEY',    'RD7mHJi=;HUuY,[Rj(jzcBA?F*ma-2|_pI7FEQ5Ra7OfJV]`9NZK+z=a8/<-/FKM');
define('NONCE_KEY',        'k|*@*x,E-s;NDuc|:d7qw@}]o(WmvqNsO=A 4#}#h6p.#+aD>wIM<N96Et<|M(yr');
define('AUTH_SALT',        'TqsOuTU*h4iBDDy2!GM?K|3gmzJ9v=|X!FqX CBa:eLRAmI(m)P-5dxx`r/yk~p:');
define('SECURE_AUTH_SALT', 'ZE!d_4FIp_o`m|&Vby yn]ij*-0{JB$;^-(/8Z){H)~rfZpuuceN8K/--3ym8ql?');
define('LOGGED_IN_SALT',   '5H zddSKN<i,x:k:<.|RLwQjlDLWPnCFoe.$U +LH4!Dm#(XJ-dwtqfdJfAH?c(V');
define('NONCE_SALT',       '|I@U|o_KHxsF(fzBeeP^ KzvVsrGXFn4@mx=.J31H>ctuj-YB9J+p;wbt&uGxswX');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
