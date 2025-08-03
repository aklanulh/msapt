<x-layouts.admin>
    <!-- Konten Manage Redeems di sini -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Pending Redeems</h3>
                <table class="table">
                    <thead>
                        <tr>
                             <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRedeems as $redeem)
                            <tr>
                                <td>{{ $redeem->user_id }}</td>
                                <td>{{ $redeem->owner_name }}</td>
                                <td>{{ $redeem->bank_name }}</td>
                                <td>{{ $redeem->account_number }}</td>
                                <td>{{ $redeem->amount }}</td>
                                <td>{{ $redeem->status }}</td>
                                <td>
                                    <form action="{{ route('approve-redeem', $redeem->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="material-icons">check</i>
                                        </button>
                                    </form>
                                    <form action="{{ route('reject-redeem', $redeem->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Approved/Rejected Redeems</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actionRedeems as $redeem)
                            <tr>
                                <td>{{ $redeem->user_id }}</td>
                                <td>{{ $redeem->owner_name }}</td>
                                <td>{{ $redeem->bank_name }}</td>
                                <td>{{ $redeem->account_number }}</td>
                                <td>{{ $redeem->amount }}</td>
                                <td>{{ $redeem->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
