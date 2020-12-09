<?php
namespace lib;

class AU032RowsData
{
  public $minus;
  public $plus;
  public $lot;
  public $amount;

  /**
   * AU032RowsData constructor.
   * @param $minus
   * @param $plus
   * @param $lot
   * @param $amount
   */
  public function __construct($minus, $plus, $lot, $amount)
  {
    $this->minus = $minus;
    $this->plus = $plus;
    $this->lot = $lot;
    $this->amount = $amount;
  }


}