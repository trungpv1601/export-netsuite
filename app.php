<?php

/**
 * trungpv
 * 
 * @author     trungpv <trungpv1601@gmail.com>
 */

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\Services\Customer;
use App\Services\SalesOrder;
use App\Services\Estimate;
use App\Services\Lead;
use App\Services\Opportunity;
use App\Services\Prospect;

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

$climate = new \League\CLImate\CLImate;

$featureOptions  = [
  'opportunity' => 'Opportunities',
  'estimate' => 'Quotes',
  'salesOrder' => 'Sales Orders',
  'lead' => 'Leads',
  'prospect' => 'Prospects',
  'customer' => 'Customers'
];
$input    = $climate->radio('Please send me one of the following:', $featureOptions);
$response = $input->prompt();

switch ($response) {
  case 'salesOrder':
    $ti = microtime(true);
    $soService = new SalesOrder();
    $soService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;
  case 'estimate':
    $ti = microtime(true);
    $estimateService = new Estimate();
    $estimateService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;
  case 'opportunity':
    $ti = microtime(true);
    $opportunityService = new Opportunity();
    $opportunityService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;

  case 'customer':
    $ti = microtime(true);
    $customerService = new Customer();
    $customerService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;

  case 'lead':
    $ti = microtime(true);
    $leadService = new Lead();
    $leadService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;

  case 'prospect':
    $ti = microtime(true);
    $prospectService = new Prospect();
    $prospectService->run();
    echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
    break;

  default:

    break;
}
