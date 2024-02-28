<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تسجيل موظف جديد') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<div class="flex justify-between"><div>

                </div>
</div>
                    <br>
                    <form method="POST" action="{{ route('employee.register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('اسم الموظف')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        <!-- Email Address -->



                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('رقم الهاتف')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="number"  name="phone_number" :value="old('phone_number')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('البريد الالكتروني')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <x-input-label for="role" :value="__('الصلاحيات')" />
                            <x-text-input id="role" class="block mt-1 w-full" type="number" name="role" :value="old('role')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>


                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('كلمة السر ')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('تاكيد كلمة السر')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ms-4">
                                {{ __('تسجيل') }}
                            </x-primary-button>
                        </div>
                    </form>

                    {{-- <div class="pt-4">
                        {{ $employee->links() }}
                    </div> --}}


</x-app-layout>
