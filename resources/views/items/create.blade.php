<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Military Resource Exchange - Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- 1. Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Resource Exchange</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <!-- 2. Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- 3. Form Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">List New Equipment</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('items.store') }}" method="POST" id="aiForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Item Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Torque Wrench" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rough Description</label>
                                <textarea name="rough_description" class="form-control" rows="4" placeholder="e.g. a metal stick with a heavy end" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100" id="aiSubmitBtn">
                                List Item with AI
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. JavaScript for AI Processing Spinner -->
    <script>
        document.getElementById('aiForm').addEventListener('submit', function() {
            const btn = document.getElementById('aiSubmitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> AI is processing...';
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>