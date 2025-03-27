<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nip05 extends Model
{
    protected $guarded=[];
    protected $hidden = [
        'id', 'created_at', 'updated_at', 'relays', 'profile'
    ];
    protected function casts(): array
    {
        return [
            'relays' => 'array',
            'profile' => 'array',
        ];
    }
}
