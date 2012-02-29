<?php

  namespace MB
  {
    //DEFINES
    define( 'APPLICATION_MODE_DEVELOP', 1 );
    define( 'APPLICATION_MODE_STAGE', 2 );
    define( 'APPLICATION_MODE_PRODUCTION', 3 );

    define( 'ACTION_MODE_ROOT', 1 );

    define( 'CURRENT_TIMESTAMP', time() );


    //CONFIG
    // MySQL connection setting
    $conf['mysql']['host'] = 'localhost';
    $conf['mysql']['user'] = 'root';
    $conf['mysql']['pass'] = 'dev3633';
    $conf['mysql']['dbname'] = 'mb_trunk';

    //site config
    $conf['site']['domain'] = 'mb.trunk';
    $conf['site']['prefix'] = 'http://';
    $conf['site']['url'] = $conf['site']['prefix'] . $conf['site']['domain'];
    $conf['site']['session_name'] = $conf['site']['domain'];
    $conf['site']['mode'] = APPLICATION_MODE_DEVELOP;

    //Adminka config
    $appName = 'Adminka';
    $conf[$appName]['domain'] = 'adminka.mb.trunk';
    $conf[$appName]['prefix'] = 'http://';
    $conf[$appName]['url'] = $conf[$appName]['prefix'] . $conf[$appName]['domain'];
    $conf[$appName]['session_name'] = $conf[$appName]['domain'];
    $conf[$appName]['mode'] = APPLICATION_MODE_DEVELOP;
    $conf[$appName]['version'] = 'v1.0prealpha';

    //session
    $conf['session']['longTimeout'] = 31536000;
    $conf['session']['shortTimeout'] = 14400;

  }


