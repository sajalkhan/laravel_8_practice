<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//TODO: https://laravel.com/docs/8.x/eloquent#soft-deleting

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'user_category',
    ];

    //?🔰 join two table with Eloquent ORM
    //!⚠️ this method don't needed for query builder
    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
        //!😎 here we create relation with User table id and category tabe user_id
    }
}
