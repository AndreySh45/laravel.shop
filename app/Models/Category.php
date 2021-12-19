<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable, Translatable;

    protected $fillable = [
        'title',
        'desc',
        'title_en',
        'desc_en',
        'img'
    ];

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public static function uploadImage (Request $request, $image = null)
    {
        if ($request->hasFile('img')){
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('img')->store("images/{$folder}");
        }
        return null;
    }
    public function getImage()
    {
        if (!$this->img) {
            return asset("no_image.png");
        }
        return asset("uploads/{$this->img}");
    }

}
