<div>
    <div class="grid gap-6 mb-6 justify-items-center">
        <form class="w-full max-w-sm">
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <x-input-label for="budget" :value="__('Budget')"/>
                </div>
                <div class="md:w-2/3">
                    <x-text-input id="budget" class="block mt-1 w-full" type="text" name="budget" :value="old('budget')"
                                  required autofocus wire:model="budget"/>
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <x-non-primary-button class="ml-3" wire:click="calculateVehicleAmount">
                        Calculate
                    </x-non-primary-button>
                    <x-other-button class="ml-3" wire:click="resetForm">
                        Reset
                    </x-other-button>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <br>
    @if($showResults)
        <div class="grid gap-6 mb-6 justify-items-center">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Label
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Value
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($calculationResult as $label => $value)
                    <tr class="bg-white border-b">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            {{ convertToTitle($label) }}
                        </th>
                        <td class="py-4 px-6">
                            $ {{ $value }}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    @endif
</div>
