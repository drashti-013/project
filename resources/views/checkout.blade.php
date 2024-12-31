@extends('layouts.clientlayout')  
@section('content')
		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="untree_co-section">
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
		            Returning customer? <a href="{{ route('login') }}">Click here</a> to login
		          </div>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
					<form action="{{ route('order.store') }}" method="POST">
						@csrf
			
						<!-- Email Address -->
						<div class="form-group">
							<label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
							<input type="email" class="form-control @error('c_email') is-invalid @enderror" id="c_email_address" name="c_email" value="{{ old('c_email') }}" placeholder="Email Address"  >
							@error('c_email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
			
						<!-- First and Last Name -->
						<div class="form-group row">
							<div class="col-md-6">
								<label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_fname') is-invalid @enderror" id="c_fname" name="c_fname" value="{{ old('c_fname') }}" placeholder="First Name"  >
								@error('c_fname')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="col-md-6">
								<label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_lname') is-invalid @enderror" id="c_lname" name="c_lname" value="{{ old('c_lname') }}" placeholder="Last Name"  >
								@error('c_lname')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
			
						<!-- Phone -->
						<div class="form-group">
							<label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('c_phone') is-invalid @enderror" id="c_phone" name="c_phone" value="{{ old('c_phone') }}" placeholder="Phone Number"  pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number.">
							@error('c_phone')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
			
						<!-- Address -->
						<div class="form-group">
							<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
							<textarea class="form-control @error('c_address') is-invalid @enderror" id="c_address" name="c_address" placeholder="Address"  >{{ old('c_address') }}</textarea>
							@error('c_address')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
			
						<!-- Country and State -->
						<div class="form-group row">
							<div class="col-md-6">
								<label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_country') is-invalid @enderror" id="c_country" name="c_country" value="{{ old('c_country') }}" placeholder="Country"  >
								@error('c_country')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="col-md-6">
								<label for="c_state" class="text-black">State <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_state') is-invalid @enderror" id="c_state" name="c_state" value="{{ old('c_state') }}" placeholder="State"  >
								@error('c_state')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
			
						<!-- City and Pincode -->
						<div class="form-group row">
							<div class="col-md-6">
								<label for="c_city" class="text-black">City <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_city') is-invalid @enderror" id="c_city" name="c_city" value="{{ old('c_city') }}" placeholder="City"  >
								@error('c_city')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="col-md-6">
								<label for="c_pincode" class="text-black">Pincode <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('c_pincode') is-invalid @enderror" id="c_pincode" name="c_pincode" value="{{ old('c_pincode') }}" placeholder="Pincode"   pattern="[0-9]{6}" title="Please enter a valid 6-digit pincode.">
								@error('c_pincode')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
			
			
	
						<div class="form-group">
						  <label for="c_order_notes" class="text-black">Order Notes</label>
						  <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
						</div>
					
		          </div>
		        </div>
		        <div class="col-md-6">
		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Coupon Code</h2>
		              <div class="p-3 p-lg-5 border bg-white">

		                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
		                <div class="input-group w-75 couponcode-wrap">
		                  <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
		                  <div class="input-group-append">
		                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
		                  </div>
		                </div>

		              </div>
		            </div>
		          </div>

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							@php
								$subtotal = 0; // Initialize subtotal
							@endphp
							@foreach ($items as $item)
								<tr>
									<td>{{ $item->product->product_name }} <strong class="mx-2">x</strong> {{ $item->total_qty }}</td>
									<td>{{ $item->product->price * $item->total_qty}}.00</td>
									@php
            							$subtotal += $item->product->price * $item->total_qty; // Accumulate the subtotal
        							@endphp
							  	</tr>
							@endforeach
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
		                      <td class="text-black">{{ $subtotal }}.00</td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
		                      <td class="text-black font-weight-bold">₹<strong>{{ $subtotal}}.00</strong></td>
		                    </tr>
		                  </tbody>
		                </table>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

		                  <div class="collapse" id="collapsebank">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

		                  <div class="collapse" id="collapsecheque">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <button type="submit"class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
			</form>
		    </div>
		  </div>

@endsection