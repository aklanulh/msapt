<x-app-layout>
    <x-slot name="header">
        💰 Treasure Vault - Redeem Your Rewards!
    </x-slot>

    @php
        $userPoints = auth()->user()->points ?? 0;
        $minRedeem = 50;
        $canRedeem = $userPoints >= $minRedeem;
        $redeemHistory = $redeemHistory ?? collect();
        $totalRedeemed = $redeemHistory->where('status', 'approve')->sum('amount');
        $pendingRedeems = $redeemHistory->where('status', 'pending')->sum('amount');
    @endphp

    <div class="pixel-grid">
        <!-- Player Treasure Stats -->
        <div class="pixel-card pixel-fade-in pixel-glow">
            <div class="pixel-card-header">
                💎 Treasure Status
            </div>
            <div class="space-y-4">
                <div class="text-center">
                    <div class="pixel-badge pixel-badge-success pixel-pulse" style="font-size: 14px; padding: 10px;">
                        💎 {{ $userPoints }} POINTS
                    </div>
                    <div style="font-size: 8px; opacity: 0.7; margin-top: 5px;">Available Balance</div>
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
 