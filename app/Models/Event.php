<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = ['id'];

    public function guests(){
        return $this->belongsToMany(Contact::class, 'contact_event', 'event_id', 'contact_id');
    }

    public function invitations(){
        return $this->hasMany(Invitation::class, 'event_id', 'id');
    }

    public function eventType(){
        return $this->belongsTo(EventType::class, 'event_type_id');
    }
}
