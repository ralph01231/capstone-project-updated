<x-guest-layout>
    <title> E-LIGTAS | SIGN UP</title>

        <div class="flex justify-center items-center h-screen">
            <div class="w-96 p-6 shadow-xl bg-green-50">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- logo -->

                    <h1 class=" block text-center text-3xl font-semibold">SIGN UP</h1>
                    <hr class="mt-3">
                    {{-- name --}}

                    <div class="mt-3">
                        <label for="name" class="block text-base font-bold mb-2">Name</label>
                        <input type="text" name="name" placeholder="Name" id="name"
                            class="rounded-lg h-10 w-full text-base px-2 py-1 border-none ring-2 border-gray-200 focus:outline-5 focus:ring-2 focus:border-gray-600" value="{{ old('name') }}">
                    </div>

                    <span>
                        @error('name')
                            <div class="text-red-500 font-bold">{{ $message }}</div>
                        @enderror
                    </span>
                    {{-- email --}}
                    <div class="mt-3">
                        <label for="email" class="block text-base font-bold mb-2">Email</label>
                        <input type="email" name="email" placeholder="Email" id="email"
                            class="rounded-lg  h-10  w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600" value="{{ old('email') }}">
                    </div>
                    <span>
                        @error('email')
                            <div class="text-red-500 font-bold">{{ $message }}</div>
                        @enderror
                    </span>

                    {{-- usertype --}}
                    <div class="mt-3">
                        <label for="usertype" class="block text-base font-bold  mb-2">User From:</label>
                        <select name="usertype" id="usertype"
                            class="rounded-lg  h-10  w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600">
                            <option value="admin">--Barangay--</option>
                            <option value="admin">admin</option>
                            <option value="sector">sector</option>
                        </select>
                    </div>
                    <span>
                        @error('usertype')
                            <div class="text-red-500 font-bold">{{ $message }}</div>
                        @enderror
                    </span>


                    {{-- password --}}
                    <div class="mt-3">
                        <label for="password" class="block text-base font-bold mb-2">Password</label>
                        <input type="password" name="password" placeholder="Password" id="password"
                            class=" form-control @error('password') is-invalid @enderror rounded-lg h-10 w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600"
                            autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback text-red-500"  role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- confirm password --}}
                    <div class="mt-3">
                        <label for="password" class="block text-base font-bold mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password" id="password"
                            class=" form-control @error('password') is-invalid @enderror rounded-lg h-10 w-full text-base px-2 py-1 border-none ring-2 border-gray-300 focus:outline-5 focus:ring-2 focus:border-gray-600"
                            autocomplete="current-password">
                    </div>

                    <div class="flex justify-center mt-5">
                        <p>Have account already? <a href=" {{ route('login') }}" class="text-indigo-800 font-semibold">Sign In</a></p>
                    </div>

                    <div class="mt-5 flex justify-center ">
                        <button type="submit"
                            class=" border-2 h-10 w-40   border-red-500/90  bg-red-500 text-base font-semibold text-white hover:bg-transparent hover:text-red-500">SIGN
                            UP</button>
                    </div>
            </div>
            </form>
        </div>

</x-guest-layout>