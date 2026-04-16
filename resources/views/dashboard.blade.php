<x-app-layout>
    <div class="container-fluid">
        <!-- AI Sync Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
                <strong>NODE SYNCED:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- User Reliability Stats -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-white p-4 text-center">
                    <h6 class="text-uppercase text-muted fw-bold small">Reliability Rating</h6>
                    <h1 class="display-2 fw-black text-primary">{{ Auth::user()->reputation_score ?? '100' }}</h1>
                    <hr>
                    <div class="small fw-bold text-uppercase">Designation</div>
                    <div class="text-dark">{{ Auth::user()->name }}</div>
                    <div class="badge bg-dark mt-2 mb-3">Rank: {{ explode(' ', Auth::user()->name)[0] }}</div>

                    <!-- THE AI SYNC BUTTON -->
                    <form action="{{ route('reputation.update', Auth::id()) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100 fw-bold py-2">
                            🔄 SYNC RELIABILITY NODE (AI)
                        </button>
                    </form>
                    <small class="text-muted mt-2 d-block" style="font-size: 0.65rem;">
                        Recalculates status based on latest peer reviews using Ollama Sentiment Engine.
                    </small>
                </div>
            </div>

            <!-- Gear in Possession -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 bg-white">
                    <div class="card-header bg-white border-bottom p-3">
                        <h5 class="mb-0 fw-black text-uppercase">Possessions Tracking</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>EQUIPMENT</th>
                                    <th>STATUS</th>
                                    <th>DUE DATE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(Auth::user()->loans->where('status', 'borrowed') as $loan)
                                    <tr>
                                        <td class="fw-bold">{{ $loan->item->name }}</td>
                                        <td>
                                            @if($loan->due_date < now())
                                                <span class="badge bg-danger">⚠️ OVERDUE</span>
                                            @else
                                                <span class="badge bg-success text-uppercase">Secured</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('items.return', $loan->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-dark text-uppercase fw-bold" style="font-size: 0.7rem;">Return</button>
                                                </form>
                                                <form action="{{ route('items.renew', $loan->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.7rem;">Renew</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">No equipment currently assigned to this node.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>