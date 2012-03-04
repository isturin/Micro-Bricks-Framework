<?php

  /**
   *
   */
  final class Adminka extends MB\WebApplication
  {
    /**
     * @var string
     */
    protected $name = 'Adminka';

    /**
     * @var int
     */
    protected $mode = APPLICATION_MODE_DEVELOP;

    /**
     * @var array
     */
    protected $map = Array(
      'root' => Array(
        '*:/^.*$/' => 'Users'
      ),
      '*' => Array(
        '*:/^.*$/' => 'Errors'
      )
    );
  }