<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Club') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Favorite club: {{$user->userClub?->club?->title ?? ''}}<br/>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Criteria</th>
                            <th scope="col" class="px-6 py-4">Mark</th>
                            <th scope="col" class="px-6 py-4">Action</th>
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
                                    rating="4"
                                    clickable="false"
                                />
                            </td>
                            <td class="px-6 py-4">
                                <x-bladewind::button
                                    size="tiny"
                                    onclick="showModal('setRating')">
                                    Vote
                                </x-bladewind::button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-bladewind::modal
        backdrop_can_close="false"
        name="setRating"
        size="small"
        title="Set Mark"
        ok_button_action=""
        ok_button_label="Vote"
        close_after_action="false"
        center_action_buttons="true">
        <form method="post" action="{{route('dashboard.index')}}" class="profile-form">
            @csrf
            <x-bladewind::rating
                class="rating-value-small-rating"
                name="star-rating"
                rating="4"
            />
        </form>
    </x-bladewind::modal>
</x-app-layout>
