<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Edit</title>
</head>
<body>
    <form method="POST"action="{{route('customers.update', $customer->id)}}">
    @csrf
    @method('PUT')
        <div>name: <input type="text" name="name" value="{{$customer->name}}"></div>
        <div>phone: <input type="text" name="phone" value="{{$customer->phone}}"></div>
        <div>address: <input type="text" name="address" value="{{$customer->address}}"></div>
        <div>contact person: <input type="text" name="contact_person" value="{{$customer->contact_person}}"></div>
        <div>email: <input type="text" name="email" value="{{$customer->email}}"></div>
        <div><button type="submit">Update</button></div>
    </form>
</body>
</html>