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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/Users/eliza/Desktop/freelance/chattgirls/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager





/*********** TEST ************/

// define('DB_NAME', 'chattgirls');

/** MySQL database username */
// define('DB_USER', 'root');

/** MySQL database password */
// define('DB_PASSWORD', 'Gilbert1579');

/** MySQL hostname */
// define('DB_HOST', 'localhost');

/*********** TEST ************/






/*********** REMOTE ************/

define('DB_NAME', 'chattan7_2016');

/** MySQL database username */
define('DB_USER', 'chattan7_roux');

/** MySQL database password */
define('DB_PASSWORD', 'Jy%sfA2vTn!7m~CF');

/** MySQL hostname */
define('DB_HOST', 'localhost');
//
/*********** REMOTE ************/






/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '|2DTIPrO]7_%S.w_S1&]~{EZ4:vKy=aYOSS+JuA)[N/7h,{2:[B3+05[vKr_OjsH');
define('SECURE_AUTH_KEY',  '|B?+[=EDC/c)O#p)-T[4Z}W.cQC=ECx*EWzv;+JK H{rbWs{yQX!ouT*p^!px[QL');
define('LOGGED_IN_KEY',    '*Fg~<N pLC$PAnhO;@^</H9N-#]aFo%Lyz<ce_Z8VP*Kzd<a3hex7K-##]B/TWMI');
define('NONCE_KEY',        'j9D/h-9iIV)-[u|$!h.|*(!4xyjw[V+`HqQir)$8y<gOO|&Jus62[%vU4U(9JabX');
define('AUTH_SALT',        '8]j(tg:yQ,bl-2fX33^D/bEy9{+Q(m}**@nc=8dg] y/%0qy^LgCFf/,i~f.2C8#');
define('SECURE_AUTH_SALT', 'pd2 hFzdXDz=KOxIRyr|AT^FE92?+,P.*$vJ&B|$;wFinio InGbaGEfg2;_f+_w');
define('LOGGED_IN_SALT',   'pZ{JiZzw=&^i%|;NFm0!rz~N3d(3O---jb2R:n:Nt8$cT=CPDK(mu?m-2-X&]{?Z');
define('NONCE_SALT',       'yQ5.S6%W&HC2++WYU`,1$Qq>ZAjpgfxvIR POq+1l*wpx~aw$J`-}`qpYP7M o1z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
