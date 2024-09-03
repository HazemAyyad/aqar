<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){


        $setting['whatsapp'] = Setting::query()->where('key','whatsapp')->first()->value;
        $setting['youtube'] = Setting::query()->where('key','youtube')->first()->value;
        $setting['twitter'] = Setting::query()->where('key','twitter')->first()->value;
        $setting['facebook'] = Setting::query()->where('key','facebook')->first()->value;
        $setting['instagram'] = Setting::query()->where('key','instagram')->first()->value;
        $setting['linkedin'] = Setting::query()->where('key','linkedin')->first()->value;
        $setting['slogan'] = Setting::query()->where('key','slogan')->first()->value;
        $setting['slogan_ar'] = Setting::query()->where('key','slogan_ar')->first()->value;
        $setting['contact_us'] = Setting::query()->where('key','contact_us')->first()->value;
        $setting['contact_us_ar'] = Setting::query()->where('key','contact_us_ar')->first()->value;

        return view('dashboard.settings.index',compact('setting'));

    }
    public function page($page_name)
    {
        $all_pages = Setting::pluck('page')->toArray();

        if (in_array($page_name, $all_pages)) {
            // Retrieve settings for the specific page
            $settings = Setting::where('page', $page_name)->get();

            // Pass the settings to the view
            return view('dashboard.settings.' . $page_name, compact('settings'));
        } else {
            abort(404);
        }
    }
    public function update_about_us(Request $request, $page_name)
    {
        // Fetch the settings based on the page ID or other identifier
        $settings = Setting::where('page', $page_name)->get();

        // Loop through each setting and update it
        foreach ($settings as $setting) {
            switch ($setting->key) {
                case 'description':
                    $setting->value = $request->input('description_en');
                    $setting->value_ar = $request->input('description_ar');
                    break;
                case 'img-video':
                    if ($request->hasFile('img-video')) {

                        $image_url = $request->file('img-video');
                        $image_name ='/public/uploads/img-videos/' . time() . '.' . $image_url->getClientOriginalExtension();
                        $image_url->move(env('PATH_FILE_URL').'/uploads/img-videos/', $image_name);

                        $setting->value = $image_name; // Save the path in the database
                    }

                    break;
                case 'video':
                    $setting->value = $request->input('video');
                    break;
                case 'why_choose_us':
                    $setting->value = $request->input('why_choose_us');
                    $setting->value_ar = $request->input('why_choose_us_ar');
                    break;
            }

            $setting->save(); // Save the updated setting
        }

        return response()->json(['success' => __('Settings updated successfully!')]);
    }

    public function update(Request $request){

        $name_input=[];
        foreach($request->all() as $name => $value)
        {
            $name_input[]= $name; //it will give you "name"
            Setting::query()->where('key', $name)->update([
                'value' => $value,
            ]);
        }

            return response()->json(['success'=>"The process has successfully"]);

    }
    public function page_update(Request $request){
        // return $request;
        $name_input=[];
        foreach($request->all() as $name => $value)
        {
            if (str_contains($name, '_ar')) {
                $name = str_replace('_ar','',$name);
               $setting= Setting::query()->where('key', $name)->first();

               $setting->update([
                            'value_ar' => $value,
                        ]);
            }else{

           $setting= Setting::query()->where('key', $name)->first();
            $setting->update([
                            'value' => $value,
                        ]);
            }

        }

        return response()->json(['success'=>"The process has successfully"]);

    }
}
