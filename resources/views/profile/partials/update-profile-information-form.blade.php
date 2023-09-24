<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-bladewind::input
                :label="__('Name')"
                id="name"
                name="name"
                type="text"
                required="true"
                autocomplete="name"
                :value="old('name', $user->name)"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-bladewind::input
                :label="__('Email')"
                id="email"
                name="email"
                type="email"
                required="true"
                autocomplete="email"
                :value="old('email', $user->email)"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if (!$user->userClub)
        <div>
            <x-input-label for="club" :value="__('Favorite Club')" />
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
            <x-input-error class="mt-2" :messages="$errors->get('club')" />
        </div>
        @else
           Favorite Club: {{$user->userClub->club->title}}<br/>
           Last change: {{$user->userClub->updated_at->format('Y-m-d H:m')}}
        @endif

        <div class="flex items-center gap-4">
            <x-bladewind::button can_submit="true" size="small">{{ __('Save') }}</x-bladewind::button>
            @if (session('status') === 'profile-updated')
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
