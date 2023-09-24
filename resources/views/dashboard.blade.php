<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <hr/>
                    Favorite club: {{$user->userClub?->club?->title ?? ''}}<br/>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Criteria</th>
                            <th scope="col" class="px-6 py-4">Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="px-6 py-4">Sample 1</td>
                            <td class="px-6 py-4">
                                <x-bladewind::rating
                                    class="rating-value-small-rating"
                                    onclick="saveRating('small-rating')"
                                    name="star-rating"
                                />
                            </td>
                        </tr>
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
