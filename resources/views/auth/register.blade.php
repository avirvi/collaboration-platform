<x-layout>
    <x-slot name="title">
        {{__('auth.Register')}}
    </x-slot>
    <h1 class="mb-4">{{__('auth.Register')}}</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">{{__('auth.Username')}}</label>
            <input type="text" name="username" class="form-control" required
                value="{{ old('username') }}">
            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{__('auth.Email_address')}}</label>
            <input type="email" name="email" class="form-control" required
                value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{__('auth.Password')}}</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{__('auth.Confirm_Password')}}</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{__('auth.Register')}}</button>
    </form>
</x-layout>