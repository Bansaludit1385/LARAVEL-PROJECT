<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
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
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Avatar Selection -->
        <div class="mt-6 bg-gray-50/50 dark:bg-gray-850/30 p-4 rounded-xl border border-gray-150 dark:border-gray-800">
            <x-input-label :value="__('Choose your avatar')" />
            
            <div class="flex flex-col sm:flex-row sm:items-center gap-6 mt-3">
                <!-- Current Avatar Preview -->
                <div class="flex flex-col items-center">
                    <div class="h-20 w-20 rounded-full overflow-hidden border-2 border-indigo-500 bg-white dark:bg-gray-850 p-1 flex items-center justify-center">
                        <img id="current-avatar-preview" src="{{ $user->avatar }}" class="h-full w-full object-cover rounded-full" alt="Current Avatar">
                    </div>
                </div>
                
                <!-- Choose a new cartoon option -->
                <div class="flex-grow">
                    <div class="grid grid-cols-4 gap-3 max-w-sm" id="profile-avatar-picker-grid">
                        <!-- JS will populate 4 dynamic options -->
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="avatar" id="selected-profile-avatar" value="{{ $user->avatar }}">
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const grid = document.getElementById('profile-avatar-picker-grid');
                const avatarInput = document.getElementById('selected-profile-avatar');
                const previewImg = document.getElementById('current-avatar-preview');
                
                if (!grid) return;

                const avatarOptions = [
                    {
                        url: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Jack'
                    },
                    {
                        url: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Lily'
                    },
                    {
                        url: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Oliver'
                    },
                    {
                        url: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Sophia'
                    }
                ];

                avatarOptions.forEach((opt, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = `profile-avatar-option relative cursor-pointer border-2 border-gray-200 dark:border-gray-700 rounded-xl p-1 bg-white dark:bg-gray-800 hover:border-indigo-500 dark:hover:border-indigo-400 hover:scale-105 transition duration-150 flex items-center justify-center aspect-square`;
                    wrapper.dataset.url = opt.url;
                    
                    wrapper.innerHTML = `
                        <div class="h-[50px] w-[50px] flex items-center justify-center rounded-full overflow-hidden bg-gray-50 dark:bg-gray-750">
                            <img src="${opt.url}" class="h-full w-full object-contain" alt="Avatar option ${index + 1}">
                        </div>
                    `;
                    
                    // Highlight if currently matches this url
                    const decodedCurrentVal = decodeURIComponent(avatarInput.value);
                    if (decodedCurrentVal.includes(opt.url) || opt.url.includes(decodedCurrentVal) || decodedCurrentVal === opt.url) {
                        wrapper.classList.remove('border-gray-200', 'dark:border-gray-700');
                        wrapper.classList.add('border-indigo-650', 'dark:border-indigo-500', 'ring-2', 'ring-indigo-400');
                    }

                    wrapper.addEventListener('click', () => {
                        document.querySelectorAll('.profile-avatar-option').forEach(c => {
                            c.classList.remove('border-indigo-650', 'dark:border-indigo-500', 'ring-2', 'ring-indigo-400');
                            c.classList.add('border-gray-200', 'dark:border-gray-700');
                        });
                        wrapper.classList.remove('border-gray-200', 'dark:border-gray-700');
                        wrapper.classList.add('border-indigo-650', 'dark:border-indigo-500', 'ring-2', 'ring-indigo-400');
                        
                        avatarInput.value = opt.url;
                        previewImg.src = opt.url;
                    });

                    grid.appendChild(wrapper);
                });
            });
        </script>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
