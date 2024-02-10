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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_e-commerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'p0DP.*`pI2<XNWznhwKZY:fR(>2bZC(8h>FomJSs;{)C[%wBtl3hhGI{gTg%Xe!$' );
define( 'SECURE_AUTH_KEY',  '+m9S#b_H@4,De=Y)[qq %Gy_+9r96>j+UZ!M_oejRf2e{L=<2//U9&g{)S$W>yT$' );
define( 'LOGGED_IN_KEY',    ')y9C8,tExs!g$B| v]kr`VkQ$lu@f7;:{DpnT*C6 LaAsm{tO`pAO]S 6A5v8Rl7' );
define( 'NONCE_KEY',        ']!}8$X#:h*<M;Uqr<O|b&zy3Z1A$w8tqTY`5z|s)I5Dy6<lCSG#{Sjxq6J[#ku?!' );
define( 'AUTH_SALT',        '1cTog9D4&4f*RvdM|Q>XTZP5pLv|a?IK;N*6Py<B*%emftV$z*L%sG-{C4546+p2' );
define( 'SECURE_AUTH_SALT', 'gjnYqtMRsA^/_!XQ(]!CZ{<haEGW ZcY|+3ns{-^R5JZL|zW[bK^Wpt-Agu(Yk2c' );
define( 'LOGGED_IN_SALT',   'ZD0sg+~Y*x7#e)y>y?)2.)Jb7?AG}}KBC4:}lH^b{jn@54oh+kCSzm^:q|_6g2;/' );
define( 'NONCE_SALT',       'In%CFwvr!!=xs=$S`<$pn^#=&=&t?`0BWGFw$$7^-S@&(gcn*n2s<;%|UXa6.S-2' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'e_commerce_wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
