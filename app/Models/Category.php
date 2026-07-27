<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function contacts(){
        return $this->belongsToMany(Contact::class, 'category_contact', 'category_id', 'contact_id');
    }
}

