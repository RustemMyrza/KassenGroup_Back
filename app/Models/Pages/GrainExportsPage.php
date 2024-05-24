<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class GrainExportsPage extends Page
{
    use HasFactory;

    protected $table = 'grain_exports_pages';
}