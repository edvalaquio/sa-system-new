@extends('layouts.app')

@section('content')
<form class="" action="testPut" method="post">
    <input type="text" name="username" value="">
    <input type="text" name="name" value="">
    <input type="text" name="email" value="">
    <br>
    <input type="radio" name="gender" value="female">
    <input type="radion" name="gender" value="male">

</form>
@endsection
