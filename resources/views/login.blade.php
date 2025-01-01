<x-layout>
    <div class="h-screen bg-slate-500 flex items-center justify-center">
        <div class="flex flex-col items-center bg-white p-8 rounded shadow-md">
            <form class="flex flex-col gap-4 w-80" action="/login">
                <input type="email" name="email" class="border p-2 rounded" placeholder="Email" required>
                <input type="password" name="password" class="border p-2 rounded" placeholder="Password" required>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Submit</button>
            </form>
            <a href="{{ route('redirect') }}" class="text-blue-500 mt-4 hover:underline">Login with Google</a>
        </div>        
    </div>
</x-layout>
