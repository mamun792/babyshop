<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('campaigns:update-expired', function () {
    $this->comment('Campaigns updated successfully');
})->purpose('Update expired campaigns')->everySecond();


