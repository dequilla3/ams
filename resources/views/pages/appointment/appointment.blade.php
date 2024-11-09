<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-4">
                {{ __('Appointment') }}
            </h2>

            <x-primary-button class=" ">
                {{ __('CREATE') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 text-xs">
                    <form method="GET" action="{{route('appointments.filtered')}}">
                        <div class="flex mb-8">
                            <div class="w-full hf mr-2">
                                <label class="font-bold">Search</label>
                                <x-text-input class="block w-full text-xs mr-2" type="text" name="search"
                                              placeholder="Client name. . ." value="{{$search}}"/>
                            </div>
                            <div class="mr-2">
                                <label for="dateFrom">Date appointment from</label>
                                <input id="dateFrom" name="dateFrom" type="date"
                                       class="text-xs rounded-md border-gray-300 w-full"
                                       value="{{$dateFrom}}">
                            </div>
                            <div class="mr-2">
                                <label for="dateTo">Date appointment to</label>
                                <input id="dateTo" name="dateTo" type="date"
                                       class="text-xs rounded-md border-gray-300 w-full"
                                       value="{{$dateTo}}">
                            </div>

                            <div class="mr-2">
                                <label>Filter</label>
                                <button type="submit" class="border py-2 px-4 rounded bg-gray-100 hover:bg-gray-50">
                                    <x-icon-filter/>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="w-full">
                        <thead>
                        <tr class="bg-neutral-100">
                            <th class="py-4 px-5 text-left">CLIENT NAME</th>
                            <th class="py-4 px-5 text-left">APPOINTMENT DATE</th>
                            <th class="py-4 px-5 text-left">TIME</th>
                            <th class="py-4 px-5 text-left">CREATED AT</th>
                            <th class="py-4 px-5 text-left">CREATED BY</th>
                            <th class="py-4 px-5 text-left">MARK AS DONE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="py-4 px-5 text-left border-b-2">{{$appointment->client_name}}</td>
                                <td class="py-4 px-5 text-left border-b-2">{{$appointment->appointment_date}}</td>
                                <td class="py-4 px-5 text-left border-b-2">{{$appointment->appointment_time}}</td>
                                <td class="py-4 px-5 text-left border-b-2">{{$appointment->created_at}}</td>
                                <td class="py-4 px-5 text-left border-b-2">{{strtoupper(($appointment->created_by))}}</td>
                                <td class="py-4 px-5 border-b-2">
                                    <button class="border p-2 rounded-full hover:bg-gray-50">
                                        <x-icon-check/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination mt-4">
                        {{ $appointments->links() }}  <!-- Laravel generates the pagination links here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
