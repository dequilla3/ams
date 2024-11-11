<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <div class="w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-4">
                    {{ __('New Appointment') }}
                </h2>
            </div>
        </div>
    </x-slot>


    <x-body-layout>
        <form class="py-4" method="POST" action="{{route('store-appointment')}}">
            @csrf
            @method('post')

            <div class="flex justify-center">
                <div class="w-1/3">
                    <div class="mb-4">
                        <label class="text-neutral-500">Name</label>
                        <x-text-input id="client_name" class="block w-full text-xs mr-2" type="text" name="client_name"
                                      value="{{old('client_name')}}"/>
                        <x-input-error :messages="$errors->get('client_name')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <label class="text-neutral-500">Appointment Date</label>
                        <input id="appointment_date" name="appointment_date" type="date"
                               class="text-xs rounded-md border-gray-300 w-full" value="{{old('appointment_date')}}">
                        <x-input-error :messages="$errors->get('appointment_date')" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <label class="text-neutral-500">Appointment Time</label>
                        <input id="appointment_time" name="appointment_time" type="time"
                               class="text-xs rounded-md border-gray-300 w-full" value="{{old('appointment_time')}}">
                        <x-input-error :messages="$errors->get('appointment_time')" class="mt-2"/>
                    </div>

                    <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>

                    <x-link-button :href="route('appointments')">
                        Cancel
                    </x-link-button>

                </div>
            </div>
        </form>
    </x-body-layout>
</x-app-layout>

@vite(['resources/js/pages/new-appointment.js'])
