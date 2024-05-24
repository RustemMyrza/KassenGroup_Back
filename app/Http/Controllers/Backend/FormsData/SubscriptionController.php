<?php

namespace App\Http\Controllers\Backend\FormsData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormsData\Subscription;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $subscriptions = Subscription::where('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $subscriptions = Subscription::latest()->paginate($perPage);
        }
        // $this->getDataFromTable();
        return view('subscription.index', compact('subscriptions'));
    }

    public function store (Request $request)
    {
        $requestData = $request->all();
        $subscription = new Subscription();
        $subscription->email = $requestData['email'];
        $result = $subscription->save();
        return $result;
    }

    public function show ($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription.show', compact('subscription'));
    }

    public function destroy ($id)
    {
        $subscription = Subscription::find($id);
        $subscription->delete();

        return redirect('admin/form/data/subscription')->with('flash_message', 'Блок удален');
    }
}
