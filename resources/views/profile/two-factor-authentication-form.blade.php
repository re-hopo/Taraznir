<x-jet-action-section>
    <x-slot name="title">
        احراز هویت دو مرحله‌ای
    </x-slot>

    <x-slot name="description">
        اضافه کردن امنیت بیشتر به حساب شما با استفاده از احراز هویت دو مرحله‌ای.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                     فعال کردن احراز هویت دو عاملی را به پایان برسانید.
                @else
                    شما احراز هویت دو عاملی را فعال کرده اید.
                @endif
            @else
                شما احراز هویت دو عاملی را فعال نکرده اید.
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                 'هنگامی که احراز هویت دو عاملی فعال باشد، در حین احراز هویت از شما خواسته می شود که یک نشانه امن و تصادفی داشته باشید. می توانید این نشانه را از برنامه Google Authenticator گوشی خود بازیابی کنید.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                             برای پایان دادن به فعال کردن احراز هویت دو عاملی، کد QR زیر را با استفاده از برنامه احراز هویت گوشی خود اسکن کنید یا کلید تنظیم را وارد کرده و کد OTP تولید شده را ارائه دهید.
                        @else
                            احراز هویت دو عاملی اکنون فعال است. کد QR زیر را با استفاده از برنامه احراز هویت گوشی خود اسکن کنید یا کلید تنظیم را وارد کنید.
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                         کلید راه اندازی : {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                         این کدهای بازیابی را در یک برنامه مدیریت رمز عبور امن ذخیره کنید. اگر دستگاه احراز هویت دو عاملی شما گم شود، می توان از آنها برای بازیابی دسترسی به حساب شما استفاده کرد.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        فعال
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            ساخته دوباره کدهای بازیابی
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                            تایید کردن
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            نمایش کدهای بازیابی
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            لغو
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            غیر فعال
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>
