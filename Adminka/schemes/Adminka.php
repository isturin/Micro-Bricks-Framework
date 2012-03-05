<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=\MB\Registry::get( 'pageTitle' )?></title>
    <link href="/css/Adminka.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
    <div id="wrapper">
      <div id="mainContainer">
        <div id="mainMenu">
          <div class="menuItem menuSelectedItem">Пользователи</div>
          <div class="menuItem">Найстройки</div>
          <div class="menuItem">Статистика</div>
          <div class="menuItem">?</div>
          <div id="logo"><span
            id="appName"><?=\MB\Registry::get( 'appname' )?></span> <?=\MB\Registry::get( 'conf',
            \MB\Registry::get( 'appname' ), 'version' )?></div>
          <br clear="both"/>
        </div>
        <div id="contextMenu">
          <div class="menuItem menuSelectedItem">Управление</div>
          <div class="menuItem">Найстройки</div>
          <br clear="left"/>
        </div>
        <div id="actionTitle">
          Пользователи :: Управление :: Список
        </div>
        <div id="actionContainer">
          <?=$actionContent?>
        </div>
      </div>
      <div id="footer">
        <div id="copyright">&copy;2012 Micro Bricks</div>
      </div>
    </div>
  </body>
</html>