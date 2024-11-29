
@extends('layouts.app')
@section('content')  
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Edit Shipping Details</h2>
        <form action="{{route('cart.shipping.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="name" required="" value="{{old('name', $address ? $address->name : '')}}">
                        <label for="name">Full Name *</label>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="phone" required="" value="{{old('phone', $address ? $address->phone : '')}}">
                        <label for="phone">Phone Number *</label>
                        @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="zip" required="" value="{{old('zip', $address ? $address->zip : '')}}">
                        <label for="zip">Postal code *</label>
                        @error('zip') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" name="state" required="" value="{{old('state', $address ? $address->state : '')}}">
                        <label for="state">Province *</label>
                        @error('state') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="city" required="" value="{{old('city', $address ? $address->city : '')}}">
                        <label for="city">Town / City *</label>
                        @error('city') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="address" required="" value="{{old('address', $address ? $address->address : '')}}">
                        <label for="address">House no, Building Name *</label>
                        @error('address') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="locality" required="" value="{{old('locality', $address ? $address->locality : '')}}">
                        <label for="locality">Road Name, Area *</label>
                        @error('locality') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="landmark" required="" value="{{old('landmark', $address ? $address->landmark : '')}}">
                        <label for="landmark">Landmark *</label>
                        @error('landmark') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="col-12 text-end">
                    <a href="{{route('cart.checkout')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Shipping Details</button>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection