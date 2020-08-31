<?php

namespace App\Console\Commands;

use App\Models\Products\Images\ProductImage;
use App\Models\Products\Product;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'gg';

    public function handle()
    {
        try {
            Product::find(141)->delete();
        } catch (\Exception $e) {
            dd($e->getTraceAsString(), get_class($e),$e->getMessage());
        }

        dd(\DB::transactionLevel());
    }
}
