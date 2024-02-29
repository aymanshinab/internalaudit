<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل الموظف ') }}
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
                    <form method="POST" action="{{ route('employee.update' ,  $employee->id ) }}">
                        @csrf
                        @method('PATCH')
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('اسم الموظف')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"    :value="old('name')"  value="{{ old('name', $employee->name) }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        <!-- Email Address -->



                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('رقم الهاتف')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="number"  name="phone_number"  :value="old('phone_number')"    value="{{ old('phone_number', $employee->phone_number) }}"  required autocomplete="username" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('البريد الالكتروني')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" value="{{ old('email', $employee->email) }}" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <div class="mt-4">                            <x-input-label for="role" :value="__('الصلاحيات')" />

                            <select  class="border-gray-300 block mt-1 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"  value="{{ old('role', $employee->role) }}"   name="role">
                              <option value="1"> مدخل البيانات </option>
                              <option value="2">   مراجع</option>
                              <option value="3">   مدقق </option>
                              <option value="4"> معتمد   </option>

                            </select>
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
