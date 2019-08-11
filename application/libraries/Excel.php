//path application/third_party/Excel.php
2
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
3
  
4
require_once APPPATH."/third_party/PHPExcel/Classes/PHPExcel.php";
5
  
6
class Excel extends PHPExcel {
7
    public function __construct() {
8
        parent::__construct();
9
    }
10
}
