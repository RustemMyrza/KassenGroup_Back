<?php

namespace App\Models\Pages;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainPage extends Page
{
    use HasFactory;

    protected $table = 'main_pages';
}
