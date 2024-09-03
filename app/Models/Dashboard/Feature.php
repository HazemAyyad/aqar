<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory;
     protected $guarded=[];
    public function featureCategory()
    {
        return $this->belongsTo(FeatureCategory::class, 'category_id');
    }


}
