<?php

namespace App\Services;

use NetSuite\Classes\OpportunitySearchBasic;

class Opportunity extends Service
{
  protected $type = 'opportunity';

  /**
   * getBasicSearch function
   *
   * @return void
   */
  public function getBasicSearch()
  {
    $opportunitySearchBasic = new OpportunitySearchBasic();
    return $opportunitySearchBasic;
  }
}
