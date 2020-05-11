<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $hidden = ['createdBy','modifiedBy','created','modified'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function AddRules()
    {
        return [
            'name'=>'required',
            'nameAr'=>'required',
            'title'=>'required',
            'titleAr'=>'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'image'=>'image|mimes:jpeg,png,jpg',
        ];
    }
}
