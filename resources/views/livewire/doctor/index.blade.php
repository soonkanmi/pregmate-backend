<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage Doctors
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Doctor</button>

            @if($isModalOpen)
                @include('livewire.doctor.create')
            @endif

            @if($isViewOpen)
                @include('livewire.doctor.view')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-28">Name</th>
                        <th class="px-4 py-2 w-28">Email</th>
                        <th class="px-4 py-2 w-24">Phone</th>
                        <th class="px-4 py-2 w-16">Status</th>
                        <th class="px-4 py-2 w-28">Date</th>
                        <th class="px-4 py-2 w-36">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->phone }}</td>
                        <td class="border px-4 py-2">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                        <td class="border px-4 py-2">{{ $user->created_at->format('Y-m-d h:i A') }}</td>
                        <td class="border px-4 py-2 flex">
                            <x-jet-button type="button" wire:click="view({{ $user->id }})"
                                class="flex px-4 py-2 bg-white text-gray-500 border cursor-pointer mr-2">View</x-jet-button>
                            <x-jet-button type="button" wire:click="edit({{ $user->id }})"
                                class="flex px-4 py-2 bg-gray-500 text-white cursor-pointer mr-2">Edit</x-jet-button>
                            <x-jet-button type="button" wire:click="confirmDeletion({{ $user->id }})" wire:loading.attr="disabled"
                                class="flex px-4 py-2 bg-red-100 text-gray-900 hover:bg-red-500 cursor-pointer">Delete</x-jet-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingDelete">
        <x-slot name="title">
            {{ __('Delete Doctor') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete selected user?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete({{ $confirmRecordId }})" wire:loading.attr="disabled">
                {{ __('Delete Doctor') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
