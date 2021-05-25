<?php
$GLOBALS['finalconfig'] = initConfiguration();
loadEncryptedCredToEnvironement();

// $finalconfig = initConfiguration();

//Local DB
$GLOBALS["LOCAL_DB"] = new MeekroDB(getCredentials('EXCELANALYZER_DB_HOST'), getCredentials('EXCELANALYZER_DB_USER'), getCredentials('EXCELANALYZER_DB_PASSWORD'), getCredentials($GLOBALS['finalconfig']['EXCELANALYZER_DB_NAME']), getCredentials('EXCELANALYZER_DB_PORT'), 'utf8');
$GLOBALS["LOCAL_DB"]->error_handler = false; // since we're catching errors, don't need error handler
$GLOBALS["LOCAL_DB"]->throw_exception_on_error = true; //enable exceptions for the DB

//Increase packet limit and fix GROUPBY error
//$GLOBALS["LOCAL_DB"]->query('SET GLOBAL max_allowed_packet=3073741824');
$GLOBALS["LOCAL_DB"]->query('SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');
$GLOBALS["LOCAL_DB"]->query('SET SQL_SAFE_UPDATES = 0');
$GLOBALS["LOCAL_DB"]->query('SET GLOBAL sort_buffer_size=1000000');

//Local USERSPICE DB
$GLOBALS["LOCAL_USERSPICE_DB"] = new MeekroDB(getCredentials('EXCELANALYZER_DB_HOST'), getCredentials('EXCELANALYZER_DB_USER'), getCredentials('EXCELANALYZER_DB_PASSWORD'), getCredentials($GLOBALS['finalconfig']['USERSPICE_DB_NAME']), getCredentials('EXCELANALYZER_DB_PORT'), 'utf8');
$GLOBALS["LOCAL_USERSPICE_DB"]->error_handler = false; // since we're catching errors, don't need error handler
$GLOBALS["LOCAL_USERSPICE_DB"]->throw_exception_on_error = true; //enable exceptions for the DB



//-----------------HELPER FUNCTIONS------------------

function initConfiguration()
{
    $defaultconfig = $GLOBALS["CONFIG"]['DEV'];
    $environment = getenv('ENVIRONMENT') ? getenv('ENVIRONMENT') : 'DEV';
    // echo 'ENV = ' . $environment . '-----';
    $environment_config = $GLOBALS["CONFIG"][$environment];
    // var_dump(array_merge($defaultconfig, $environment_config));
    return array_merge($defaultconfig, $environment_config);
}
function encryptString($string)
{
    return Crypto::encrypt($string, Key::loadFromAsciiSafeString(getenv('ENC_KEY')));
}

function decrypt($code)
{
    return Crypto::decrypt($code, Key::loadFromAsciiSafeString(getenv('ENC_KEY')));
}

function getCredentials($index)
{
    if (!isset($_ENV[$index])) {
        return false;
    }
    if ($index === 'ENVIRONMENT') {
        return getenv('ENVIRONMENT');
        // return $_ENV[$index];
    }
    return Crypto::decrypt($_ENV[$index], Key::loadFromAsciiSafeString(getenv('ENC_KEY')));
}
function loadEncryptedCredToEnvironement()
{
    // echo '.ENV is in = ' . getCredentials($GLOBALS['finalconfig']['ENV_FILE_LOCATION']);
    $dotenv = Dotenv\Dotenv::createMutable(EDIAGADIR_LOCATION . Crypto::decrypt($GLOBALS['finalconfig']['ENV_FILE_LOCATION'], Key::loadFromAsciiSafeString(getenv('ENC_KEY'))));
    $dotenv->load();
}

?>