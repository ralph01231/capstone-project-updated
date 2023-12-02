<x-guest-layout>
    <title> E-LIGTAS | SIGN IN </title>

    <div class="flex justify-center items-center h-screen shadow-lg">
        <div class="w-96 p-6 shadow-xl bg-green-50">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- logo -->

                <div class=" flex justify-center">
                    <img src="{{ url('/images/e-ligtas-removebg-preview (1).png') }}" alt="logo">
                </div>


                <h1 class=" block text-center text-3xl font-semibold">Admin Login</h1>
                <hr class="mt-3">

                @if (session()->has('success'))
                    <x-success role="alert">
                        {{ session()->get('success') }}
                    </x-success>
                @endif


                <div class="mt-3">
                    <label for="email" class="block text-base  mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email"
                        class="rounded-lg  h-10  w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600"
                        autocomplete="new-password
            @error('title') is-invalid @enderror
            " value="{{ old('email') }}">
                </div>

                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror


                <div class="mt-3">
                    <label for="password" class="block text-base  mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="rounded-lg  h-10  w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600
            @error('title') is-invalid @enderror
            ">
                </div>

                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror


                <div class="mt-3 flex justify-between items-center">
                    <div>
                        <input type="checkbox" id="chckbox">
                        <label for="chckbox">Remember me?</label>


                    </div>
                    <div>
                        <a href="#" class="text-indigo-800 font-semibold">Forgot password</a>
                    </div>
                </div>
                {{-- sign Up --}}
                <div>
                    <p>Dont have acount yet? <a href=" {{ route('register') }}"
                            class="text-indigo-800 font-semibold">Sign Up</a></p>
                </div>

                <div class="mt-5">
                    <button type="submit"
                        class=" border-2 border-red-500/90 w-full bg-red-500 text-base font-semibold text-white rounded-md hover:bg-transparent hover:text-red-500">Login</button>
                </div>

        </div>
        </form>
    </div>

</x-guest-layout>
