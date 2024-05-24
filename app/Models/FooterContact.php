<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterContact extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    protected $table = 'footer_contacts';

    public function getText()
    {
        return $this->hasOne(Translate::class, 'id', 'text');
    }
}
