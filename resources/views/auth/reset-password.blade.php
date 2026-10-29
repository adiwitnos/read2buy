@extends('layouts.app')

@section('title', 'Reset Password — Read2Buy.com')
@section('meta_description', 'Set a new password for your Read2Buy account.')

@section('content')
<div class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-md mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-stone-100 text-stone-800 border border-stone-200 mb-4">
            <svg class="w-3.5 h-3.5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Security Update
        </span>
        <h1 class="font-serif-editorial text-3xl font-bold tracking-tight text-stone-900">
            Reset Password
        </h1>
        <p class="mt-2 text-sm text-stone-600">
            Set a new password to secure your account.
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white border border-stone-200/80 rounded-xl shadow-xs p-6 sm:p-8">
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $request->email) }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    New Password
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                    placeholder="Minimum 8 characters"
                >
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
                    Confirm New Password
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    class="w-full px-3.5 py-2.5 bg-stone-50/50 border border-stone-300 rounded-lg text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-900 focus:border-transparent transition-all"
                    placeholder="Re-enter new password"
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
                    <span>Update Password</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
