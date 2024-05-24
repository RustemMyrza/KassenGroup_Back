<?php

namespace App\Models\FormsContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class ApplicationFormContent extends Page
{
    use HasFactory;

    protected $table = 'application_form_contents';
}
