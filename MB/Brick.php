<?php

  namespace MB;

  /**
   *
   */
  abstract class Brick
  {
    /**
     * @var array
     */
    protected $map = Array();

    /**
     * @var array
     */
    protected $actions = Array();

    /**
     * @var array
     */
    protected $scripts = Array();

    /**
     * @return string
     */
    public function getActionName()
    {
      $actionName = '';

      foreach( $this->map AS $mask => $tmpActionName )
      {
        if( preg_match( $mask, $_SERVER['REQUEST_URI'] ) )
        {
          $actionName = $tmpActionName;
          break;
        }
      }

      return $actionName;
    }

    /**
     * @param $name
     * @param $template
     * @param string $label
     * @param string $title
     */
    final protected function setAction( $name, $template, $label = '', $title = '' )
    {
      $this->actions[$name] = Array(
        'template' => $template,
        'label'    => $label,
        'title'    => $title
      );
    }

    /**
     * @param $actionName
     * @param array $params
     */
    final public function getActionUrl( $actionName, $params = Array() )
    {

    }

    /**
     * @param $actionName
     * @param array $params
     */
    final public function getActionLabel( $actionName, $params = Array() )
    {

    }

    /**
     * @param $actionName
     * @param array $params
     */
    final public function getActionTitle( $actionName, $params = Array() )
    {

    }
  }

