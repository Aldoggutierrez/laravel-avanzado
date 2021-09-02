<?php

namespace App\Http\Controllers;

use App\Console\Commands\SendReminderCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NewsletterController extends Controller
{
    public function send()
    {
        Artisan::call(SendReminderCommand::class);
        return response()->json([
           'data' => 'Todo ok'
        ]);
    }
}
