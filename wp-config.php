<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u898320208_Pnkx7' );

/** Database username */
define( 'DB_USER', 'u898320208_vfXaH' );

/** Database password */
define( 'DB_PASSWORD', 'CMeBDP6DTT' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'h6?P1tLu<.QRoff+hn~c.3~kTi40<w-cud[?R>du-(#TT-j_Bbu0z;w6HJF#67m_' );
define( 'SECURE_AUTH_KEY',   ' 9KWY<l?a{KL1^l@hhk-?Pw$-=Pe]a>($LT7EAP`]l&Z7+{[B.]EDS?qu(*?#;w2' );
define( 'LOGGED_IN_KEY',     '=jSeM[/fb>M<F?~U_iMz(Ci7yxXDEu}eeqZpxQMt sN2L$mE{}r(;q<:0YAv#& #' );
define( 'NONCE_KEY',         '%H_sz|nsT{jE#1:SS:}hKCtbn&s?Q+ysNjiHh AMl)F x2m4+!j$DLU=y*saw,I#' );
define( 'AUTH_SALT',         '2Pm4|_<IXe2?;*|Gl8kWt|i/J-mGQ/+$)PjE,V)~yO?EBpH@gc9)LTI@e@+>_,xx' );
define( 'SECURE_AUTH_SALT',  '#F!YfAapw7KD,-bk+8Ej,`lbAJ$^RQBbMN )eSah)nzN$C)eZ$=}qrHn..W?dw7c' );
define( 'LOGGED_IN_SALT',    'T_,Gc+n`!ANU`wB5wyp/OX{=j_{ <Ye4om x!(d]iz{O-uVw;_=p#tS26N*qGzNS' );
define( 'NONCE_SALT',        '}pSY%{SPsTTK*_oNf~DT|X<6ipnB~FdG%B}.,3K9+>YZ/inlz/H1W2!J_56Zy4T`' );
define( 'WP_CACHE_KEY_SALT', '_&1p&>ny9vP9=*BWX8CB@%Be#1erj?= j+JEz 37R6!RHkGJ~3_D@kG%4.Isl+!x' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '175d4e96074bc07c82c6afa2ba03ce24' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
