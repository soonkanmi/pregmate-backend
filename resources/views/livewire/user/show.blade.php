<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Full Records
        </h2>
    </x-slot>

        <a href="{{ route('users.list') }}"
            class="inline-flex justify-center w-full rounded-md border border-blue-300 px-4 py-2 bg-blue-200 text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 mr-5">
            Back to Users
        </a>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">
                            Personal Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            User personal information
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" type="text" class="mt-1 block w-full" readonly value="{{ $state->name }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" type="text" class="mt-1 block w-full" readonly value="{{ $state->email }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                                <x-jet-input id="phone" type="text" class="mt-1 block w-full" readonly value="{{ $state->phone }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
                                <x-jet-input id="date_of_birth" type="text" class="mt-1 block w-full" readonly value="{{ $state->personal_information->date_of_birth }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="address" value="{{ __('Address') }}" />
                                <x-jet-input id="address" type="text" class="mt-1 block w-full" readonly value="{{ $state->personal_information->address }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="occupation" value="{{ __('Occupation') }}" />
                                <x-jet-input id="occupation" type="text" class="mt-1 block w-full" readonly value="{{ $state->personal_information->occupation }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="next_of_kin" value="{{ __('Next of Kin') }}" />
                                <x-jet-input id="next_of_kin" type="text" class="mt-1 block w-full" readonly value="{{ $state->personal_information->next_of_kin }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">
                            Obstetrical Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            User obstetrical information
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="previous_pregnancies" value="{{ __('No. of Previous Pregnancies') }}" />
                                <x-jet-input id="previous_pregnancies" type="text" class="mt-1 block w-full" readonly value="{{ $state->obstetrical_information->previous_pregnancies }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="liveborns" value="{{ __('No. of Live borns') }}" />
                                <x-jet-input id="liveborns" type="text" class="mt-1 block w-full" readonly value="{{ $state->obstetrical_information->liveborns }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="stillborns" value="{{ __('No. of Stillborns') }}" />
                                <x-jet-input id="stillborns" type="text" class="mt-1 block w-full" readonly value="{{ $state->obstetrical_information->stillborns ?? 0 }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="previous_mode_of_delivery" value="{{ __('Previous Mode of Delivery') }}" />
                                <x-jet-input id="previous_mode_of_delivery" type="text" class="mt-1 block w-full" readonly value="{{ $state->obstetrical_information->previous_mode_of_delivery }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">
                            Medical Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            User medical information
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="blood_group" value="{{ __('Blood Group') }}" />
                                <x-jet-input id="blood_group" type="text" class="mt-1 block w-full" readonly value="{{ $state->medical_information->bloodgroup }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="allergies" value="{{ __('Allergy(ies)') }}" />
                                <x-jet-input id="allergies" type="text" class="mt-1 block w-full" readonly value="{{ $state->medical_information->allergies ?? 'None' }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="rhesus_factor" value="{{ __('Rhesus Factor') }}" />
                                <x-jet-input id="rhesus_factor" type="text" class="mt-1 block w-full" readonly value="{{ $state->medical_information->rhesus_factor ?? 0 }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">
                            Pregnancy Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            User pregnancy information
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="date_concieved" value="{{ __('Conception Date') }}" />
                                <x-jet-input id="date_concieved" type="text" class="mt-1 block w-full" readonly value="{{ $state->pregnancy_information->date_concieved }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="first_trimester_ends" value="{{ __('End of First Trimester') }}" />
                                <x-jet-input id="first_trimester_ends" type="text" class="mt-1 block w-full" readonly value="{{ $state->pregnancy_information->first_trimester_ends }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="second_trimester_ends" value="{{ __('End of Second Trimester') }}" />
                                <x-jet-input id="second_trimester_ends" type="text" class="mt-1 block w-full" readonly value="{{ $state->pregnancy_information->second_trimester_ends }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="estimated_due_date" value="{{ __('Estimated Due Date') }}" />
                                <x-jet-input id="estimated_due_date" type="text" class="mt-1 block w-full" readonly value="{{ $state->pregnancy_information->estimated_due_date }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">
                            Daily Vitals Information
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            User daily vitals information
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                        <div class="grid grid-cols-12 gap-0">
                            <table class="table-fixed w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 w-20">Weight</th>
                                        <th class="px-4 py-2 w-28">Blood Pressure</th>
                                        <th class="px-4 py-2 w-24">Temperature</th>
                                        <th class="px-4 py-2 w-24">Fluid Intake</th>
                                        <th class="px-4 py-2 w-20">Drug Intake</th>
                                        <th class="px-4 py-2 w-28">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($state->vitals as $vital)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $vital->weight }}kg</td>
                                        <td class="border px-4 py-2">{{ $vital->blood_pressure_systolic }}/{{ $vital->blood_pressure_diastolic }}mmHg</td>
                                        <td class="border px-4 py-2">{{ $vital->temperature }}°C</td>
                                        <td class="border px-4 py-2">{{ $vital->fluid_intake }}mls</td>
                                        <td class="border px-4 py-2">{{ $vital->drug_intake ? 'Yes' : 'No' }}</td>
                                        <td class="border px-4 py-2">{{ $vital->created_at->format('Y-m-d h:i A') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
