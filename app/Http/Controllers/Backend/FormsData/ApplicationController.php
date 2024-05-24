<?php

namespace App\Http\Controllers\Backend\FormsData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormsData\Application;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $applications = Application::where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $applications = Application::latest()->paginate($perPage);
        }
        // $this->getDataFromTable();
        return view('application.index', compact('applications'));
    }

    public function store (Request $request)
    {
        $requestData = $request->all();
        $application = new Application();
        $application->name = $requestData['name'];
        $application->phone = $requestData['phone'];
        $result = $application->save();
        return $result;
    }

    public function show ($id)
    {
        $application = Application::findOrFail($id);
        return view('application.show', compact('application'));
    }

    public function destroy ($id)
    {
        $application = Application::find($id);
        $application->delete();

        return redirect('admin/form/data/application')->with('flash_message', 'Блок удален');
    }
}
