<?php

namespace App\Http\Controllers\Backend\MetaData\Pages;

use App\Http\Controllers\Backend\MetaData\MetaDataController;
use Illuminate\Http\Request;

class ContactsPageMetaController extends MetaDataController
{
    protected $viewName = 'metaData.index';
    protected $redirectUrl = 'admin/meta/pages/contacts';
    protected $pageTitle = 'Метаданные Страница: "Контакты"';
    protected $pageHeader = 'Метаданные Страница: "Контакты"';
    protected $pageId = 6;

    public function index()
    {
        return $this->getPage();
    }

    public function store(Request $request)
    {
        return $this->saveData($request);
    }
}
