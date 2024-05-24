<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavBar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    protected $table = 'nav_bars';

    public function getName()
    {
        return $this->hasOne(Translate::class, 'id', 'name');
    }
}
