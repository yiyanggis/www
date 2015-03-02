<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpdatabase');

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
define('AUTH_KEY',         'ED+te-lg98z<6p8=E7!Fj.k*3#@f.B*/F#y.q4:5HesG^|Id|C2M_%aHk]Tv7Thq');
define('SECURE_AUTH_KEY',  '+#fD%|DobZ7JfklKJu@Au;srl;UAl2kVcJ.-cfah{O(}Gj#|gHi99 DR#[aUfVIH');
define('LOGGED_IN_KEY',    'rMMWD:Q8#znC~BsTXPxW+_[P;ZG _EL0]A[u6V`EL6&oBV2(iW@~mG=pI]w__AOF');
define('NONCE_KEY',        'G/c=-?~(|;sy)r+-lq4Q5k<N^X9w@v4{Z, KpllhTF6]!uxN;k?OMn|;/t3X?aw:');
define('AUTH_SALT',        'w%9+NK#:y:>,e{xe:)kMZSImB32IM+0spkQ.ERQzCL&-UJ[++)2nd>U;8Ez-!n><');
define('SECURE_AUTH_SALT', '.sYiB#J;%!IE.43,E #C]qE}5i:gev6QX*q+y,Uxjq/_<Nun%<;+?9_d[#WdCZVw');
define('LOGGED_IN_SALT',   '~52(%pWw>GHMyJ{)Sb$=dBN-3D{/IXrjr+&E-X%Ax|@fZbs%E(I=JXZ>Cv8GhO[9');
define('NONCE_SALT',       'Xu?IbY{=]w0C)~qGT?zX.n|!`wt&l@VKTz~ECmO%:(7r:[{rj `qD]?.[@+1}|*J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
