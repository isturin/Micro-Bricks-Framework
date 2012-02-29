<?php

  namespace MB;

  abstract class Brick extends Diagnostics
  {
    protected $map = Array();
    private $actions = Array();

    final public function __construct()
    {
      $this->setMap();
      $this->setActions();
    }

    abstract protected function setMap();

    abstract protected function setActions();

    public function getActionName()
    {
      $actionName = '';

      foreach( $this->map AS $mask => $tmpActionName )
      {
        if( preg_match( $mask, $_SERVER['REQUEST_URI'] ) )
        {
          $actionName = ucfirst( $tmpActionName );
          break;
        }
      }

      return $actionName;
    }

    final protected function setAction( $name, $template, $label = '', $title = '', $mode = ACTION_MODE_ROOT )
    {
      $this->actions[$name] = Array(
        'template' => $template,
        'mode'     => $mode,
        'label'    => $label,
        'title'    => $title
      );
    }

    final public function getActionUrl( $actionName, $params = Array() )
    {

    }

    final public function getActionLabel( $actionName, $params = Array() )
    {

    }

    final public function getActionTitle( $actionName, $params = Array() )
    {

    }
  }

