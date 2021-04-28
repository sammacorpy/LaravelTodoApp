@extends('layout.base')

@section('body-container')
    <div class="flex justify-center">
        <div class="w-4/12 mt-10 bg-white p-6 rounded-lg">
            <form action="/register" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only"></label>
                    <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 border-2 w-full p-4 rouded-lg @error('name') border-red-500 @enderror">
                    @error('name')
                        <div class="text-red-500 mt-1 text-sm">
                            {{$message}}
                        </div>
                        
                    @enderror
                </div>
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
                <div class="mb-4">
                    <label for="confirmpassword" class="sr-only"></label>
                    <input type="password" name="password_confirmation" id="confirmpassword" placeholder="Confirm Password" class="bg-gray-100 border-2 w-full p-4 rouded-lg @error('confirmpassword') border-red-500 @enderror">
                    @error('password_confirmation')
                        <div class="text-red-500 mt-1 text-sm">
                            {{$message}}
                        </div>
                        
                    @enderror
                </div>

                <div><button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button></div>
                
            </form>
        </div>
    </div>
@endsection