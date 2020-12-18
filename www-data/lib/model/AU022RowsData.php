<?php


namespace lib;


class AU022RowsData
{

  public $account;
  public $amount;

  /**
   * AU022RowsData constructor.
   * @param $account
   * @param $amount
   */
  public function __construct($account, $amount)
  {
    $this->account = $account;
    $this->amount = $amount;
  }


}