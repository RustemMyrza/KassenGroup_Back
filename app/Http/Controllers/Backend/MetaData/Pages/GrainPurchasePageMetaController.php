<?php

namespace App\Http\Controllers\Backend\MetaData\Pages;

use App\Http\Controllers\Backend\MetaData\MetaDataController;
use Illuminate\Http\Request;

class GrainPurchasePageMetaController extends MetaDataController
{
    protected $viewName = 'metaData.index';
    protected $redirectUrl = 'admin/meta/pages/grain-purchase';
    protected $pageTitle = 'Метаданные Страница: "Закуп зерна"';
    protected $pageHeader = 'Метаданные Страница: "Закуп зерна"';
    protected $pageId = 4;

    public function index()
    {
        return $this->getPage();
    }

    public function store(Request $request)
    {
        return $this->saveData($request);
    }
}
