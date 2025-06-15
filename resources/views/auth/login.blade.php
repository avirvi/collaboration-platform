<x-layout>
    <x-slot name="title">
        {{__('auth.Login')}}
    </x-slot>
    <h1 class="mb-4">{{__('auth.Login')}}</h1>
    <form action="{{ route('login') }}" method="POST">
        @if($errors->has('message'))
        <div class="alert alert-danger">
            <strong>{{ $errors->first('message') }}</strong>
        </div>
        @endif
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{__('auth.Email_address')}}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{__('auth.Password')}}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>
        <button type="submit" class="btn btn-primary">{{__('auth.Login')}}</button>
    </form>
</x-layout>