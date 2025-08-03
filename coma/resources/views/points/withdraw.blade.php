@extends('layouts.app')

@section('title', 'Withdraw Points - COMA')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('points.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Points
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Withdrawal Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-6">Withdrawal Request</h2>
                
                <form id="withdrawForm" action="{{ route('points.process-withdraw') }}" method="POST">
                    @csrf
                    
                    <!-- Points to Withdraw -->
                    <div class="mb-6">
                        <label for="points_amount" class="block text-sm font-medium text-gray-700 mb-2">
                            Points to Withdraw
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="points_amount" 
                                   name="points_amount" 
                                   min="1000" 
                                   max="{{ auth()->user()->total_points }}" 
                                   step="100"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter points amount"
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">points</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Minimum withdrawal: 1,000 points</p>
                    </div>

                    <!-- Money Equivalent -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Money Equivalent
                        </label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg">
                            <span class="text-2xl font-bold text-green-600" id="money_equivalent">Rp 0</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Method
                        </label>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-3" required>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                                    </svg>
                                    Bank Transfer
                                </div>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="e_wallet" class="mr-3" required>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                    </svg>
                                    E-Wallet (OVO, GoPay, DANA)
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Bank Details (shown when bank transfer selected) -->
                    <div id="bank_details" class="mb-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Bank Name
                                </label>
                                <select id="bank_name" name="bank_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Bank</option>
                                    <option value="BCA">BCA</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="CIMB">CIMB Niaga</option>
                                    <option value="Danamon">Danamon</option>
                                </select>
                            </div>
                            <div>
                                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Account Number
                                </label>
                                <input type="text" id="account_number" name="account_number" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                       placeholder="Enter account number">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-2">
                                Account Holder Name
                            </label>
                            <input type="text" id="account_holder" name="account_holder" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                   placeholder="Enter account holder name">
                        </div>
                    </div>

                    <!-- E-Wallet Details (shown when e-wallet selected) -->
                    <div id="ewallet_details" class="mb-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ewallet_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    E-Wallet Type
                                </label>
                                <select id="ewallet_type" name="ewallet_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select E-Wallet</option>
                                    <option value="OVO">OVO</option>
                                    <option value="GoPay">GoPay</option>
                                    <option value="DANA">DANA</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                </select>
                            </div>
                            <div>
                                <label for="ewallet_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="text" id="ewallet_number" name="ewallet_number" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                       placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submit_btn">
                            Submit Withdrawal Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold mb-4">Your Balance</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Points:</span>
                        <span class="font-bold text-lg">{{ number_format(auth()->user()->total_points) }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Value:</span>
                        <span class="font-bold text-lg text-green-600">Rp {{ number_format(auth()->user()->total_money) }}</span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-yellow-800 mb-2">Important Notes:</h4>
                        <ul class="text-sm text-yellow-700 space-y-1">
                            <li>• Minimum withdrawal: 1,000 points</li>
                            <li>• Processing time: 1-3 business days</li>
                            <li>• No withdrawal fees</li>
                            <li>• Withdrawals are irreversible</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pointsInput = document.getElementById('points_amount');
    const moneyEquivalent = document.getElementById('money_equivalent');
    const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
    const bankDetails = document.getElementById('bank_details');
    const ewalletDetails = document.getElementById('ewallet_details');
    const submitBtn = document.getElementById('submit_btn');

    // Update money equivalent when points change
    pointsInput.addEventListener('input', function() {
        const points = parseInt(this.value) || 0;
        const money = points * 1000;
        moneyEquivalent.textContent = 'Rp ' + money.toLocaleString('id-ID');
        
        // Validate minimum amount
        if (points < 1000) {
            this.setCustomValidity('Minimum withdrawal is 1,000 points');
            submitBtn.disabled = true;
        } else {
            this.setCustomValidity('');
            submitBtn.disabled = false;
        }
    });

    // Show/hide payment method details
    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'bank_transfer') {
                bankDetails.classList.remove('hidden');
                ewalletDetails.classList.add('hidden');
                
                // Make bank fields required
                document.getElementById('bank_name').required = true;
                document.getElementById('account_number').required = true;
                document.getElementById('account_holder').required = true;
                
                // Make e-wallet fields not required
                document.getElementById('ewallet_type').required = false;
                document.getElementById('ewallet_number').required = false;
            } else if (this.value === 'e_wallet') {
                ewalletDetails.classList.remove('hidden');
                bankDetails.classList.add('hidden');
                
                // Make e-wallet fields required
                document.getElementById('ewallet_type').required = true;
                document.getElementById('ewallet_number').required = true;
                
                // Make bank fields not required
                document.getElementById('bank_name').required = false;
                document.getElementById('account_number').required = false;
                document.getElementById('account_holder').required = false;
            }
        });
    });

    // Form validation
    document.getElementById('withdrawForm').addEventListener('submit', function(e) {
        const points = parseInt(pointsInput.value) || 0;
        const maxPoints = {{ auth()->user()->total_points }};
        
        if (points > maxPoints) {
            e.preventDefault();
            alert('You cannot withdraw more points than you have!');
            return false;
        }
        
        if (points < 1000) {
            e.preventDefault();
            alert('Minimum withdrawal is 1,000 points!');
            return false;
        }
        
        // Confirm withdrawal
        const money = points * 1000;
        if (!confirm(`Are you sure you want to withdraw ${points.toLocaleString()} points (Rp ${money.toLocaleString('id-ID')})?`)) {
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
