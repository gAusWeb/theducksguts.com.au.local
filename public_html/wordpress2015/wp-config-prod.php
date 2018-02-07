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
define('DB_NAME', 'theducks_wp109');

/** MySQL database username */
define('DB_USER', 'theducks_wp109');

/** MySQL database password */
define('DB_PASSWORD', '0P[bp5S1@D');

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
define('AUTH_KEY',         'nicjyzqq3uolg5b4gj0cbnua3hgrudvlibwj9yogmt72vbb7v6giycx4jc9bwjge');
define('SECURE_AUTH_KEY',  'awxeskyipaxxwkugmamurc79ezkho28whxjir47abonbnjndxwxlqfeoim6ouzyu');
define('LOGGED_IN_KEY',    'o2hunt7fgwlrevkzeyyjtyklqlqaf2gn4pyqufko5rjj22heaojakp4px0sqg2r0');
define('NONCE_KEY',        'aipuopf4mrndmwo68hqdrthuweajqzipal7lb4htq7p63hjkazo12s1rw16udzvh');
define('AUTH_SALT',        'ltfdrdvhlasixmxp0dqpdoc56bm1orwzivzhehx4m97hgufbkrldeylji9bzgbxs');
define('SECURE_AUTH_SALT', 'cn6kbnibawselodrumti6iapzangmmahq5llxzrucejkzgl9f2v0acfsklghcups');
define('LOGGED_IN_SALT',   'exd4e4oe8tnhsrfzbi27o7vnymjeesviyhta2yylyqlrdvvqak1oacsunc3b5k9h');
define('NONCE_SALT',       'cr8aqd8rzfp1nouav4fg4viwho5jn7agltrv4wsvlqajfs3t40eca1mljfpuq4ap');

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
