<x-app-layout>
    <div class="container-fluid">
        <!-- System Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
                <strong>SUCCESS:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4">
                <strong>BLOCK:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-uppercase tracking-tighter">Available Equipment</h2>
            <span class="badge bg-dark">Total Resources: {{ $items->count() }}</span>
        </div>
        
        <div class="row">
            @foreach($items as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0 fw-bold">{{ $item->name }}</h5>
                            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">{{ $item->category }} | Condition: {{ $item->condition }}</small>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <p class="card-text text-muted small mb-4" style="min-height: 60px;">{{ $item->description }}</p>
                            
                            <div class="mt-auto">
                                <!-- Owner Info (Always Visible) -->
                                <div class="mb-2">
                                    <span class="badge bg-info text-dark w-100 py-2">
                                        Owner Score: {{ $item->user->reputation_score ?? 'N/A' }}%
                                    </span>
                                </div>

                                <!-- Borrowing Logic & RED ALERT Box -->
                                @if($item->availability_status == 'available')
                                    <form action="{{ route('items.checkout', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100 fw-bold text-uppercase">Borrow Gear</button>
                                    </form>
                                @else
                                    @php 
                                        $activeLoan = $item->loans->where('status', 'borrowed')->first();
                                    @endphp
                                    
                                    <!-- RED WARNING: Shows current possessor -->
                                    <div class="bg-danger text-white p-2 rounded small shadow-sm">
                                        <div class="fw-bold text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">🚫 Currently Checked Out By:</div>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <span class="fw-bold">{{ $activeLoan->user->name ?? 'Unknown User' }}</span>
                                            <span class="badge bg-dark text-white">{{ $activeLoan->user->reputation_score ?? '?' }}%</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>