<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = ['id'];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function receivedByContacts(){
        return $this->belongsToMany(Contact::class, 'contact_invitation_receive', 'invitation_id', 'contact_id')
        ->withPivot('mode');
    }

    public function confirmedByContacts(){
        return $this->belongsToMany(Contact::class, 'contact_invitation_confirm', 'invitation_id', 'contact_id')
        ->withPivot(
            'attending_guests',
            'confirmed_guests',
            'confirmation_date',
            'cancellation_date',
            'has_attended'
        );
    }

    public function delegates(){
        return $this->hasMany(Delegate::class, 'invitation_id', 'id');
    }
}
