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

define('DB_NAME', 'geotel18112013');

//define('DB_NAME', 'wpdatabase');

/** MySQL database username */

define('DB_USER', 'root');



/** MySQL database password */

define('DB_PASSWORD', 'password');



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

define('AUTH_KEY',         'yv7#xh{WKh/aE`;t_O%f0cr<u: | |(gwbrDp1sjTKb[X4<ZCneHzd8/^3HE-C[o');
define('SECURE_AUTH_KEY',  '/kM#Z$pNXE9Au#W/:7}vt]}(GDq,EYsP9U H>PE]/|Kze9]=WTM()fodVMD4r{)d');
define('LOGGED_IN_KEY',    'oJFf=1Gh?a70#N_9j3^f^e.L3/z xz4w8fG4Eiii$RYMqt*0pg(2V3tjG&=jo4lX');
define('NONCE_KEY',        '|TCeHN@wXUUu+i`<f%,CYilbmiQ?9nv]-X)dA[WyhOuv1&N.hK>5CNP -[=%u+V<');
define('AUTH_SALT',        ']-D/++:*2 EGzr/wL{AQa>P[A:eYUCwqpv1MOenR-CA0p:sE/tn~<_aSHJasE1 o');
define('SECURE_AUTH_SALT', 'aHTe7oB_srzN6`[L5/D#}h$^NZ_:Ykg-4G)NL2NHt4JId.fpt9faaGXe~`%Tq7Aq');
define('LOGGED_IN_SALT',   'L`MRtm*6T#B/pu*V;!}S&AMp1T@BKdW7IL+$BMkW2f:t|A0M,4z&*jfi>OH3FS?z');
define('NONCE_SALT',       '9K,^ -vL<^~S[{ZNEElN.^@O!y@ rFNlK$+|@((Gf2d-|346_WI;>U&=-G2qDi79');



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
define('FS_METHOD', 'direct');



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

