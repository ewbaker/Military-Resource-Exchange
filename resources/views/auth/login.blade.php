<x-guest-layout>
    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-2xl">
        <div class="mb-6 text-center border-b border-gray-200 pb-4">
            <h2 class="text-2xl font-black text-blue-900 tracking-tighter">SECURE DISCONNECT</h2>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Authorized Access Point Only</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label class="block font-bold text-xs text-gray-700 uppercase tracking-wide">Service Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="block mt-1 w-full border-gray-300 bg-gray-50 text-black rounded-md shadow-sm focus:ring-blue-600 focus:border-blue-600 p-3">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4" x-data="{ show: false }">
                <label class="block font-bold text-xs text-gray-700 uppercase tracking-wide">Credential Key</label>
                <div class="relative mt-1">
                    <input :type="show ? 'text' : 'password'" name="password" required 
                           class="block w-full border-gray-300 bg-gray-50 text-black rounded-md shadow-sm focus:ring-blue-600 focus:border-blue-600 p-3 pr-12">
                    
                    <!-- Eye Toggle Button inside the box -->
                    <button type="button" @click="show = !show" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-blue-700 focus:outline-none">
                        <svg x-show="!show" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Submit Button (Ensuring Visibility) -->
            <div class="mt-8">
                <button type="submit" class="w-full bg-blue-900 hover:bg-black text-white font-black py-4 rounded-md shadow-xl transition-all duration-200 tracking-widest text-sm border-b-4 border-blue-950 active:border-b-0 uppercase">
                    Initialize Login Sequence
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>