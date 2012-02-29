<?php

  namespace Adminka\bricks;

  class Users extends \MB\Brick
  {
    public function setMap()
    {
      $this->map = Array(
        '/^.*$/' => 'Manage'
      );
    }

    public function setActions()
    {
      $this->setAction( 'manage', 'users', __( "Управление" ), __( "Управление пользователями" ) );
    }
  }

