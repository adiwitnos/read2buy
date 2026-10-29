@extends('layouts.app')

@section('title', 'Forgot Password — Read2Buy.com')
@section('meta_description', 'Reset your Read2Buy account password with a secure recovery link sent to your email.')

@section('content')
<div class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="font-serif-editorial text-3xl font-bold tracking-tight text-stone-900">
            Forgot Password
        </h1>
        <p class="mt-2 text-sm text-stone-600">
            Enter your registered email and we'll send you a password reset link.
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white border border-stone-200/80 rounded-xl shadow-xs p-6 sm:p-8">
        <!-- Session Status Alert -->
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-2.5">
                <svg class="w-4 h-4 shrink-0 text-emerald-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="leading-relaxed">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Registered Email Address
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
                    placeholder="name@domain.com"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
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
                    placeholder="Enter sum result above"
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
                    <span>Send Password Reset Link</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Divider & Back to Login Link -->
        <div class="mt-6 pt-6 border-t border-stone-200/80 text-center text-xs text-stone-500">
            Remember your password?
            <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline transition-colors ml-1">
                Back to Sign In
            </a>
        </div>
    </div>
</div>
@endsection
