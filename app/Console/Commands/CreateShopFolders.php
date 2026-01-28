<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateShopFolders extends Command
{
    protected $signature = 'shop:create-folders';
    protected $description = 'Create default shop folders';

    public function handle()
    {
        $folders = [
            'electronics',
            'fashion',
            'groceries',
            'mobiles',
            'laptops',
            'beauty',
            'sports',
            'toys',
            'books',
            'home-appliances',
        ];

        foreach ($folders as $folder) {
            $path = public_path("uploads/folders/$folder");

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                $this->info("Created: $folder");
            } else {
                $this->warn("Exists: $folder");
            }
        }

        $this->info('✅ All folders ready!');
    }
}
