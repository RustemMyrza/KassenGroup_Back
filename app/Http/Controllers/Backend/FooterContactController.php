<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterContact;
use App\Models\Translate;

class FooterContactController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 25;
        $contactText = FooterContact::latest()->paginate($perPage);
        $translatedData = Translate::all();
        return view('footerContact.index', compact('contactText', 'translatedData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('footerContact.create');
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

        $contactText = new Translate();
        $contactText->ru = $requestData['text']['ru'];
        $contactText->en = $requestData['text']['en'];
        $contactText->kz = $requestData['text']['kz'];
        $contactText->save();
        $contactTextId = $contactText->id;

        $contactText= new FooterContact();
        $contactText->text = $contactTextId;
        $contactText->save();

        return redirect('admin/footer-contact')->with('flash_message', 'Блок добавлен');
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
        $contactText = FooterContact::findOrFail($id);
        $translatedText = Translate::findOrFail($contactText->text);
        return view('footerContact.show', compact('contactText', 'translatedText'));
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
        $contactText = FooterContact::findOrFail($id);
        $translatedText = Translate::findOrFail($contactText->text);
        return view('footerContact.edit', compact('contactText', 'translatedText'));
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
        $contactText = FooterContact::findOrFail($id);
        $requestData = $request->all();

        $translatedText = Translate::findOrFail($contactText->text);
        $translatedText->ru = $requestData['text']['ru'];
        $translatedText->en = $requestData['text']['en'];
        $translatedText->kz = $requestData['text']['kz'];
        $translatedText->update();
        $contactText->update();

        return redirect('admin/footer-contact')->with('flash_message', 'Блок изменен');
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
        $contactText = FooterContact::find($id);
        $translatedText = Translate::findOrFail($contactText->text);
        $translatedText->delete();
        $contactText->delete();

        return redirect('admin/footer-contact')->with('flash_message', 'Блок удален');
    }
}
