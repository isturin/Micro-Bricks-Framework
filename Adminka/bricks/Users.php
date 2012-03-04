<?php

  namespace Adminka\bricks;

  class Users extends \MB\Brick
  {
    protected $map = Array(
      '/^.*$/' => 'Manage'
    );

    protected $actions = Array(
      'manage' => Array(
        'template' => 'users',
        'label' => 'Manage',
        'title' => 'User management'
      )
    );

  }

