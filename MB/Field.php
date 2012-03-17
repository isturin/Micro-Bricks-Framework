<?php

  namespace MB;

  /**
   *
   */
  class Field
  {
    /**
     * @var array
     */
    private $validators;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @param string $name
     * @param string $label
     * @param array $validators
     */
    public function __construct( \string $name, \string $label, array $validators = Array() )
    {
      $this->name = $name;
      $this->label = $label;
      $this->$validators = $validators;
    }


  }