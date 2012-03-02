<?php

  error_reporting( E_ALL );
  ini_set( 'display_errors', 1 );
  ini_set( 'html_errors', 'On' );

  define( 'MB_APPLICATION_NAME', 'Adminka' );

  require_once "../sys.php";

  final class Adminka extends MB\WebApplication
  {
    protected $bricksMap = Array(
      '*:/^.*$/' => 'Users:Adminka:Adminka',
      '*:/^.*$/' => 'Error:Adminka'
    );
  }

  $app = new Adminka();
  $app->execute();