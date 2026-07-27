<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    protected $guarded = ['id'];

    public function invitation(){
        return $this->belongsTo(Invitation::class, 'invitation_id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function title(){
        return $this->belongsTo(Title::class, 'title_id');
    }
}
