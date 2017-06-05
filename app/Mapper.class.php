<?php
/**
* Created by HIR0Y0SHI on 2017/06/05
*/

namespace App;

abstract class Mapper {
  protected $db;
  public function __construct($db) {
    $this->db = $db;
  }
}