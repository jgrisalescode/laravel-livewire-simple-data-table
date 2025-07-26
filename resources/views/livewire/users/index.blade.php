<div class="space-y-4">

    <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
        <label for="search" class="w-fit pl-0.5 text-sm">Search</label>
        <input
            wire:model.live.debounce.300ms='search' 
            id="search" 
            type="text" 
            class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" 
            name="search" 
            placeholder="Search by ..." 
            autocomplete="search"
        />
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4">CustomerID</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Verified</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline dark:divide-outline-dark">
                @forelse ($users as $user)
                    <tr key="{{ $user->id }}">
                        <td class="p-4">{{ $user->id }}</td>
                        <td class="p-4">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">
                            @if ($user->email_verified_at)
                                <!-- success Badge -->
                                <span class="w-fit inline-flex overflow-hidden rounded-radius border border-success bg-surface text-xs font-medium text-success dark:border-success dark:bg-surface-dark dark:text-success">
                                    <span class="px-2 py-1 bg-success/10 dark:bg-success/10">Verified</span>
                                </span>
                            @else
                                <!-- danger Badge -->
                                <span class="w-fit inline-flex overflow-hidden rounded-radius border border-danger bg-surface text-xs font-medium text-danger dark:border-danger dark:bg-surface-dark dark:text-danger">
                                    <span class="px-2 py-1 bg-danger/10 dark:bg-danger/10">Pending</span>
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <td colspan="4" class="p-4 text-center">No data found</td>
                @endforelse
            </tbody>
        </table>
        <div class="m-2">
            {{ $users->links() }}
        </div>
    </div>
</div>
