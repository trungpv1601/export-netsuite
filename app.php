<?php

/**
 * trungpv
 * 
 * @author     trungpv <trungpv1601@gmail.com>
 */

require __DIR__ . '/vendor/autoload.php';

use App\Services\Service;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

$climate = new \League\CLImate\CLImate;

$options = [
  'ALL' => 'All',
  'SELECT' => 'One by One',
  'MULTIPLE' => 'Multiple'
];

$input    = $climate->radio('Please send me one of the following:', $options);
$response = $input->prompt();

$features = [
  'InventoryDetail' => [
    'class' => false
  ],
  'Entity' => [
    'class' => false
  ],
  'Contact' => [
    'class' => false
  ],
  'CalendarEvent' => [
    'class' => false
  ],
  'Task' => [
    'class' => false
  ],
  'Employee' => [
    'class' => false
  ],
  'PhoneCall' => [
    'class' => false
  ],
  'SupportCase' => [
    'class' => false
  ],
  'Message' => [
    'class' => false
  ],
  'Note' => [
    'class' => false
  ],
  'CustomRecord' => [
    'class' => false
  ],
  'Account' => [
    'class' => false
  ],
  'RevRecSchedule' => [
    'class' => false
  ],
  'RevRecTemplate' => [
    'class' => false
  ],
  'Bin' => [
    'class' => false
  ],
  'Department' => [
    'class' => false
  ],
  'Location' => [
    'class' => false
  ],
  'Classification' => [
    'class' => false
  ],
  'Transaction' => [
    'class' => false
  ],
  'Item' => [
    'class' => false
  ],
  'Partner' => [
    'class' => false
  ],
  'Vendor' => [
    'class' => false
  ],
  'SiteCategory' => [
    'class' => false
  ],
  'TimeBill' => [
    'class' => false
  ],
  'Solution' => [
    'class' => false
  ],
  'Topic' => [
    'class' => false
  ],
  'Subsidiary' => [
    'class' => false
  ],
  'GiftCertificate' => [
    'class' => false
  ],
  'Folder' => [
    'class' => false
  ],
  'File' => [
    'class' => false
  ],
  'Job' => [
    'class' => false
  ],
  'Issue' => [
    'class' => false
  ],
  'GroupMember' => [
    'class' => false
  ],
  'Campaign' => [
    'class' => false
  ],
  'EntityGroup' => [
    'class' => false
  ],
  'PromotionCode' => [
    'class' => false
  ],
  'Budget' => [
    'class' => false
  ],
  'ProjectTask' => [
    'class' => false
  ],
  'ProjectTaskAssignment' => [
    'class' => false
  ],
  'AccountingPeriod' => [
    'class' => false
  ],
  'ContactCategory' => [
    'class' => false
  ],
  'ContactRole' => [
    'class' => false
  ],
  'CustomerCategory' => [
    'class' => false
  ],
  'CustomerStatus' => [
    'class' => false
  ],
  'ExpenseCategory' => [
    'class' => false
  ],
  'JobStatus' => [
    'class' => false
  ],
  'JobType' => [
    'class' => false
  ],
  'NoteType' => [
    'class' => false
  ],
  'PartnerCategory' => [
    'class' => false
  ],
  'PaymentMethod' => [
    'class' => false
  ],
  'PriceLevel' => [
    'class' => false
  ],
  'SalesRole' => [
    'class' => false
  ],
  'Term' => [
    'class' => false
  ],
  'VendorCategory' => [
    'class' => false
  ],
  'WinLossReason' => [
    'class' => false
  ],
  'OriginatingLead' => [
    'class' => false
  ],
  'UnitsType' => [
    'class' => false
  ],
  'CustomList' => [
    'class' => false
  ],
  'PricingGroup' => [
    'class' => false
  ],
  'InventoryNumber' => [
    'class' => false
  ],
  'InventoryNumberBin' => [
    'class' => false
  ],
  'ItemBinNumber' => [
    'class' => false
  ],
  'Pricing' => [
    'class' => false
  ],
  'Nexus' => [
    'class' => false
  ],
  'OtherNameCategory' => [
    'class' => false
  ],
  'CustomerMessage' => [
    'class' => false
  ],
  'ItemDemandPlan' => [
    'class' => false
  ],
  'ItemSupplyPlan' => [
    'class' => false
  ],
  'CurrencyRate' => [
    'class' => false
  ],
  'ItemRevision' => [
    'class' => false
  ],
  'CouponCode' => [
    'class' => false
  ],
  'PayrollItem' => [
    'class' => false
  ],
  'ManufacturingCostTemplate' => [
    'class' => false
  ],
  'ManufacturingRouting' => [
    'class' => false
  ],
  'ManufacturingOperationTask' => [
    'class' => false
  ],
  'ResourceAllocation' => [
    'class' => false
  ],
  'Charge' => [
    'class' => false
  ],
  'BillingSchedule' => [
    'class' => false
  ],
  'GlobalAccountMapping' => [
    'class' => false
  ],
  'ItemAccountMapping' => [
    'class' => false
  ],
  'TimeEntry' => [
    'class' => false
  ],
  'TimeSheet' => [
    'class' => false
  ],
  'AccountingTransaction' => [
    'class' => false
  ],
  'Address' => [
    'class' => false
  ],
  'BillingAccount' => [
    'class' => false
  ],
  'FairValuePrice' => [
    'class' => false
  ],
  'Usage' => [
    'class' => false
  ],
  'CostCategory' => [
    'class' => false
  ],
  'ConsolidatedExchangeRate' => [
    'class' => false
  ],
  'TaxDetail' => [
    'class' => false
  ],
  'TaxGroup' => [
    'class' => false
  ],
  'SalesTaxItem' => [
    'class' => false
  ],
  'TaxType' => [
    'class' => false
  ],
  'Paycheck' => [
    'class' => false
  ],
  'HcmJob' => [
    'class' => false
  ],
  'Bom' => [
    'class' => false
  ],
  'BomRevision' => [
    'class' => false
  ],
  'BomRevisionComponent' => [
    'class' => false
  ],
  'InboundShipment' => [
    'class' => false
  ],
  'AssemblyItemBom' => [
    'class' => false
  ],
  'MseSubsidiary' => [
    'class' => false
  ],
  'EntityTaxRegistration' => [
    'class' => false
  ],
  'MerchandiseHierarchyNode' => [
    'class' => false
  ],
  'CustomerSubsidiaryRelationship' => [
    'class' => false
  ],
  'VendorSubsidiaryRelationship' => [
    'class' => false
  ],
  'Opportunity' => [
    'class' => false
  ],
  'Estimate' => [
    'class' => true
  ],
  'SalesOrder' => [
    'class' => true
  ],
  'Lead' => [
    'class' => true
  ],
  'Prospect' => [
    'class' => true
  ],
  'Customer' => [
    'class' => true
  ],
];

