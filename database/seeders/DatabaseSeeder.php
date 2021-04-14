<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@admin.hu";
        $user->password = \Hash::make("admin");
        $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $user->save();

        $status = new Status();
        $status->name = "Fejlesztésre vár";
        $status->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $status->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $status->save();

        $status = new Status();
        $status->name = "Folyamatban";
        $status->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $status->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $status->save();

        $status = new Status();
        $status->name = "Kész";
        $status->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $status->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $status->save();
    }
}
