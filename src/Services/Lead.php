<?php

namespace App\Services;

use NetSuite\Classes\CustomerSearchBasic;
use NetSuite\Classes\SearchEnumMultiSelectField;

class Lead extends Service
{
  protected $type = 'lead';

  /**
   * getBasicSearch function
   *
   * @return void
   */
  public function getBasicSearch()
  {
    $stageSearchEnumMultiSelectField = new SearchEnumMultiSelectField();
    $stageSearchEnumMultiSelectField->operator = "anyOf";
    $stageSearchEnumMultiSelectField->searchValue = $this->type;

    $customerSearchBasic = new CustomerSearchBasic();
    $customerSearchBasic->stage = $stageSearchEnumMultiSelectField;
    // $customerSearchBasic->isInactive = array('searchValue' => 'TRUE');
    return $customerSearchBasic;
  }
}
