<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notebook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function notes() {
        return $this->hasMany(Note::class);
    }
}
