<?php


namespace lib;


class AU021RowsData
{

    public $account;
    public $lot;
    public $amount;

    /**
     * AU021RowsData constructor.
     * @param $account
     * @param $lot
     * @param $amount
     */
    public function __construct($account, $lot, $amount)
    {
        $this->account = $account;
        $this->lot = $lot;
        $this->amount = $amount;
    }


}