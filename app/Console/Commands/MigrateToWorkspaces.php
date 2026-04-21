<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Link;
use App\Models\Workspace;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateToWorkspaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-to-workspaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing users and links to workspaces';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        $this->info("Found {$users->count()} users to migrate.");

        DB::transaction(function () use ($users) {
            foreach ($users as $user) {
                // Check if user already has a personal workspace
                $workspace = $user->ownedWorkspaces()->where('is_personal', true)->first();

                if (!$workspace) {
                    $this->info("Creating workspace for user: {$user->email}");
                    $workspace = $user->createPersonalWorkspace();
                }

                // Assign links to this workspace
                $linksCount = Link::where('user_id', $user->id)
                    ->whereNull('workspace_id')
                    ->update(['workspace_id' => $workspace->id]);

                if ($linksCount > 0) {
                    $this->info("Assigned {$linksCount} links to workspace: {$workspace->name}");
                }
            }
        });

        $this->info('Migration completed successfully.');
    }
}
