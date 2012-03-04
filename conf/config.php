<?php

  namespace MB;

  // MySQL - master connection setting
  $config['mysql']['host'] = '127.0.0.1';
  $config['mysql']['user'] = 'root';
  $config['mysql']['pass'] = 'dev3633';
  $config['mysql']['dbname'] = 'mb_trunk';

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

  //