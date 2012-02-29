<?php

  namespace Adminka\models;

  class User extends \MB\Model
  {
    static public function getList()
    {
      return self::dbGetItems( "SELECT * FROM mb_users;" );
    }
  }