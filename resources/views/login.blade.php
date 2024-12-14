<x-layout>
    <div>
        <form action="/login" style="gap: 5px">
            <input type="email" name="email">
            <input type="password" name="password">
            <button type="submit">Submit</button>
        </form>
        <a href="{{ route('redirect') }}">Login with Google</a>
    </div>
</x-layout>