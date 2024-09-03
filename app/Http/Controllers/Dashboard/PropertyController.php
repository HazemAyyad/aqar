<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\FeatureCategory;
use App\Models\Dashboard\Icon;
use App\Models\Dashboard\Facility;
use App\Models\Dashboard\Feature;
use App\Models\Dashboard\Property;
use App\Models\Dashboard\PropertyAddress;
use App\Models\Dashboard\PropertyFacility;
use App\Models\Dashboard\PropertyFeature;
use App\Models\Dashboard\PropertyImage;
use App\Models\Dashboard\PropertyInformation;
use App\Models\Dashboard\PropertyPrice;
use App\Traits\Sluggable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class PropertyController extends Controller
{

    protected function generateArabicSlug($title)
    {
        // Replace spaces with hyphens, keeping Arabic characters intact
        $slug = preg_replace('/\s+/u', '-', trim($title));

        // Optionally, remove any characters that aren't letters, numbers, or hyphens
        $slug = preg_replace('/[^\p{L}\p{N}\-]+/u', '', $slug);

        return $slug;
    }

    public function generateUniqueSlug($title, $column = 'slug', $lang = 'ar')
    {
        if ($lang == 'ar') {
            $slug = $this->generateArabicSlug($title);
        } else {
            $slug = Str::slug($title);
        }

        $originalSlug = $slug;
        $count = 1;

        while (Property::where($column, $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function generateSlug(Request $request)
    {
        $lang = $request->get('lang', 'en'); // Default to 'en' if no language is provided
        $slug = $this->generateUniqueSlug($request->name, 'slug', $lang);
        return response()->json(['slug' => $slug]);
    }
    public function index(){

                return view('dashboard.properties.index');

    }
    public function get_properties(Request $request)
    {


        return DataTables::of(Property::query())
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($request){

                    $url=route('admin.properties.edit',$row->id);

                $btn = '<a href="'.$url .'" class="ms-2"><i class="fas fa-edit text-success"></i></a>
                        <a href="javascript:void(0)" onclick="deleteItem('.$row->id.')" class=""><i class="fas fa-trash-alt text-danger"></i></a>';

                return $btn;
            })

            ->editColumn('title', function ($row) {
                return '<strong class="Titillium-font danger">' . $row->title . '</strong>';
            })
            ->editColumn('views', function ($row) {
                return '<strong class="Titillium-font text-primary">' . $row->views . '</strong>';
            })
            ->editColumn('created_at', function ($row) {
                return '<strong class="Titillium-font danger">' . $row->created_at->format('m/d/Y - H:i') . '</strong>';
            })
            ->editColumn('status', function ($row) {
                 $status= $row->status;
                if ($status == 0) {
                    $class = 'text-secondary';
                    $tooltipetitle = __('Not available');
                } elseif ($status == 1) {
                    $class = 'text-primary';
                    $tooltipetitle = __('Preparing selling');
                }  elseif ($status == 2) {
                    $class = 'text-success';
                    $tooltipetitle = __('Selling');
                }
                elseif ($status == 3) {
                    $class = 'text-warning';
                    $tooltipetitle = __('sold');
                }
                elseif ($status == 4) {
                    $class = 'text-info';
                    $tooltipetitle = __('Renting');
                }
                elseif ($status == 5) {
                    $class = 'text-dark';
                    $tooltipetitle = __('Rented');
                }
                elseif ($status == 6) {
                    $class = 'text-primary';
                    $tooltipetitle = __('Building');
                }else {
                    $class = 'text-danger';
                    $tooltipetitle = __('Unknown');
                }
                return '<strong  class="' . $class . ' " tabindex="0" data-toggle="tooltip" title="' . $tooltipetitle . '" >' . $tooltipetitle . '</strong>';

            })
            ->editColumn('moderation_status', function ($row) {
                $moderation_status= $row->moderation_status;
                if ($moderation_status == 0) {
                    $class = 'text-warning';
                    $tooltipetitle = __('Pending');
                } elseif ($moderation_status == 1) {
                    $class = 'text-success';
                    $tooltipetitle = __('Approved');
                }  elseif ($moderation_status == 2) {
                    $class = 'text-danger';
                    $tooltipetitle = __('Rejected');
                }
                else {
                    $class = 'text-danger';
                    $tooltipetitle = __('Unknown');
                }
                return '<strong  class="' . $class . ' " tabindex="0" data-toggle="tooltip" title="' . $tooltipetitle . '" >' . $tooltipetitle . '</strong>';

            })
             ->rawColumns(['title','views','status','moderation_status','created_at','action'])
            ->make(true);

    }
    public function create(){

        $categories=Category::all();
        $facilities=Facility::all();
        $feature_categories=FeatureCategory::query()->with('features')->get();
        $icons=Icon::all();
        $countries = Country::all();
        // Collect unique currencies and remove empty ones
        $uniqueCurrencies = $countries->map(function ($country) {
            return $country->currency;
        })->filter(function ($currency) {
            return !empty($currency); // Filter out empty currencies
        })->unique()->values(); // Remove duplicates and reindex


                return view('dashboard.properties.add',compact('icons','categories',
                    'countries','feature_categories','facilities','uniqueCurrencies'));

    }
    public function edit($id){

               $property=Property::query()->where('id',$id)
                ->with([
                    'images',
                    'features',
                    'facilities',
                    'price', // Include the related price
                    'more_info', // Include the related more_info
                    'address', // Include the related address
                    'user' // Include the related user
                ])->first();
        $categories=Category::all();
        $facilities=Facility::all();
        $feature_categories=FeatureCategory::query()->with('features')->get();
        $icons=Icon::all();
        $countries = Country::all();
        // Collect unique currencies and remove empty ones
        $uniqueCurrencies = $countries->map(function ($country) {
            return $country->currency;
        })->filter(function ($currency) {
            return !empty($currency); // Filter out empty currencies
        })->unique()->values(); // Remove duplicates and reindex


        return view('dashboard.properties.edit',compact('icons','categories',
            'countries','feature_categories','facilities','uniqueCurrencies','property'));


    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'category_id' => 'required',
//            'video_url' => 'required',
            'content' => 'required',
            'images' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'full_address' => 'required',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'price' => 'required',
            'currency' => 'required',


            'size' => 'required',
            'land_area' => 'required',
            'rooms' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'garages' => 'required',
            'garages_size' => 'required',
            'floors' => 'required',
            'year_built' => 'required',
            'property_features' => 'required',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $input=$request->all();
            return response(["responseJSON" => $errors,"input"=>$input, "message" => 'Verify that the data is correct, fill in all fields'], 422);
        }
        if ($validator->passes()) {
            $data=$request->all();
            DB::beginTransaction();
            try {
                $property = Property::query()->create([
                    'title' => $request->name,
                    'user_id' => $request->user_id,
                    'description' => $request->description,
                    'slug' => $request->slug,
                    'type' => $request->type,
                    'status' => $request->status,
                    'moderation_status' => $request->moderation_status,
                    'category_id' => $request->category_id,
                ]);
                $information = PropertyInformation::query()->create([
                    'property_id' => $property->id,
                    'content' => $request['content'],
                    'video_url' => $request->video_url,
                    'size' => $request->size,
                    'land_area' => $request->land_area,
                    'rooms' => $request->rooms,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garages' => $request->garages,
                    'garages_size' => $request->garages_size,
                    'floors' => $request->floors,
                    'year_built' => $request->year_built,
                ]);
                if ($request->auto_renew=='on'){
                    $auto_renew=1;
                }else{
                    $auto_renew=0;
                }
                if ($request->never_expired=='on'){
                    $never_expired=1;
                }else{
                    $never_expired=0;
                }
                $price = PropertyPrice::query()->create([
                    'property_id' => $property->id,

                    'price' => $request->price,
                    'currency' => $request->currency,
                    'period' => $request->period,
                    'private_notes' => $request->private_notes,
                    'never_expired' => $never_expired,
                    'auto_renew' => $auto_renew,

                ]);
                $address = PropertyAddress::query()->create([
                    'property_id' => $property->id,
                    'full_address' => $request->full_address,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,


                ]);
                if (count($request->property_features) != 0) {
                    foreach ($request->property_features as $feature) {
                        PropertyFeature::query()->create([
                            'property_id' => $property->id,
                            'feature_id' => $feature,
                        ]);
                    }
                }
                if (count($request->facilities) != 0) {
                    foreach ($request->facilities as $facility) {
                        PropertyFacility::query()->create([
                            'property_id' => $property->id,
                            'facility_id' => $facility['facility_id'],
                            'distance' => $facility['distance'],
                        ]);
                    }
                }
                if (count($request->images) != 0) {
                    foreach ($request->images as $image) {
                        PropertyImage::query()->create([
                            'property_id' => $property->id,
                            'img' => $image,

                        ]);
                    }
                }
                DB::commit();
                return response()->json(['success'=>"The process has successfully"]);
            }catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }


        }
    }
    public function update(Request $request,$id){
        $property= Property::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'category_id' => 'required',
//            'video_url' => 'required',
            'content' => 'required',
            'images' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'full_address' => 'required',

            'price' => 'required',
            'currency' => 'required',


            'size' => 'required',
            'land_area' => 'required',
            'rooms' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'garages' => 'required',
            'garages_size' => 'required',
            'floors' => 'required',
            'year_built' => 'required',
            'property_features' => 'required',


        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $input=$request->all();
            return response(["responseJSON" => $errors,"input"=>$input, "message" => 'Verify that the data is correct, fill in all fields'], 422);
        }
        $data = $request->all();

        if ($validator->passes()) {

            DB::beginTransaction();
            try {
                $property->update([
                    'title' => $request->name,
                    'user_id' => $request->user_id,
                    'description' => $request->description,
                    'slug' => $request->slug,
                    'type' => $request->type,
                    'status' => $request->status,
                    'moderation_status' => $request->moderation_status,
                    'category_id' => $request->category_id,
                ]);
                $information = PropertyInformation::query()->where('property_id', $id)->first();
                $information->update([

                    'content' => $request['content'],
                    'video_url' => $request->video_url,
                    'size' => $request->size,
                    'land_area' => $request->land_area,
                    'rooms' => $request->rooms,
                    'bedrooms' => $request->bedrooms,
                    'bathrooms' => $request->bathrooms,
                    'garages' => $request->garages,
                    'garages_size' => $request->garages_size,
                    'floors' => $request->floors,
                    'year_built' => $request->year_built,
                ]);
                if ($request->auto_renew=='on'){
                    $auto_renew=1;
                }else{
                    $auto_renew=0;
                }
                if ($request->never_expired=='on'){
                    $never_expired=1;
                }else{
                    $never_expired=0;
                }
                $price = PropertyPrice::query()->where('property_id', $id)->first();
                $price->update([


                    'price' => $request->price,
                    'currency' => $request->currency,
                    'period' => $request->period,
                    'private_notes' => $request->private_notes,
                    'never_expired' => $never_expired,
                    'auto_renew' => $auto_renew,

                ]);
                $address = PropertyAddress::query()->where('property_id', $id)->first();
                $address ->update([

                    'full_address' => $request->full_address,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,


                ]);
                if (count($request->property_features) != 0) {
                    PropertyFeature::query()->where('property_id',$id)->delete();
                    foreach ($request->property_features as $feature) {
                        PropertyFeature::query()->create([
                            'property_id' => $property->id,
                            'feature_id' => $feature,
                        ]);
                    }
                }
                if (count($request->facilities) != 0) {
                    PropertyFacility::query()->where('property_id',$id)->delete();
                    foreach ($request->facilities as $facility) {
                        PropertyFacility::query()->create([
                            'property_id' => $property->id,
                            'facility_id' => $facility['facility_id'],
                            'distance' => $facility['distance'],
                        ]);
                    }
                }
                if (count($request->images) != 0) {
                    PropertyImage::query()->where('property_id',$id)->delete();
                    foreach ($request->images as $image) {
                        PropertyImage::query()->create([
                            'property_id' => $property->id,
                            'img' => $image,

                        ]);
                    }
                }
                DB::commit();
                return response()->json(['success'=>"The process has successfully"]);
            }catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }

        }
    }
    public function delete($id)
    {
        $category =Property::find($id);
        $category->delete();
        $arr = array('msg' => 'There are some errors, try again', 'status' => false);
        if($category){
            $arr = array('msg' => "operation accomplished successfully", 'status' => true);
        }
        return Response()->json($arr);

    }
}
