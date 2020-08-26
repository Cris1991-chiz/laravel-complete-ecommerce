@extends('layouts.app-layout')

@section('title', 'Thankyou')

@section('content')

<div class="thanks-content">
    <h1>Thank<span class="highlight"> You</span></h1>
    <hr>
    <p><b>Thank you for purchasing products with us.</b></p>
    <p>Your order will be ship as soon as possible.</p>
    <a href="{{route('home.index')}}" class="highlight">Get back to our Homepage.</a> 
</div>
@endsection