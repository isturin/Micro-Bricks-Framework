<?php

  define( 'MB_APPLICATION_NAME', 'Adminka' );

  final class Adminka extends MB\WebApplication
  {
    protected $bricksMap = Array(
      '*:/^.*$/' => 'Users:Adminka:Adminka',
      '*:/^.*$/' => 'Error:Adminka'
    );
  }