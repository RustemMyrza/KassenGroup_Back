<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Backend\PageController;
use App\Models\Pages\ElevatorServicesPage;
use Illuminate\Http\Request;

class ElevatorServicesPageController extends PageController
{
    protected $modelClass = ElevatorServicesPage::class;
    protected $viewName = 'elevatorServicesPage';
    protected $redirectUrl = 'admin/page/elevatorServices';

    public function index (Request $request)
    {
        $data = $this->getPage($request);
        $pageContent = $data[0];
        $translatedData = $data[1];
        return view($this->viewName . '.index', compact('pageContent', 'translatedData'));
    }
    public function create ()
    {
        return view('elevatorServicesPage.create');
    }
    public function store (Request $request)
    {
        $this->saveData($request);
        return redirect($this->redirectUrl)->with('flash_message', 'Блок добавлен');
    }
    public function show ($id)
    {
        $data = $this->showPage($id);
        $image = $data[0];
        $translatedData = $data[1];
        return view($this->viewName . '.show', compact('image', 'translatedData', 'id'));
    }
    public function edit ($id)
    {
        $data = $this->editPage($id);
        $image = $data[0];
        $translatedData = $data[1];
        return view($this->viewName . '.edit', compact('image', 'translatedData', 'id'));
    }
    public function update (Request $request, $id)
    {
        $this->updateData($request, $id);
        return redirect($this->redirectUrl)->with('flash_message', 'Блок изменен');
    }
    public function destroy ($id)
    {
        $this->deleteData($id);
        return redirect($this->redirectUrl)->with('flash_message', 'Блок удален');
    }
}
