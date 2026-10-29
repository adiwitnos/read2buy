@auth
    <div class="fi-topbar-user-actions flex items-center gap-4 px-3" style="display: flex; align-items: center; gap: 1rem; height: 100%; margin: 0; padding: 0 0.75rem;">

        <!-- Keluar Button -->
        <form method="POST" action="{{ route('logout') }}" style="display: inline-flex; align-items: center; margin: 0; padding: 0;">
            @csrf
            <button type="submit"
                    class="px-4 py-2 text-xs uppercase tracking-wider font-semibold rounded-md bg-stone-900 text-white hover:bg-stone-800 transition-colors shadow-xs shrink-0 cursor-pointer"
                    style="display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; text-decoration: none; white-space: nowrap; font-family: inherit;">
                SIGN OUT
            </button>
        </form>
    </div>
@endauth
