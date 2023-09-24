<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-bladewind::tab-group name="profile-information">

                <x-slot name="headings">
                    <x-bladewind::tab-heading
                        name="profile"
                        active="true"
                        label="Profile" />
                    <x-bladewind::tab-heading
                        name="password"
                        label="Password" />
                    <x-bladewind::tab-heading
                        name="delete"
                        label="Delete" />
                </x-slot>

                <x-bladewind::tab-body>
                    <x-bladewind::tab-content name="profile" active="true">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="password">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="delete">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </x-bladewind::tab-content>
                </x-bladewind::tab-body>
            </x-bladewind::tab-group>
        </div>
    </div>
</x-app-layout>
