<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class AboutUsPage extends Page
{
    use HasFactory;

    protected $table = 'about_us_pages';
}
