<?php

namespace App\Services;

use Dotenv\Dotenv;
use NetSuite\Classes\GetRequest;
use NetSuite\Classes\RecordRef;
use NetSuite\Classes\SearchMoreWithIdRequest;
use NetSuite\Classes\SearchRequest;
use League\CLImate\CLImate;
use NetSuite\NetSuiteService;

class Service
{
  protected $type = 'recordType';
  protected $path;
  protected $service;
  protected $climate;
  private $config;

  /**
   * __construct function
   */
  public function __construct($type = false)
  {
    $this->config = array(
      // required -------------------------------------
      "endpoint" => "2019_1",
      "host"     => "https://webservices.netsuite.com",
      "email"    => getenv('EMAIL'),
      "password" => getenv('PASSWORD'),
      "role"     => getenv('ROLE'),
      "account"  => getenv('ACCOUNT'),
      "app_id"   => getenv('APP_ID'),
      // optional -------------------------------------
      "logging"  => false,
      "log_path" => "./logs"
    );

    $this->service = new NetSuiteService($this->config);
    $this->climate = new CLImate;
    if ($type) {
      $this->type = lcfirst($type);
    }
    $this->path = './data' . '/' . $this->type . '-' . date("Y-m-d");
    //Check if the directory already exists.
    if (!is_dir($this->path)) {
      //Directory does not exist, so lets create it.
      mkdir($this->path, 0777, true);
    }
  }

  /**
   * getType function
   *
   * @return void
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * setType function
   *
   * @param [type] $type
   * @return void
   */
  public function setType($type)
  {
    $this->type = lcfirst($type);
  }

  /**
   * getBasicSearch function
   *
   * @return void
   */
  public function getBasicSearch()
  {
    $class = '\\NetSuite\\Classes\\' . ucfirst($this->type) . 'SearchBasic';
    $searchBasic = new $class();

    return $searchBasic;
  }

  /**
   * get function
   *
   * @param [type] $id
   * @return void
   */
  public function get($id)
  {
    $request = new GetRequest();
    $request->baseRef = new RecordRef();
    $request->baseRef->internalId = $id;
    $request->baseRef->type = $this->type;

    $getResponse = $this->service->get($request);

    if ($getResponse->readResponse->status->isSuccess) {
      $record = $getResponse->readResponse->record;
      return json_encode($record);
    }

    return false;
  }

  /**
   * getListInfo function
   *
   * @return void
   */
  public function getListInfo()
  {
    $this->service->setSearchPreferences(false, 10);

    $request = new SearchRequest();

    $searchRecord = $this->getBasicSearch();
    if ($searchRecord) {
      $request->searchRecord = $searchRecord;
    }

    $searchResponse = $this->service->search($request);
    if ($searchResponse->searchResult->status->isSuccess) {
      return $searchResponse->searchResult;
    }
    return false;
  }

  /**
   * List All function
   *
   * @return void
   */
  public function getAll()
  {
    $this->service->setSearchPreferences(false, 10);

    $request = new SearchRequest();

    $searchRecord = $this->getBasicSearch();
    if ($searchRecord) {
      $request->searchRecord = $searchRecord;
    }

    $searchResponse = $this->service->search($request);
    if ($searchResponse->searchResult->status->isSuccess) {
      $totalPages = $searchResponse->searchResult->totalPages;
      if ($totalPages > 0) {
        $progress = $this->climate->progress()->total($totalPages);
        $progress->current(1);
        $searchId = $searchResponse->searchResult->searchId;
        $pageIndex = $searchResponse->searchResult->pageIndex;
        file_put_contents($this->path . '/1.json', json_encode($searchResponse->searchResult->recordList->record));
        for ($i = $pageIndex; $i <= $totalPages; $i++) {
          try {
            $progress->current($i);
            $data = $this->getAllBySearchId($searchId, $i);
            file_put_contents($this->path . '/' . $i . '.json', json_encode($data));
          } catch (\Exception $e) {
            error_log('Type: ' . $this->type . ' - Page: '. $i . ' - Total: ' . $totalPages);
            error_log($e);
          }
        }
      }
    }
  }

  /**
   * getAllBySearchId function
   *
   * @param [type] $searchId
   * @param [type] $page
   * @return void
   */
  public function getAllBySearchId($searchId, $page)
  {
    $result = [];
    if (!empty($searchId)) {
      $searchMoreWithIdRequest = new SearchMoreWithIdRequest();
      $searchMoreWithIdRequest->searchId = $searchId;
      $searchMoreWithIdRequest->pageIndex = $page;
      $searchResponse = $this->service->searchMoreWithId($searchMoreWithIdRequest);
      if ($searchResponse->searchResult->status->isSuccess) {
        return $searchResponse->searchResult->recordList->record;
      }
    }

    return $result;
  }

  /**
   * run function
   *
   * @return void
   */
  public function run()
  {
    $featureOptions  = [
      'ALL' => 'Get All',
      'LAST' => 'Get Last x pages',
      'GET' => 'Get record',
      'GET_INFO' => 'Get info',
    ];
    $input    = $this->climate->radio('Please send me one of the following:', $featureOptions);
    $option = $input->prompt();

    switch ($option) {
      case 'ALL':
        $this->climate->border('*');
        $this->getAll();
        break;
      case 'LAST':
        $this->climate->border('*');
        $this->climate->blue('Loading ...');
        $res = $this->getListInfo();
        if ($res) {
          $totalPages = $res->totalPages;
          $totalRecords = $res->totalRecords;
          $searchId = $res->searchId;
          $input = $this->climate->input('How many page? (Total: ' . $totalRecords . ' records with ' . $totalPages . ' pages): ');
          $num = $input->prompt();
          $progress = $this->climate->progress()->total($num);
          $index = 1;
          $pageIndex = $totalPages - $num - 1;
          for ($i = $pageIndex; $i <= $totalPages; $i++) {
            $data = $this->getAllBySearchId($searchId, $i);
            file_put_contents($this->path . '/' . $i . '.json', json_encode($data));
            $progress->current($index);
            $index++;
          }
        } else {
          $this->climate->red('Something went wrong.');
        }
        break;
      case 'GET_INFO':
        $this->climate->border('*');
        $this->climate->blue('Loading ...');
        $res = $this->getListInfo();
        if ($res) {
          $this->climate->dump($res);
        } else {
          $this->climate->red('Something went wrong.');
        }
        break;
      case 'GET':
        $this->climate->border('*');
        $input = $this->climate->input('Please input Internal ID?');
        $id = $input->prompt();
        $data = $this->get($id);
        if ($data) {
          $this->climate->json(json_decode($data));
        } else {
          $this->climate->red('Record not found.');
        }
        break;
      default:
        $this->climate->red('You have nothing ;).');
        break;
    }
  }
}
