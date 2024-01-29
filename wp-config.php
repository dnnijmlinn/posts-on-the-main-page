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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_takidelalocalcom_db' );

/** Database username */
define( 'DB_USER', 'wp_takidelalocalcom_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_takidelalocalcom_pw' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '`]<(w1m{u!wiNH-a<i,*;SOSbIHJe;=Dn+mWCD~=0}]w?mQKXc8.SgJNSZ=fw7Yj' );
define( 'SECURE_AUTH_KEY',   'tTt[|iB* 11p%jDEN}Cf1LeTM6oplCyVh3KuOhaACEp-M7@ks&&B8(_YD!DzJ<!u' );
define( 'LOGGED_IN_KEY',     'RM*AiAyJzs<la`88o{uBf#B]/iZVdJGX7+tP-`/4VD~_^ix):bw4(_VJns=geBf.' );
define( 'NONCE_KEY',         '?4),Xte?$go2S.J#C4| OYbeX< B{ l0l]&(.ip=fq@l WJ0Vj<F~8,(q_9qK,Co' );
define( 'AUTH_SALT',         'vSpY_a#-8F)G,PV6R?W0 !Xj]<tq2+j)=+Vy`a8yR=!f4k[$UjOe&$.@#!aQN*vm' );
define( 'SECURE_AUTH_SALT',  'XcGpI~mhpR~h_w>&aOQr2D@iU_! 4*~^K5!#/?hgf/Zb+y, Q{E *C7jV2e; _/7' );
define( 'LOGGED_IN_SALT',    'j/m%aH#+k@gBfdhn%_-# p2RlQaAh@;t7;/X(H}W9tF0Lh.<, :jt~xhwykmHzJR' );
define( 'NONCE_SALT',        'R-2;Xp^[JTN5ygch-cZVjB!]J$d$6P&E]B2R*N{,AFG`h%PU]:Mhbh+uv7;Tu^fO' );
define( 'WP_CACHE_KEY_SALT', 'Oau!SB|wm5I(gbC+VsH`+[xV^f398@xVXI&yl!f6|k$nD1K`L(A!b-FFPJN<$]D^' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
