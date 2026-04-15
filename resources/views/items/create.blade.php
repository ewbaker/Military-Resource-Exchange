<!-- 1. Display success message if it exists -->
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<!-- 2. Display validation errors if something is missing -->
@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- 3. Your original form -->
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div>
        <label>Item Name:</label><br>
        <input type="text" name="name" required>
    </div>
    
    <div style="margin-top: 10px;">
        <label>Describe it quickly:</label><br>
        <textarea name="rough_description" required style="width: 300px; height: 100px;"></textarea>
    </div>
    
    <button type="submit" style="margin-top: 10px;">List Item with AI</button>
</form>