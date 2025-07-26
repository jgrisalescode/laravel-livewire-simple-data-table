<div class="space-y-4">

    <div class="flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
        <label for="search" class="w-fit pl-0.5 text-sm">Search</label>
        <input
            wire:model.live.debounce.300ms='search' 
            id="search" 
            type="text" 
            class="w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" 
            name="search" 
            placeholder="Search by Name or Email or ID" 
            autocomplete="search"
        />
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
        <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
            <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                <tr>
                    <th scope="col" class="p-4 cursor-pointer" wire:click="setSortBy('id')">
                        <x-ui.sort-button 
                            field="id"
                            label="CustomerID"
                            :$sortBy
                            :$sortDirection
                        />
                    </th>
                    <th scope="col" class="p-4 cursor-pointer" wire:click="setSortBy('name')">
                        <x-ui.sort-button 
                            field="name"
                            label="Name"
                            :$sortBy
                            :$sortDirection
                        />
                    </th>
                    <th scope="col" class="p-4 cursor-pointer" wire:click="setSortBy('email')">
                        <x-ui.sort-button 
                            field="email"
                            label="Email"
                            :$sortBy
                            :$sortDirection
                        />
                    </th>
                    <th scope="col" class="p-4">Verified</th>
                    <th scope="col" class="p-4 cursor-pointer" wire:click="setSortBy('created_at')">
                        <x-ui.sort-button 
                            field="created_at"
                            label="Created At"
                            :$sortBy
                            :$sortDirection
                        />
                    </th>
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
                        <td class="p-4">
                            {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="p-4 text-center">No data found</td>
                @endforelse
            </tbody>
        </table>
        <div class="m-2 space-y-2">
            <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
                <label for="perPage" class="w-fit pl-0.5 text-sm">Per Page</label>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute pointer-events-none right-4 top-8 size-5">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
                <select wire:model.live='perPage' id="perPage" name="perPage" class="w-full appearance-none rounded-radius border border-outline bg-surface-alt px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
