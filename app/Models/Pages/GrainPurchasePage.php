<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class GrainPurchasePage extends Page
{
    use HasFactory;

    protected $table = 'grain_purchase_pages';
}