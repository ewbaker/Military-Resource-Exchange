<x-app-layout>
    <style>
        .af-hero {
            background: linear-gradient(rgba(0, 33, 87, 0.85), rgba(0, 33, 87, 0.95)), url('https://images.unsplash.com/photo-1524143818320-00832362077e?q=80&w=2070&auto=format&fit=crop');
            background-size: cover; 
            background-position: center; 
            color: white; 
            padding: 80px 0; 
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .af-logo {
            width: 140px;
            height: auto;
            margin-bottom: 25px;
            filter: drop-shadow(0px 4px 10px rgba(0,0,0,0.5));
        }
    </style>

    <div class="af-hero text-center mb-5">
        <div class="container">
            <!-- OFFICIAL AIR FORCE SEAL -->
<img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/United_States_Department_of_the_Air_Force_Seal.svg" alt="" class="af-logo" onerror="this.style.display='none'">
            
            <h1 class="display-3 fw-black tracking-tighter" style="font-weight: 900;">MISSION READY RESOURCES</h1>
            <p class="lead fs-3 mb-5" style="opacity: 0.9;">Air Force Community Equipment Exchange & Accountability Node</p>
            
            <div class="mt-4">
                <a href="{{ route('items.index') }}" class="btn btn-light btn-lg px-5 fw-bold text-primary shadow">ACCESS CATALOG</a>
                @guest
                <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg px-5 ms-3 fw-bold shadow">REQUEST NODE ACCESS</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Info Cards with Icons -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100 text-center">
                <div class="mb-3"><span style="font-size: 2.5rem;">📦</span></div>
                <h5 class="text-primary fw-bold text-uppercase">Logistics Support</h5>
                <p class="text-muted small">Centralized management for Class II through IX resources to streamline PCS transitions.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100 text-center">
                <div class="mb-3"><span style="font-size: 2.5rem;">⚖️</span></div>
                <h5 class="text-primary fw-bold text-uppercase">Integrity First</h5>
                <p class="text-muted small">Our Reputation System tracks resource reliability, ensuring mission-ready condition for every item.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100 text-center">
                <div class="mb-3"><span style="font-size: 2.5rem;">🧠</span></div>
                <h5 class="text-primary fw-bold text-uppercase">AI Integration</h5>
                <p class="text-muted small">Utilizing local LLM processing to automate equipment classification and condition assessment.</p>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted border-top mt-5">
        <p class="mb-1 fw-bold tracking-widest" style="font-size: 0.8rem;">FOR OFFICIAL USE ONLY | &copy; 2026 MILITARY RESOURCE EXCHANGE</p>
        <a href="https://www.af.mil" target="_blank" class="text-primary fw-bold text-decoration-none" style="font-size: 0.85rem;">VISIT OFFICIAL U.S. AIR FORCE SITE</a>
    </footer>
</x-app-layout>