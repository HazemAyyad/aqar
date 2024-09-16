<?php


namespace App\Http\View\Composers;



 use App\Models\Dashboard\Setting;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;


class MainData
{
    public function compose(View $view){

        $settings_all= Setting::query()->whereIn('key',
            [

                'email',
                'phone',
                'whatsapp',
                'youtube',
                'twitter',
                'facebook',
                'instagram',
                'slogan',
                'slogan_ar',
                'linkedin',
                'main_logo',
                'secondary_logo',
                'address',
                'gallary_properties',
                'cities',
                'services',
                'statistics',
                'benefits',
                '4_top',
                'people_says',
                'agents',
                'blogs',
                'partners',


            ])->get();
        $data_settings=[];
        foreach ($settings_all as $item){
            $data_settings[$item->key]=$item->value;
        }
            $view->with('lang', ['ar','en'] );
            $view->with('data_settings', $data_settings);




    }
}
