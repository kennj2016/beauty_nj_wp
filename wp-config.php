<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'beautyonlocationns');
/** MySQL database username */
define('DB_USER', 'root');
/** MySQL database password */
define('DB_PASSWORD', '123123');
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
define('AUTH_KEY',         'J$36UN`oA6dUvo:/.va.-|DSHp;VcT%9LqwX5{dC~`[oO|R]9&B1R=]x*|<*=>$i');
define('SECURE_AUTH_KEY',  '4?C+b-Je+$A0U%DyT:Jz!Z_d4!vOIiS+H;`Qf5@Q-}S,*5v4kQ@=X8r-hf>Dj~Yv');
define('LOGGED_IN_KEY',    '58ex)--sJPI+|Ir1-gpbh|bLk8y|Tjx|@#.s`NF{47-C|/Ydhk]~P[K~7n:}&-.{');
define('NONCE_KEY',        'Z&l=p}Olp+ck}dQ||}YyF(Gvq)qpSR|{*fRxYHnKuSe7B,r,a1~H,]C(h9L[[u0B');
define('AUTH_SALT',        '4#U4))$`,Ifp4he^++F9{`a^#2mJn 9hr3J;e S%XUT8=S3-#p$!g[lby+gEKoip');
define('SECURE_AUTH_SALT', '1I73-%_rQ0UH40tM5Q>aNE4w[w}qo;S7hn81bfa]@fa;t1kaqn]Z@L=Zy73O+Ub_');
define('LOGGED_IN_SALT',   'k_T97JF0CxV.@M6NkId!wG[~hh-?ljo-1?Y8w~F b_y1&O|9$U*#_yW[%L>RaR/N');
define('NONCE_SALT',       'c..qH>._pWO8i-*W$yU|p|Xvs+Lvk5>{S;4*|5=q~eWD4;3`|!-~-)ZS,k? HgRx');
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
