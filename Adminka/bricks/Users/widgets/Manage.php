<?php

  namespace Adminka\bricks\Users\widgets;

  class Manage extends \MB\Widget
  {
    protected function prepare()
    {
      $this->path = __DIR__;
      $this->name = 'Manage';

      $list = \Adminka\models\User::getList();

      return compact( 'list' );
    }
  }

