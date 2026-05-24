@extends('layout')

@section('title', 'Sign up as a Student | Tutzy')

@section('content')
<main class="min-h-[85vh] flex items-center justify-center py-16 px-4 sm:px-6 bg-gradient-to-b from-[#fafaf8] to-white relative">
    
    <!-- Very subtle background element -->
    <div class="absolute top-[20%] left-[20%] w-[500px] h-[500px] bg-[#A3E635]/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-[480px] bg-white/90 backdrop-blur-md rounded-3xl p-8 sm:p-10 shadow-[0_8px_40px_rgba(0,0,0,0.04)] border border-gray-100 relative z-10">
        
        <div class="mb-8 text-center">
            <h1 class="text-[28px] sm:text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Sign up as a student</h1>
            <p class="text-[15px] text-gray-500 font-medium">Find expert tutors and start learning with confidence.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" /></svg>
                <div class="text-[13px] font-medium text-red-800">
                    There was a problem with your submission. Please check the fields below.
                </div>
            </div>
        @endif

        <div class="flex justify-center items-center gap-2 mb-8 text-sm font-medium">
            <span class="text-gray-500">Already have an account?</span>
            <a href="{{ route('login') }}" class="font-bold text-[#84cc16] hover:text-[#65a30d] transition-colors">Log in</a>
        </div>

        <a href="{{ route('auth.google') }}" class="auth-btn-google mb-6">
            <svg viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg"><g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)"><path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/><path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/><path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/><path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/></g></svg>
            Continue with Google
        </a>

        <div class="auth-divider">
            <div class="auth-divider-line"></div>
            <div class="auth-divider-text">or</div>
            <div class="auth-divider-line"></div>
        </div>

        <form action="{{ route('signup.student.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="auth-label" for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="auth-input @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Your full name" required>
                @error('name')
                    <p class="mt-1.5 text-[12px] font-medium text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="auth-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="auth-input @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Your email address" required>
                @error('email')
                    <p class="mt-1.5 text-[12px] font-medium text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="auth-label" for="password">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="auth-input pr-10 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="Create a password" required>
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" onclick="togglePassword('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-[12px] font-medium text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-btn-primary mt-6">
                Create student account
            </button>
        </form>

        <div class="mt-8 text-center text-[13px] text-gray-400 font-medium">
            By signing up, you agree to our <a href="#" class="underline hover:text-gray-600">Terms</a> and <a href="#" class="underline hover:text-gray-600">Privacy Policy</a>.
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
    }
</script>
@endpush
