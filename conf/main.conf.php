<?php

  namespace MB;

  //DEFINES
  define( 'APPLICATION_MODE_DEVELOP', 1 );
  define( 'APPLICATION_MODE_STAGE', 2 );
  define( 'APPLICATION_MODE_PRODUCTION', 3 );

  define( 'ACTION_MODE_ROOT', 1 );

  define( 'CURRENT_TIMESTAMP', time() );

  //CONFIG
  // MySQL - master connection setting
  $conf['mysql']['host'] = '127.0.0.1';
  $conf['mysql']['user'] = 'root';
  $conf['mysql']['pass'] = 'dev3633';
  $conf['mysql']['dbname'] = 'mb_trunk';

  //Adminka config
  $appName = 'Adminka';
  $conf[$appName]['domain'] = 'adminka.mb.trunk';
  $conf[$appName]['prefix'] = 'http://';
  $conf[$appName]['url'] = $conf[$appName]['prefix'] . $conf[$appName]['domain'];
  $conf[$appName]['session_name'] = $conf[$appName]['domain'];
  $conf[$appName]['mode'] = APPLICATION_MODE_DEVELOP;
  $conf[$appName]['version'] = 'v1.0prealpha';
  $conf[$appName]['Diagnistics'] = 'v1.0prealpha';

  //session
  $conf['session']['longTimeout'] = 31536000;
  $conf['session']['shortTimeout'] = 14400;

  //