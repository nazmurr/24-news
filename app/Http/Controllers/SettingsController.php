<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * show settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkedinUrl = Setting::where('meta_key', 'linkedin_url')->value('meta_value');
        $gplusUrl = Setting::where('meta_key', 'gplus_url')->value('meta_value');
        $twitterUrl = Setting::where('meta_key', 'twitter_url')->value('meta_value');
        $facebookUrl = Setting::where('meta_key', 'facebook_url')->value('meta_value');
        $aboutInfo = Setting::where('meta_key', 'about_info')->value('meta_value');

        return view(
            'admin.settings.index', 
            compact(
                'linkedinUrl',
                'gplusUrl',
                'twitterUrl',
                'facebookUrl',
                'aboutInfo'
            )
        );
    }

    /**
     * update settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //print_r($request->all());
        foreach ($request->all() as $key => $req) {
            if ($key === '_token') continue;
            Setting::where('meta_key', $key)->update(['meta_value' => $req ? $req : '']);
            //print_r($key." ".$req);
        }
        Session::flash('flash_admin', 'Settings updated successfully!');
        return redirect('admin/settings');
    }

}
