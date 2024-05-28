<?php

namespace App\Http\Controllers\Backend\MetaData\Pages;

use App\Http\Controllers\Backend\MetaData\MetaDataController;
use Illuminate\Http\Request;

class ElevatorServicesPageMetaController extends MetaDataController
{
    protected $viewName = 'metaData.index';
    protected $redirectUrl = 'admin/meta/pages/elevator-services';
    protected $pageTitle = 'Метаданные Страница: "Услуги элеватора"';
    protected $pageHeader = 'Метаданные Страница: "Услуги элеватора"';
    protected $pageId = 5;

    public function index()
    {
        return $this->getPage();
    }

    public function store(Request $request)
    {
        return $this->saveData($request);
    }
}
