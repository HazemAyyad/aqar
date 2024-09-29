<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
<<<<<<< .mine
use Spatie\Translatable\HasTranslations;

=======
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
>>>>>>> .theirs
class Facility extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;
    protected $guarded=[];
    public $translatable = [
       'name'
    ];
//    protected $appends=['photo'];
//    public function getPhotoAttribute()
//    {
//        $headers = get_headers($this->attributes['photo'], 1);
//        if (strpos($headers['Content-Type'], 'image/') !== false) {
//            return $this->attributes['photo'];
//        } else {
//            return asset('/assets/img/avatars/1.png');
//        }
//    }

}