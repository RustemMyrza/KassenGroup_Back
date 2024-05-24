<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class ElevatorServicesPage extends Page
{
    use HasFactory;

    protected $table = 'elevator_services_pages';
}