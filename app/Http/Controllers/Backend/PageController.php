<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Translate;
use Illuminate\Http\Request;

abstract class PageController extends Controller
{
    protected $modelClass;
    protected $viewName;
    protected $redirectUrl;

    abstract public function index(Request $request);
    abstract public function create();
    abstract public function store(Request $request);
    abstract public function show($id);
    abstract public function edit($id);
    abstract public function update(Request $request, $id);
    abstract public function destroy($id);

    protected function getPage (Request $request)
    {
        $modelClass = $this->modelClass;
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pageContent = $modelClass::where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pageContent = $modelClass::latest()->paginate($perPage);
            $translatedData = Translate::all();
        }
        return [$pageContent, $translatedData];

    }

    protected function saveData (Request $request)
    {
        $modelClass = $this->modelClass;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:102400',
        ],
            [
                'image.required' => 'Изображение для блока обязательно',
                'image.mimes' => 'Проверьте формат изображения',
                'image.max' => 'Размер файла не может превышать 3МБ'
            ]);
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request->file('image'));
        }

        $title = new Translate();
        $title->ru = $requestData['title']['ru'];
        $title->en = $requestData['title']['en'];
        $title->kz = $requestData['title']['kz'];
        $title->save();
        $titleId = $title->id;

        $content = new Translate();
        $content->ru = $requestData['content']['ru'];
        $content->en = $requestData['content']['en'];
        $content->kz = $requestData['content']['kz'];
        $content->save();
        $contentId = $content->id;

        $document= new $modelClass();
        $document->title = $titleId;
        $document->content = $contentId;
        $document->image = $path ?? null;
        $document->save();
    }

    protected function showPage ($id)
    {
        $modelClass = $this->modelClass;
        $pageContent = $modelClass::findOrFail($id);
        $image = $pageContent->image;
        $translatedData['title'] = Translate::findOrFail($pageContent->title);
        $translatedData['content'] = Translate::findOrFail($pageContent->content);
        return [$image, $translatedData];
    }

    protected function editPage ($id)
    {
        $modelClass = $this->modelClass;
        $pageContent = $modelClass::findOrFail($id);
        $image = $pageContent->image;
        $translatedData['title'] = Translate::findOrFail($pageContent->title);
        $translatedData['content'] = Translate::findOrFail($pageContent->content);
        return [$image, $translatedData];
    }

    protected function updateData (Request $request, $id)
    {
        $modelClass = $this->modelClass;
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'image.mimes' => 'Проверьте формат изображения',
                'image.max' => 'Размер файла не может превышать 2МБ'
            ]);

        $requestData = $request->all();
        $pageContent = $modelClass::findOrFail($id);
        if ($request->hasFile('image')) 
        {
            $path = $this->uploadImage($request->file('image'));
            $pageContent->image = $path;
        }

        $title = Translate::find($pageContent->title);
        $title->ru = $requestData['title']['ru'];
        $title->en = $requestData['title']['en'];
        $title->kz = $requestData['title']['kz'];
        $title->update();

        $content = Translate::find($pageContent->content);
        $content->ru = $requestData['content']['ru'];
        $content->en = $requestData['content']['en'];
        $content->kz = $requestData['content']['kz'];
        $content->update();

        $pageContent->update();
    }


    protected function deleteData ($id)
    {
        $modelClass = $this->modelClass;
        $pageContent = $modelClass::find($id);
        if ($pageContent->image != null) 
        {
            unlink($pageContent->image);
        }
        $title = Translate::find($pageContent->title);
        $content = Translate::find($pageContent->content);
        $title->delete();
        $content->delete();
        $pageContent->delete();
    }
}
