<?php
# Database Configuration
define( 'DB_NAME', 'snapshot_sayenko' );
define( 'DB_USER', 'sayenko' );
define( 'DB_PASSWORD', 'Wr2tAO0dAu79gJwpJJjU' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '0-6:Zs.av2+Ol1EA@ ~n|#.&qa2WLp;mGI<oouc 73|h+@+^9#@)Q|n:)li*.pIu');
define('SECURE_AUTH_KEY',  'GfSZ/zw)IMNchSE!;)b!WT*M$pNoa$`W:XPPa_-|:NxI1PzY-T5/5k-R!MqHkEU ');
define('LOGGED_IN_KEY',    '{*So]-~=u$o4#i%M#Fjbai7+>_~=fGL}>TgI+p99#Cstfs|qpz>w;tg|-LZvF;BU');
define('NONCE_KEY',        '0LD!TF:b/#ZSryu_Aj}~<J(-`z`t+E;ro+?}^Z6&hzq[L4LCF+V[9hgrl4T+i/X|');
define('AUTH_SALT',        'y2F&E`L/iX{tzbbd-DDqd;i)P.2vzxD[3-TLWHa{MP%0!CCz|Up8tGv/Of%fGH8+');
define('SECURE_AUTH_SALT', 'N(-A(b<O|l6~hp_6fHJsYBmxO&d;XoU7Q6ldd^}NiFp_#OmGxKJ<|v#s&S[>*oc|');
define('LOGGED_IN_SALT',   'f;WR%)scQ=)a@W%7]u/[i2A2W<}cSA&BR!Na8kzC[buUVQwTG@~9`l(%BWVa:6<Q');
define('NONCE_SALT',       '.-qX*G`wtey?S`SJ.zbhciDQE+h8pSvj-V(AZ9Kk/+?`MLC)^v>/F1e049h&h(zT');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'sayenko' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', 'dce5ddcc04e0db153821079c8f2bc15552cd74d5' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '40602' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '45.56.66.55' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'sayenko.wpengine.com', 1 => 'www.sayenkodesign.com', 2 => 'sayenkodesign.com', );

$wpe_varnish_servers=array ( 0 => 'pod-40602', );

$wpe_special_ips=array ( 0 => '45.56.66.55', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( 0 =>  array ( 'match' => 'www.sayenkodesign.com', 'zone' => 'sayenko', 'secure' => false, 'dns_check' => '0', 'enabled' => true, ), );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );

define( 'WP_SITEURL', 'http://sayenko.staging.wpengine.com' );

define( 'WP_HOME', 'http://sayenko.staging.wpengine.com' );
define('WPLANG','');

# WP Engine ID


define('PWP_DOMAIN_CONFIG', 'www.loboscoconsulting.com' );

# WP Engine Settings






define('WP_DEBUG', false);

# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
