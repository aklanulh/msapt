<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Redeems') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($redeems->count() > 0)
                        <ul>
                            @foreach ($redeems as $redeem)
                                <li>
                                    <strong>Redeem ID: {{ $redeem->id }}</strong>
                                    <p>User ID: {{ $redeem->user_id }}</p>
                                    <p>Owner Name: {{ $redeem->owner_name }}</p>
                                    <p>Bank Name: {{ $redeem->bank_name }}</p>
                                    <p>Account Number: {{ $redeem->account_number }}</p>
                                    <p>Amount: {{ $redeem->amount }}</p>
                                    <p>Points: {{ $redeem->points }}</p>
                                    <p>Status: {{ $redeem->status }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No redeems found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
