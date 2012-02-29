<?php

  namespace MB;

  abstract class Widget extends Diagnostics
  {
    private $content = '';
    protected $path;
    protected $name;

    final public function __construct()
    {
      $data = $this->prepare( func_get_args() );
      if( is_array( $data ) )
      {
        extract( $data );
      }

      ob_start();
      if( file_exists( $this->path . "/templates/" . $this->name . ".tpl.php" ) )
      {
        require $this->path . "/templates/" . $this->name . ".tpl.php";
      }
      $this->content = ob_get_contents();
      ob_end_clean();
    }

    final public function getContent()
    {
      return $this->content;
    }

    abstract protected  function prepare();
  }

