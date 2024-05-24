<?php

namespace App\Models\FormsContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Page;

class SubscriptionFormContent extends Page
{
    use HasFactory;

    protected $table = 'subscription_form_contents';
}
