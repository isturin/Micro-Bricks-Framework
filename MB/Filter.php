<?php

  namespace MB;

  abstract class Filter extends Diagnostics
  {
    abstract public function apply();
  }

