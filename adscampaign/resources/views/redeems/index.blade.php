<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Redeem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Display User Points -->
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Points: {{ auth()->user()->points }}</p>
                    </div>

                    <!-- Include the status component -->
                    <x-status />

                    <!-- Redeem Form -->
                    <form method="POST" action="{{ route('redeems.store') }}">
                        @csrf

                        <!-- Owner Name Input -->
                        <div class="mb-4">
                            <label for="owner_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Owner Name</label>
                            <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name') }}" required autofocus class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                        </div>
                        
                        <!-- Bank Name Input -->
                        <div class="mb-4">
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                        </div>
                        
                        <!-- Account Number Input -->
                        <div class="mb-4">
                            <label for="account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Account Number</label>
                            <input type="text" name="account_number" id="account_number" value="{{ old('account_number') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                        </div>
                        
                       <!-- Amount Input -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount (in points) - Min. 50 points</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required min="50" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md" placeholder="Minimum 50 points">
                        </div>

                        <!-- Converted Amount Display -->
                        <div class="mb-4">
                            <label for="converted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount (in IDR)</label>
                            <input type="text" name="converted_amount" id="converted_amount" readonly class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                        </div>

                        <!-- Script for converting points to IDR -->
                        <script>
                            // Function to convert points to IDR
                            function convertPointsToIDR(points) {
                                return points * 1000; // Assuming 1 point = Rp. 1000
                            }

                            // Update converted amount when the points input changes
                            document.getElementById('amount').addEventListener('input', function() {
                                const points = parseFloat(this.value);
                                const convertedAmount = convertPointsToIDR(points);
                                document.getElementById('converted_amount').value = convertedAmount;
                            });
                        </script>

                        <!-- Remaining form fields -->

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Table for redemption history -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold mb-4 text-center text-gray-800 dark:text-gray-200">Redemption History</h3>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">Owner Name</th>
                                <th scope="col" class="py-3 px-6">Bank Name</th>
                                <th scope="col" class="py-3 px-6">Account Number</th>
                                <th scope="col" class="py-3 px-6">Amount (Points)</th>
                                <th scope="col" class="py-3 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through redemption history data and display each row -->
                            @foreach ($redeemHistory as $redeem)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">{{ $redeem->owner_name }}</td>
                                    <td class="py-4 px-6">{{ $redeem->bank_name }}</td>
                                    <td class="py-4 px-6">{{ $redeem->account_number }}</td>
                                    <td class="py-4 px-6">{{ $redeem->amount }}</td>
                                    <td class="py-4 px-6">{{ $redeem->status }}</td>
                                </tr>
                            @endforeach
                            <!-- If there's no redemption history, display a message -->
                            @if ($redeemHistory->isEmpty())
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="5" class="py-4 px-6 text-center text-gray-700 dark:text-gray-300">No redemption history available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 