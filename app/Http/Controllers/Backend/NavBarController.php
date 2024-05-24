<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NavBar;
use App\Models\Translate;
use Illuminate\Http\Request;

class NavBarController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $navbar = NavBar::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $navbar = NavBar::latest()->paginate($perPage);

        }
        $translatedData = Translate::all();
        return view('navbar.index', compact('navbar', 'translatedData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('navbar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $navbar = new Translate();
        $navbar->ru = $requestData['name']['ru'];
        $navbar->en = $requestData['name']['en'];
        $navbar->kz = $requestData['name']['kz'];
        $navbar->save();
        $navbarId = $navbar->id;

        $navbar= new NavBar();
        $navbar->name = $navbarId;
        $navbar->save();

        return redirect('admin/navbar')->with('flash_message', 'Блок добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $navbar = NavBar::findOrFail($id);
        $translatedName = Translate::findOrFail($navbar->name);
        return view('navbar.show', compact('navbar', 'translatedName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $navbar = NavBar::findOrFail($id);
        $translatedName = Translate::findOrFail($navbar->name);
        return view('navbar.edit', compact('navbar', 'translatedName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $navbar = NavBar::findOrFail($id);
        $requestData = $request->all();

        $translatedName = Translate::findOrFail($navbar->name);
        $translatedName->ru = $requestData['name']['ru'];
        $translatedName->en = $requestData['name']['en'];
        $translatedName->kz = $requestData['name']['kz'];
        $translatedName->update();
        $navbar->update();

        return redirect('admin/navbar')->with('flash_message', 'Блок изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $navbar = NavBar::find($id);
        $translatedName = Translate::findOrFail($navbar->name);
        $translatedName->delete();
        $navbar->delete();

        return redirect('admin/navbar')->with('flash_message', 'Блок удален');
    }
}
