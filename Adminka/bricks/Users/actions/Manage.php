<?php

  namespace Adminka\bricks\Users\actions;

  class Manage extends \MB\Action
  {
    public function setFilters()
    {
      $this->setFilter( new \MB\filters\All() );
    }

    public function get()
    {
      $data = Array();
      $widget = new \Adminka\bricks\Users\widgets\Manage();
      return $widget->getContent();
    }
  }