<?php

  namespace MB;

  // MySQL - master connection setting
  $config['mysql']['host'] = '';
  $config['mysql']['user'] = '';
  $config['mysql']['pass'] = '';
  $config['mysql']['dbname'] = '';

  //Adminka config
  $appName = 'Adminka';

  $config[$appName]['domain'] = 'adminka.mb.trunk';
  
  $config[$appName]['prefix'] = 'http://';
  $config[$appName]['url'] = $config[$appName]['prefix'] . $config[$appName]['domain'];
  $config[$appName]['session_name'] = $config[$appName]['domain'];
  $config[$appName]['mode'] = APPLICATION_MODE_DEVELOP;
  $config[$appName]['version'] = 'v1.0prealpha';
  $config[$appName]['Diagnistics'] = 'v1.0prealpha';

  //session
  $config['session']['longTimeout'] = 31536000;
  $config['session']['shortTimeout'] = 14400;
