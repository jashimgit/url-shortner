<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     *  load admin dashboard 
     */
    public function  index()
    {
        return view('admin/dashboard');
    }

    /**
     *   GET
     */
    public function create()
    {
        $links = Link::where('created_by', Auth::user()->id)->orderBy('id', 'DESC')->get();


        return view('admin/create-link', ['links' => $links]);
    }

    public function store(Request $request)
    {
        $newRow = new Link();
        $newRow->link_hash = $this->generateRandomString(6);
        $newRow->redirect_to = $request->redirect_to;
        $newRow->created_by = Auth::user()->id;
        // $newRow->created_by = 1;
        $newRow->status = 1;
        $newRow->save();

        return redirect()->back()->with('message', 'success');
    }


    public function report($hash)
    {
        $data = Link::where('link_hash', $hash)->first();
        // dd($data);
        $todayVisits = Visit::where('link_hash', $hash)->whereDate('created_at', Carbon::now()->toDateString())->get();
        $totalVisits = Visit::where('link_hash', $hash)->orderBy('id', 'DESC')->get();

        return view('admin/report', ['link' => $data, 'totalVisits' => $totalVisits, 'todayVisits' => $todayVisits]);
    }

    // go method
    public function go(Request  $request)
    {
        $data = Link::where('link_hash', $request->linkHash)->where('status', 1)->first();

        if ($data) {
            $visit = new Visit();
            $visit->link_hash = $request->linkHash;
            $visit->ip = $request->ip();
            $visit->user_agent = $request->header('user-agent');
            $visit->referer = $request->headers->get('referer');
            $visit->save();
            return redirect()->to($data->redirect_to, 302);
        } else {
            abort(404);
        }
    }


    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
