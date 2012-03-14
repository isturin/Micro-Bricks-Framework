<?php

  namespace MB;

  abstract class Action
  {
    /**
     * @var Filter[]
     */
    protected $filters = Array();

    /**
     * @var Brick
     */
    public $brick;

    final public function __construct()
    {
      //todo
    }

    public function get()
    {

    }

    public function post()
    {

    }

    public function async()
    {

    }

    public function applyFilters()
    {
      $status = true;

      foreach( $this->filters as $filter )
      {
        $status &= $filter->apply();
        if( !$status )
        {
          break;
        }
      }

      return $status;
    }

    final protected function setFilter( Filter $filter )
    {
      $this->filters[] = $filter;
    }

    final public function loadBrick( Brick $brick )
    {
      $this->brick = $brick;
    }

    abstract function setFilters();
  }