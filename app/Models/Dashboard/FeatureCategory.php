<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='feature_categories';
    protected $guarded=[];

    public function features()
    {
        return $this->hasMany(Feature::class,'category_id','id');
    }

}
