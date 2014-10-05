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
 
// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'wedding');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'qmi13j');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'GDf%dL{yRK}tPx:br]_2z;2<&[]mwK> (v4m/bp8MM%Ihs?@.A.EJx%o%/)HNlSx');
define('SECURE_AUTH_KEY',  '5-6M&b>+~Ff&Z$|j&q.m?A!!W@UoCm/k^HugW{:{k?Z=LOq`}S Il--P.H^N-?gb');
define('LOGGED_IN_KEY',    ',>}VRM=9,w<5eD-}-<l_+|OoYCDS,Vh%0ms*(a3,LrpBEXH+ILO/7,1=SkVCXyP|');
define('NONCE_KEY',        'y^.fQ|h1ttWmoZwolG`7wNL[wR4:A=-?U,/93m124g/CE!N-h_K CU](D+}j3rj|');
define('AUTH_SALT',        'I;2o{r+q>e_p9RW:{tpOgSt<b9K)-82G(MRP)Wm|Pc5NkjrP|QOe79G^np=v=IA:');
define('SECURE_AUTH_SALT', 'uD-rH*ml2!ZmYv|F7&]vf8xLmsdsk-eq67BCyLAP`U-|BlzH-|;++:CNx|/W }<:');
define('LOGGED_IN_SALT',   'pTq{6[w|}v[?C<3D+.>JE48zWEP/gx1m.>}^y1nofT[,|+8Qt#WE5cV!$1kNhLk)');
define('NONCE_SALT',       'i~?,t%1Sjl+1K{Ge+T~9%:;cmaM.PzkWO||1=.@s-B6|?YY@5R*.H:>@R?RHm{FA');

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
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
