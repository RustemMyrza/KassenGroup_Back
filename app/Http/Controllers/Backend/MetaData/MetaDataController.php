<?php

namespace App\Http\Controllers\Backend\MetaData;

use App\Http\Controllers\Controller;
use App\Models\MetaData;
use Illuminate\Http\Request;

abstract class MetaDataController extends Controller
{
    protected $redirectUrl;
    protected $viewName;
    protected $pageTitle;
    protected $pageHeader;
    protected $pageId;

    abstract public function index();
    abstract public function store(Request $request);

    protected function getPage()
    {
        $modelClass = MetaData::class;
        $viewName = $this->viewName;
        $pageTitle = $this->pageTitle;
        $pageHeader = $this->pageHeader;
        $redirectUrl = $this->redirectUrl;
        $pageId = $this->pageId;
        $formAction = url($redirectUrl);
        $metaData = $modelClass::where('page_id', $pageId)->first();
        return view($viewName, compact([
            'metaData',
            'pageTitle',
            'pageHeader',
            'formAction'
        ]));
    }

    protected function saveData(Request $request)
    {
        $modelClass = MetaData::class;
        $redirectUrl = $this->redirectUrl;
        $pageId = $this->pageId;
        $requestData = $request->all();
        foreach($requestData as $key => $value)
        {
            if ($key != '_token' && $key != 'name' && $key != 'description')
            {
                if ($value != '')
                {
                    $keywords[] = $value; 
                }
            }
        }
        $metaData = $modelClass::where('page_id', $pageId)->first();
        if ($metaData) {
            $metaData->name = $requestData['name'];
            $metaData->description = $requestData['description'];
            $metaData->keyword = implode(', ', $keywords);
            $metaData->page_id = $pageId;
            $metaData->update();
        } else {
            $newMetaData = new $modelClass;
            $newMetaData->name = $requestData['name'];
            $newMetaData->description = $requestData['description'];
            $newMetaData->keyword = implode(', ', $keywords);
            $newMetaData->page_id = $pageId;
            $newMetaData->save();
        }

        return redirect($redirectUrl)->with('success', 'Изменения сохранены');

    }
}
