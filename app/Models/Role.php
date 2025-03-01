<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /**
     * Get the users that belong to the Role
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
