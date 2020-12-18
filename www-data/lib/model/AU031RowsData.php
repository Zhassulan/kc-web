<?php


namespace lib;


class AU031RowsData
{

  public $fromLegalCode;
  public $toLegalCode;
  public $amount;

  /**
   * AU031RowsData constructor.
   * @param $fromLegalCode
   * @param $toLegalCode
   * @param $amount
   */
  public function __construct($fromLegalCode, $toLegalCode, $amount)
  {
    $this->fromLegalCode = $fromLegalCode;
    $this->toLegalCode = $toLegalCode;
    $this->amount = $amount;
  }

}