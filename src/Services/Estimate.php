<?php

namespace App\Services;

use NetSuite\Classes\SearchStringField;
use NetSuite\Classes\TransactionSearchBasic;

class Estimate extends Service
{
  protected $type = 'estimate';

  /**
   * getBasicSearch function
   *
   * @return void
   */
  public function getBasicSearch()
  {
    $recordTypeSearchField = new SearchStringField();
    $recordTypeSearchField->operator = "is";
    $recordTypeSearchField->searchValue = $this->type;

    $transactionSearch = new TransactionSearchBasic();
    $transactionSearch->recordType = $recordTypeSearchField;
    // $transactionSearch->isInactive = array('searchValue' => 'TRUE');
    return $transactionSearch;
  }
}
