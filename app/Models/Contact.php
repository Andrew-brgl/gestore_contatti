<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];

    public function role() 
    {
        // contactS 1:N roles
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function category() 
    {
        // contacts 1:N categories
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function title() 
    {
        // contacts 1:N titles
        return $this->belongsTo(Title::class, 'title_id');
    }

    public function delegates() 
    {
        // contacts N:1 delegates
        return $this->hasMany(Delegate::class, 'contact_id', 'id');
    }

    public function secondaryCategories() 
    {
        // contacts N:N categories |  other table   |   pivot table  | FK current model | FK other model
        return $this->belongsToMany(Category::class, 'category_contact', 'contact_id', 'category_id');
    }

    public function guestEvents(){
        return $this->belongsToMany(Event::class, 'contact_event', 'contact_id', 'event_id');
    }

    public function receivedInvitations(){
        return $this->belongsToMany(Invitation::class, 'contact_invitation_receive', 'contact_id', 'invitation_id')
        ->withPivot('mode');
    }

    public function confirmedInvitations(){
        return $this->belongsToMany(Invitation::class, 'contact_invitation_confirm', 'contact_id', 'invitation_id')
        ->withPivot(
            'attending_guests',
            'confirmed_guests',
            'confirmation_date',
            'cancellation_date',
            'has_attended'
        );
    }
}  
