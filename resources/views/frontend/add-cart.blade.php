@extends('frontend.master')

@section('title')
    Cart Page
@endsection

@section('main-content')
<div class="container">
    <style>
        .cart.style2 { width: 100%; overflow-x: auto; margin-bottom: 40px; }
        .cart table { width: 100%; border-collapse: collapse; background: #fff; }
        .cart th, .cart td { padding: 15px; border: 1px solid #eee; vertical-align: middle; }
        .cart__header { background-color: #f9f9f9; font-weight: 600; color: #333; }
        .cart__image-wrapper { width: 90px; padding: 0; }
        .cart__image { width: 80px; height: auto; border-radius: 5px; border: 1px solid #ddd; }
        .cart__meta .list-view-item__title { font-weight: 600; color: #333; }
        .cart__meta-text { font-size: 13px; color: #777; }
        .cart__price-wrapper, .cart-price { font-size: 16px; font-weight: 600; color: #000; }
        .cart__qty { display: flex; justify-content: center; align-items: center; }
        .qtyField { display: inline-flex; align-items: center; border: 1px solid #ddd; border-radius: 5px; overflow: hidden; }
        .qtyField input.qty { width: 40px; text-align: center; border: none; outline: none; padding: 5px; }
        .qtyBtn { background-color: #f1f1f1; color: #000; padding: 8px 10px; cursor: pointer; font-size: 14px; }
        .qtyBtn:hover { background-color: #e2e2e2; }
        .cart__remove i { color: #ff4d4d; font-size: 16px; }
        .cart__remove:hover i { color: #c0392b; }
        .cart__footer .solid-border { padding: 20px; border: 1px solid #eee; border-radius: 6px; background-color: #fdfdfd; }
        .cart__footer .row { margin-bottom: 10px; }
        .cart__subtotal-title { font-weight: 600; font-size: 15px; color: #444; }
        .checkout { width: 100%; background-color: #28a745; color: #fff; border: none; font-weight: 600; padding: 10px; margin-top: 10px; transition: all 0.3s ease-in-out; }
        .checkout:hover { background-color: #218838; }
        .paymnet-img img { max-width: 100%; margin-top: 15px; border: 1px solid #ccc; border-radius: 4px; }
        .cart_tearm label { font-size: 14px; color: #555; }
        @media (max-width: 768px) {
            .cart__header th, .cart__row td { font-size: 13px; }
            .qtyField input.qty { width: 30px; }
            .qtyBtn { padding: 6px 8px; }
            .cart__footer { margin-top: 30px; }
        }
    </style>

    <div class="row">
        <div class="col-12 main-col">
            <div class="alert alert-success text-uppercase" role="alert">
                <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got free shipping!
            </div>

            <form action="#" method="post" class="cart style2">
                <table>
                    <thead class="cart__row cart__header">
                        <tr>
                            <th colspan="2" class="text-center">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Total</th>
                            <th class="action">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($add_carts as $add_cart)
                            <tr class="cart__row border-bottom cart-flex border-top">
                            <td class="cart__image-wrapper cart-flex-item">
                                <a href="#"><img class="cart__image" src="{{ asset('admin/uploads/book_img/' . $add_cart->book->book_img) }}" alt="Elastic Waist Dress"></a>
                            </td>
                            <td class="cart__meta cart-flex-item">
                                <div class="list-view-item__title"><a href="#">{{ $add_cart->book->title }}</a></div>
                                <div class="cart__meta-text">format:{{ $add_cart->book->format }} <br>audiance: {{ $add_cart->book->audience }}</div>
                            </td>
                            <td class="cart__price-wrapper cart-flex-item"><span class="money">{{ $add_cart->book->price }}</span></td>
                            <td class="cart__update-wrapper cart-flex-item text-right">
                                <div class="cart__qty text-center">
                                    <div class="qtyField">
                                        <input class="cart__qty-input qty" type="text" name="updates[]" value="{{  $add_cart->quantity }}" readonly>
                                    </div>
                                </div>
                            </td>

                            @php
                               $total =  $add_cart->book->price * $add_cart->quantity ;
                            @endphp

                            <td class="text-right cart-price"><span class="money">${{ $total }}</span></td>
                           <form method="POST" action="{{ route('cart.destroy' , $add_cart->id) }}">
                            @csrf
                             @method('DELETE')
                             <td class="text-center">
                            <a href="{{ route('cart.destroy', $add_cart->id) }}" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-xmark"></i></a>
                        </td>
                           </form>
                        </tr>
                       @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left"><a href="{{ url('/') }}" class="btn btn-secondary btn--small cart-continue">Continue shopping</a></td>
                            <td colspan="3" class="text-right">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>

  <div class="container mt-4">
    <style>
        /* Container and form styling (existing) */
        .container {
            max-width: 1140px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .row > div { box-sizing: border-box; }
        .col-md-8 {
            background: #f9f9f9;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }
        .col-md-8 h4 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 25px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 8px;
            color: #28a745;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }
        input.form-control, select.form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        input.form-control:focus, select.form-control:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
        }
        .col-md-4.cart__footer {
            background: #fff;
            padding: 30px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgb(0 0 0 / 0.08);
            font-family: Arial, sans-serif;
        }
        .col-md-4.cart__footer h4 {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 25px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 8px;
            color: #28a745;
        }
        .solid-border > div {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            color: #444;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }
        .solid-border > div strong {
            font-size: 1.25rem;
            color: #222;
        }
        .solid-border > div:last-child {
            border-bottom: none;
            padding-top: 15px;
        }
        .solid-border p {
            font-size: 0.95rem;
            color: #555;
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        /* Terms & Conditions Container */
        .terms-container {
            margin-top: 25px;
            font-size: 0.95rem;
            color: #555;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .terms-container input[type="checkbox"] {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: #28a745;
            border-radius: 5px;
            transition: transform 0.2s ease;
            border: 1.5px solid #ccc;
        }
        .terms-container input[type="checkbox"]:focus {
            outline: 2px solid #28a745;
            outline-offset: 2px;
            transform: scale(1.1);
        }
        .terms-container label {
            cursor: pointer;
            user-select: none;
            font-weight: 600;
            color: #333;
            line-height: 1.2;
        }
        .terms-container a {
            color: #28a745;
            text-decoration: underline;
            transition: color 0.3s ease;
        }
        .terms-container a:hover {
            color: #1e7e34;
        }

        /* Updated Place Order Button */
        .btn-place-order {
            margin-top: 30px;
            width: 100%;
            background: linear-gradient(45deg, #28a745, #1e7e34);
            border: none;
            padding: 16px 0;
            font-weight: 700;
            font-size: 1.3rem;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.6);
            cursor: pointer;
            transition: background 0.4s ease, box-shadow 0.4s ease;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1.1px;
            user-select: none;
        }
        .btn-place-order:hover, 
        .btn-place-order:focus {
            background: linear-gradient(45deg, #1e7e34, #145214);
            box-shadow: 0 8px 18px rgba(29, 124, 22, 0.8);
            outline: none;
        }
        .btn-place-order:active {
            transform: scale(0.98);
            box-shadow: 0 4px 10px rgba(29, 124, 22, 0.9);
        }

        .mt-3.text-center img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
             margin-left: 3rem;
            margin-top: 1rem;
        }
        @media (max-width: 767px) {
            .col-md-8, .col-md-4.cart__footer {
                flex: 1 1 100%;
                max-width: 100%;
                margin-bottom: 30px;
                padding: 20px;
            }
            .btn-place-order {
                font-size: 1.1rem;
            }
        }
    </style>

    <form action="{{ route('cart.checkout') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- User Info & Address Form -->
            <div class="col-md-8 mb-4">
                <h4>Billing Details</h4>
                <div class="form-group mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" >
              
                    @error('name')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" >
                 @error('email')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control @error ('phone') is-invalid @enderror" >
                 @error('phone')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control @error ('address') is-invalid @enderror" >
                @error('address')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control @error ('city') is-invalid @enderror" >
                 @error('city')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Country</label>
                  <select name="country_id" class="form-control @error ('country_id') is-invalid @enderror">
                        <option value="">-- select your country --</option>
                           @foreach ($countries as $country)                    
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Postal/Zip Code</label>
                    <input type="text" name="zipcode" class="form-control @error ('zipcode') is-invalid @enderror" >
                 @error('zipcode')
                        <div class=" text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4 cart__footer">
                <h4>Order Summary</h4>
                <div class="solid-border p-3">
                    <div class="d-flex justify-content-between border-bottom pb-2">
                        <span>Subtotal</span>
                        <span>${{ $subtotel }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Tax</span>
                        <span>${{ $tex }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Shipping</span>
                        <span>{{ $shipping }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pt-2">
                        <strong>Grand Total</strong>
                        <strong>${{ $grandtotel }}</strong>
                    </div>

                    <!-- Updated Terms & Conditions -->
                    <p class="terms-container">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">
                            I agree with the 
                            <a href="#" target="_blank" rel="noopener noreferrer">terms and conditions</a>
                        </label>
                    </p>

                    <!-- Updated Place Order Button -->
                    <button type="submit" class="btn-place-order">
                        Place Order (Cash on Delivery)
                    </button>

                    <div class="mt-3 text-center">
                        <img src="{{ asset('frontend/assets/images/payment-img.png') }}" alt="Payment" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Quantity plus
        $(".qtyBtn.plus").click(function(e) {
            e.preventDefault();
            var $input = $(this).siblings("input.qty");
            var currentVal = parseInt($input.val());
            if (!isNaN(currentVal)) {
                $input.val(currentVal + 1);
            } else {
                $input.val(1);
            }
        });

        // Quantity minus
        $(".qtyBtn.minus").click(function(e) {
            e.preventDefault();
            var $input = $(this).siblings("input.qty");
            var currentVal = parseInt($input.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $input.val(currentVal - 1);
            } else {
                $input.val(1);
            }
        });
    });
</script>

@endsection
