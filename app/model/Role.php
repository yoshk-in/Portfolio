<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'role',
    ];
    const NONE = 0;
    const ADMIN = 1;
    const PUBLISHER = 2;

    const ROLES = [
      self::NONE => 'simple_user',
      self::ADMIN => 'admin',
      self::PUBLISHER => 'editor'
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getRoleAttribute(): string
    {
        return self::ROLES[$this->attributes['role']];
    }
}
