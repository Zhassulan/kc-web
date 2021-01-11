<?php


namespace lib;


class AU04RowsData
{

  public $legalCode;
  public $bin;
  public $name;
  public $accCodeG;
  public $accCodeP;

  /**
   * AU04RowsData constructor.
   * @param $legalCode
   * @param $bin
   * @param $name
   * @param $accCodeG
   * @param $accCodeP
   */
  public function __construct($legalCode, $bin, $name, $accCodeG, $accCodeP)
  {
    $this->legalCode = $legalCode;
    $this->bin = $bin;
    $this->name = $name;
    $this->accCodeG = $accCodeG;
    $this->accCodeP = $accCodeP;
  }
}
