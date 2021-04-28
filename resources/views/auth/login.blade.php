@extends('layout.base')

@section('body-container')
    <div class="flex justify-center">
        <div class="w-4/12 mt-10 bg-white p-6 rounded-lg">
            @error('error')
                <div class="text-red-500 mb-1 text-sm">
                    {{$message}}
                </div>
                        
            @enderror
            <form action="/login" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only"></label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-4 rouded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <div class="text-red-500 mt-1 text-sm">
                            {{$message}}
                        </div>
                        
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="sr-only"></label>
                    <input type="password" name="password" id="password" placeholder="Your password" class="bg-gray-100 border-2 w-full p-4 rouded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <div class="text-red-500 mt-1 text-sm">
                            {{$message}}
                        </div>
                        
                    @enderror
                </div>
                <div><button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button></div>
                
            </form>
        </div>
    </div>
@endsection