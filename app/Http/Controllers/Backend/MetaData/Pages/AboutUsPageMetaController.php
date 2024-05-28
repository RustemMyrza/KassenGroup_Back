<?php

namespace App\Http\Controllers\Backend\MetaData\Pages;

use App\Http\Controllers\Backend\MetaData\MetaDataController;
use Illuminate\Http\Request;

class AboutUsPageMetaController extends MetaDataController
{
    protected $viewName = 'metaData.index';
    protected $redirectUrl = 'admin/meta/pages/about-us';
    protected $pageTitle = 'Метаданные Страница: "О Компании"';
    protected $pageHeader = 'Метаданные Страница: "О Компании"';
    protected $pageId = 2;

    public function index()
    {
        return $this->getPage();
    }

    public function store(Request $request)
    {
        return $this->saveData($request);
    }
}