$featureOptions  = [];
array_walk($features, function ($value, $key) use (&$featureOptions) {
  $featureOptions[] = $key;
});

if ($response == 'ALL') {
  $ti = microtime(true);
  $excludes = ['Opportunity', 'Estimate', 'SalesOrder', 'Lead', 'Prospect', 'Customer'];
  $all = array_diff($featureOptions, $excludes);
  for ($i = 0; $i < count($all); $i++) {
    $feature = $all[$i];
    $climate->border('*');
    $climate->blue($feature . ' Downloading ...');
    if ($features[$feature]['class']) {
      $class = '\\App\\Services\\' . $feature;
      $service = new $class();
      $service->getAll();
    } else {
      $service = new Service($feature);
      $service->getAll();
    }
  }
  echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
} else if ($response == 'MULTIPLE') {
  $input    = $climate->checkboxes('Please send me all of the following:', $featureOptions);
  $response = $input->prompt();
  $ti = microtime(true);
  for ($i = 0; $i < count($response); $i++) {
    $feature = $response[$i];
    $climate->border('*');
    $climate->blue($feature . ' Downloading ...');
    if ($features[$feature]['class']) {
      $class = '\\App\\Services\\' . $feature;
      $service = new $class();
      $service->getAll();
    } else {
      $service = new Service($feature);
      $service->getAll();
    }
  }
  echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
} else {
  $input    = $climate->radio('Please send me one of the following:', $featureOptions);
  $response = $input->prompt();

  $ti = microtime(true);
  if ($features[$response]['class']) {
    $class = '\\App\\Services\\' . $response;
    $service = new $class();
    $service->run();
  } else {
    $service = new Service($response);
    $service->run();
  }
  echo sprintf("*** Finished in %01.1f mins *** \n", (microtime(true) - $ti) / 60);
}
