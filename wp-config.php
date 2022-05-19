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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'database' );

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
define( 'AUTH_KEY',         ']N$BU#MFCfYImeF*li4EHIYC(K%pDx-@l50;,uTL4YaaY4t2C[`,`:1V1ixd9vu(' );
define( 'SECURE_AUTH_KEY',  ';>t<?o0=4tIgpim ?2Z5[#O*,F^s*BP$a6m(}n!1Fnh=V!cj!=0Eq^7E*wpsJS8W' );
define( 'LOGGED_IN_KEY',    '{qedIbsIgg_}o~(BWX8;^Y1=Ea#?E-~4ExDw|A^0,86N1?&L7| ZdshLhR/=z5%~' );
define( 'NONCE_KEY',        '=WCS5PrYm,<@RM#?6CAw^$IU.N_1=+Do*3C 7:ul$UBQQN%I?BDiW-,PNiUn8)sh' );
define( 'AUTH_SALT',        '818]YFle .!*s0YXnlK}W%zMM{gKKO?~pJ%Z9IpgR?MBi9-A3PJ<Jlgy<;z?UcN$' );
define( 'SECURE_AUTH_SALT', 'n2X|ju2j-}4=c]@4UrM_C5K!0.a_W`-/^$];`a:o=]UHM[!5vB(6SQBUXRUF*5M[' );
define( 'LOGGED_IN_SALT',   'B}`Dj^xd~YNG6JH&)z2UQ1)T]n5bXWPHe(|HJUsu8Nd# ~;JZ1wnnjQSe&*f5!4H' );
define( 'NONCE_SALT',       'v69+.[5t6SmTs]`Pst&p|6&h/NaO`}&d~6b6zhu1:j$mx!Y/Mg_O&<jIE|!MC7Pd' );

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
