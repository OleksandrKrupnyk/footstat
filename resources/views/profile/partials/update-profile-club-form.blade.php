<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Clubs Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's club information.") }}
        </p>
    </header>
    <form method="post" action="{{ route('profile-club.update') }}" class="mt-6 space-y-6">
        @if ($user->club)
            @method('put')
        @endif
        @csrf
        @if (!$user->club)
            <div>
                <x-input-label for="club" :value="__('Favorite Club')"/>
                <x-bladewind::select
                    :label="__('Favorite Club')"
                    name="club"
                    id="club"
                    :selected_value="old('userClub.club_id', $user->userClub?->club_id)"
                    searchable="true"
                    required="true"
                    label_key="title"
                    value_key="id"
                    :data="$clubs"
                />
                <x-input-error class="mt-2" :messages="$errors->get('club')"/>
            </div>
        @else
            Favorite Club: {{$user->club->title}}<br/>
            Last Favorite change: {{$user->userClub->update_club_at?->toDateTimeString()}}<br/>
        @endif
                @if ($user->club)
                <x-bladewind::input
                    name="club"
                    id="club"
                    hidden="true"
                    :selected-value="$user->userClub->club_id"
                ></x-bladewind::input>
                @endif
            <x-input-label for="opponent" :value="__('Opponent Club')"/>
            <x-bladewind::select
                :label="__('Opponent Club')"
                name="opponent"
                id="opponent"
                :selected_value="old('userClub.opponent_club_id', $user->userClub?->opponent_club_id)"
                searchable="true"
                required="true"
                label_key="title"
                value_key="id"
                :data="$clubs"
            />
            <x-input-error class="mt-2" :messages="$errors->get('opponent')"/>
            Last Opponent change: {{$user->userClub->update_opponent_at?->format('Y-m-d H:i:s')}}<br/>

        <div class="flex items-center gap-4">
            <x-bladewind::button can_submit="true" size="small">{{ __('Save') }}</x-bladewind::button>
            @if (session('status') === 'clubs-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

</section>
