<?php

namespace App\Models\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory,SoftDeletes;
     protected $guarded=[];
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
    public function features()
    {
        return $this->hasMany(PropertyFeature::class);
    }
    public function reviews()
    {
        return $this->hasMany(PropertyReviews::class);
    }
    public function facilities()
    {
        return $this->hasMany(PropertyFacility::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function price()
    {
        return $this->hasOne (PropertyPrice::class);
    }
    public function more_info()
    {
        return $this->hasOne (PropertyInformation::class);
    }
    public function address()
    {
        return $this->hasOne(PropertyAddress::class)->with(['city','country','state']);
    }


}
