@extends('layouts.app')

@section('title', 'Register — Read2Buy.com')
@section('meta_description', 'Create a Read2Buy member account to bookmark products and access independent research curation.')

@section('content')
<div class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="font-serif-editorial text-3xl font-bold tracking-tight text-stone-900">
            Create Your Read2Buy.com Account
        </h1>
    </div>

    <!-- Card -->
    <div class="bg-white border border-stone-200/80 rounded-xl shadow-xs p-6 sm:p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Full Name
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                    placeholder="Jane Doe"
                >
                @error('name')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

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
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                    placeholder="At least 8 characters"
                >
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Confirm Password
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all"
                    placeholder="Repeat password"
                >
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
                    placeholder="Enter calculation result"
                >
                @error('captcha')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Privacy Policy Notice -->
            <p class="text-[11px] text-stone-500 leading-relaxed">
                By registering, you agree to our curation standards and <a href="{{ route('legal.privacy-policy') }}" class="underline hover:text-stone-800">Privacy Policy</a>.
            </p>

            <!-- Submit Button -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors cursor-pointer shadow-sm flex items-center justify-center gap-2"
                >
                    <span>Create Read2Buy Account</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Divider & Login Link -->
        <div class="mt-6 pt-6 border-t border-stone-200/80 text-center text-xs text-stone-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline transition-colors ml-1">
                Sign in here
            </a>
        </div>
    </div>
</div>
@endsection
