<?php
//CONFIGURAÇÕES GERAIS
if (isset($_GET['debug'])){
	define( 'DEBUG', true);
}else{
	define( 'DEBUG', false);
}

define( 'ABSPATH', dirname( __FILE__ ) );
define( 'DS', DIRECTORY_SEPARATOR);

define( 'DISABLED_SYSTEM', false);

// time zone padrão fora do horario de verão
define( 'TIME_ZONE', 'America/Sao_Paulo' );

define( 'HOME_URI', '/');
define( 'URL_SYSTEM', 'http://'.$_SERVER['SERVER_NAME'].'/');

//AMBIENTE DE HOMOLOG
define( 'TYPE_ENVIRONMENT', 'homolog');

// CONFIGURAÇÕES BANCO DE DADOS
define("HOSTNAME", "localhost");
define("DB_NAME", "base");
define("DB_USER", "postgres");
define("DB_PASSWORD", '123');
define("DB_PORT", "3306");
define("DB_CHARSET", 'utf8' );
define("DB_DRIVER", 'pgsql' );
define("PORT", '5432');




