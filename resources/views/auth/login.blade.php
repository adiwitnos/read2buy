@extends('layouts.app')

@section('title', 'Sign In — Read2Buy.com')
@section('meta_description', 'Sign in to Read2Buy to manage your bookmarks and access curated buying guides.')

@section('content')
<div class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="font-serif-editorial text-3xl font-bold tracking-tight text-stone-900">
            Sign In to Read2Buy.com
        </h1>
    </div>

    <!-- Card -->
    <div class="bg-white border border-stone-200/80 rounded-xl shadow-xs p-6 sm:p-8">
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                    placeholder="you@domain.com"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700">
                        Password
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-stone-500 hover:text-stone-900 underline transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    name="remember"
                    class="h-4 w-4 rounded border-stone-300 text-stone-900 focus:ring-stone-900 accent-stone-900"
                >
                <label for="remember_me" class="ml-2 block text-xs text-stone-600 select-none cursor-pointer">
                    Remember me on this device
                </label>
            </div>

            <!-- Simple Captcha -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="captcha" class="block text-xs font-semibold uppercase tracking-wider text-stone-700">
                        Security Verification
                    </label>
                    <span class="text-xs text-stone-600 font-mono">
                        Calculate: <strong class="text-stone-900 font-bold bg-stone-100 px-2 py-0.5 rounded border border-stone-200">{{ \App\Http\SimpleCaptcha::getQuestion() }} = ?</strong>
                    </span>
                </div>
                <input 
                    id="captcha" 
                    type="number" 
                    name="captcha" 
                    required 
                    inputmode="numeric"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('captcha') border-red-500 @enderror"
                    placeholder="Enter the calculation result"
                >
                @error('captcha')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors cursor-pointer shadow-sm flex items-center justify-center gap-2"
                >
                    <span>Sign In</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Divider & Register Link -->
        <div class="mt-6 pt-6 border-t border-stone-200/80 text-center text-xs text-stone-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-semibold text-stone-900 hover:underline transition-colors ml-1">
                Create one now
            </a>
        </div>
    </div>
</div>
@endsection
