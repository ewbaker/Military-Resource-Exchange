<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="fw-bold text-uppercase mb-4">Submit Review / Appeal</h4>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="fw-bold small">Target Email:</label>
                            <input type="email" name="target_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold small">Rating (1-10):</label>
                            <input type="number" name="rating" class="form-control" min="1" max="10" required>
                        </div>
                        <div class="mb-4">
                            <label class="fw-bold small">Detailed Review/Complaint:</label>
                            <textarea name="review_text" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 fw-bold text-uppercase">Submit Analysis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>