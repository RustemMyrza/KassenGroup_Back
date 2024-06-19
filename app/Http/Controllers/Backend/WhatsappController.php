<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Whatsapp;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function edit ()
    {
        $whatsappData = Whatsapp::first();
        return view('whatsapp.index', compact('whatsappData'));
    }

    public function update (Request $request)
    {
        $requestData = $request->all();
        $whatsappData = Whatsapp::first();
        if (isset($whatsappData))
        {
            $whatsappData->link = $requestData['link'];
            $whatsappData->update();
        }
        else
        {
            $newWhatsappData = new Whatsapp();
            $newWhatsappData->link = $requestData['link'];
            $newWhatsappData->save();
        }
        return redirect()->back()->with('success', 'Изменения сохранены');;
    }
}
