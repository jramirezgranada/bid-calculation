<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div
                            class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    @endif
                    <div class="grid gap-6 mb-6 justify-items-center">
                        <form class="w-full max-w-sm" method="post" action="{{ route('save-fees') }}">
                            @csrf
                            @foreach($fees as $fee)
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <x-input-label for="{{ $fee->slug }}" :value="$fee->label"/>
                                        <input type="hidden" name="fee[{{ $fee->slug }}][slug]"
                                               value="{{ $fee->slug }}">
                                    </div>
                                    <div class="md:w-2/3">
                                        <x-text-input id="{{ $fee->slug }}" class="block mt-1 w-full" type="text"
                                                      name="fee[{{ $fee->slug }}][value]"
                                                      :value="old($fee->value) ?? $fee->value"
                                                      required autofocus/>
                                    </div>
                                </div>
                            @endforeach

                            <div class="md:flex md:items-center">
                                <div class="md:w-1/3"></div>
                                <div class="md:w-2/3">
                                    <x-primary-button class="ml-3">
                                        Save
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
