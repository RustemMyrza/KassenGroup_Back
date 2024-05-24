<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Page extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'image'];

    protected $table;

    public function getTitle()
    {
        return $this->hasOne(Translate::class, 'id', 'title');
    }

    public function getContent()
    {
        return $this->hasOne(Translate::class, 'id', 'content');
    }
}
