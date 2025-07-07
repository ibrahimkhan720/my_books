@extends('frontend.master')

@section('title')
    {{ 'registar-page' }}
@endsection

@section('main-content')
<div style="max-width: 450px; margin: 40px auto; padding: 25px; border: 1px solid #ccc; border-radius: 10px; background-color: #fafafa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h2 style="text-align: center; margin-bottom: 30px; color: #222;">Register</h2>
    
    <form action="{{ route('register.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
        @csrf
        
        <label for="name" style="font-weight: 600; color: #444;">Name</label>
        <input type="text" id="name" name="name" placeholder="Your full name" required
               style="padding: 12px; border: 1px solid #bbb; border-radius: 5px; font-size: 16px;">

        <label for="email" style="font-weight: 600; color: #444;">Email</label>
        <input type="email" id="email" name="email" placeholder="example@mail.com" required
               style="padding: 12px; border: 1px solid #bbb; border-radius: 5px; font-size: 16px;">

        <label for="password" style="font-weight: 600; color: #444;">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required
               style="padding: 12px; border: 1px solid #bbb; border-radius: 5px; font-size: 16px;">

        <label for="password_confirmation" style="font-weight: 600; color: #444;">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required
               style="padding: 12px; border: 1px solid #bbb; border-radius: 5px; font-size: 16px;">
        
        <button type="submit"
                style="padding: 14px; background-color: #007bff; color: white; border: none; border-radius: 6px; font-size: 18px; cursor: pointer; transition: background-color 0.25s;">
            Register
        </button>
    </form>
</div>
@endsection
