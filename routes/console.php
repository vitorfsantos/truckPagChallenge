<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;


$time = env('SCHEDULED_COMMAND_TIME', '06:00');

if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time)) {
  $time = '06:00';
}


Schedule::command('foods:daily_import')->dailyAt($time);
