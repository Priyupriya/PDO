<?php
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;


//Be able to switch between test and live database from environment file
$GLOBALS["CONFIG"] = [
    'DEV' => [
        'PDO_DB_NAME' => 'def50200afde21896537b6b7bbc83eea6b28bf8af7e37ad69cf0637901d55f05e739e5642edebfb12216bd7e1f964ecf3a417604812477ad661942a4c6aed8dc98e01be77c841113fb6a4570473e2fddb9290d30944bcaca7396a1fa',

        'PDO_ENV_FILE_LOCATION' => 'def50200a164881684abd2c535a65840f702ed44267d613bca0f2501a99eb873e5d6caae0aa12c718f85d9aa9b155f582e5bf6efaf1726c788dce458b23452817755475b809cb5f33441a9814b6aa5cd909d260f368aa7',
	]];
	
	//HTTP OR HTTPS
define('SERVER_PROTOCOL', isSecure() ? 'https://' : 'http://');

//EDI AGADIR MANAGEMENT APP
define('PDO_FILE_LOCATION', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);
define('PDO_LOCATION_PUBLIC_SITE_LOCATION', SERVER_PROTOCOL . $_SERVER['SERVER_NAME'] . '/');
//echo getenv('ENVIRONMENT');
function isSecure()
{
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}
//var_dump($GLOBALS);

	?>
	