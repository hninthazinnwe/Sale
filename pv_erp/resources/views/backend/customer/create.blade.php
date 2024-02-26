<x-layout>
    <x-content>
    <div>
        <form method="POST"action="{{route('customers.store')}}">
        @csrf
            <div>name: <input type="text" name="name"></div>
            <div>phone: <input type="text" name="phone"></div>
            <div>address: <input type="text" name="address"></div>
            <div>contact person: <input type="text" name="contact_person"></div>
            <div>email: <input type="text" name="email"></div>
            <div><button type="submit">Save</button></div>
        </form>
        </div>
</x-layout>
</x-content>
