<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class ContactsPage extends Page
{
    use HasFactory;

    protected $table = 'contacts_pages';
}