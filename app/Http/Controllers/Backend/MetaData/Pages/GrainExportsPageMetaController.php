<?php

namespace App\Http\Controllers\Backend\MetaData\Pages;

use App\Http\Controllers\Backend\MetaData\MetaDataController;
use Illuminate\Http\Request;

class GrainExportsPageMetaController extends MetaDataController
{
    protected $viewName = 'metaData.index';
    protected $redirectUrl = 'admin/meta/pages/grain-exports';
    protected $pageTitle = 'Метаданные Страница: "Экспорт зерна"';
    protected $pageHeader = 'Метаданные Страница: "Экспорт зерна"';
    protected $pageId = 3;

    public function index()
    {
        return $this->getPage();
    }

    public function store(Request $request)
    {
        return $this->saveData($request);
    }
}
