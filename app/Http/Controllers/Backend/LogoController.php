<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $logo = Logo::where('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $logo = Logo::latest()->paginate($perPage);
        }
        // $this->getDataFromTable();
        return view('logo.index', compact('logo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('logo.create');
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
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'image.required' => 'Изображение для блока обязательно',
                'image.mimes' => 'Проверьте формат изображения',
                'image.max' => 'Размер файла не может превышать 2МБ'
            ]);

        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request->file('image'));
        }

        $logo= new Logo();
        $logo->logo = $path ?? null;
        $logo->save();

        return redirect('admin/logo')->with('flash_message', 'Блок добавлен');
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
        $logo = Logo::findOrFail($id);
        return view('logo.show', compact('logo'));
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
        $logo = Logo::findOrFail($id);
        return view('logo.edit', compact('logo'));
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
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ],
            [
                'image.mimes' => 'Проверьте формат изображения',
                'image.max' => 'Размер файла не может превышать 3МБ'
            ]);

        $logo = Logo::findOrFail($id);
        if ($request->hasFile('image')) 
        {
            $path = $this->uploadImage($request->file('image'));
            $logo->logo = $path;
        }
        $logo->update();

        return redirect('admin/logo')->with('flash_message', 'Блок изменен');
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
        $logo = Logo::find($id);
        if ($logo->logo != null) {
            unlink($logo->logo);
        }
        $logo->delete();

        return redirect('admin/logo')->with('flash_message', 'Блок удален');
    }
}
