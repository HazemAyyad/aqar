<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $table='property_categories';
    protected $guarded=[];
    // Define which fields are translatable
    public $translatable = [
        'name',
        'description',
        'slug'
    ];
    public function properties()
    {
        return $this->hasMany(Property::class);
    }


}
