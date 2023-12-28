<main class="main" style="background-color: #FAFAFA;">
    <div class="page-header text-center" style="background-image: url('{{asset('frontend/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <strong>Success</strong> {{Session::get('success_message')}}
                        </div>
                        @endif
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th class="remove-col"><button class="btn-remove" wire:click.prevent="destroyAll()"><i class="icon-close"></i></button></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(Cart::instance('cart')->count() > 0)
                                @foreach (Cart::instance('cart')->content() as $item)
                                    
                                <tr>
                                    <td class="product-col">
                                        <div class="product"  style="background-color: #fafafa;">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{asset('frontend/assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">${{$item->model->regular_price}}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity d-flex justify-content">
                                            <div class="input-group-prepend"><button style="min-width: 26px" class="btn btn-decrement btn-spinner" type="button" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"><i class="fa fa-minus"></i></button></div>
                                            <input type="text" class="form-control" value="{{$item->qty}}" min="1" data-max="120" pattern="[0-9]*" required><div class="input-group  input-spinner">
                                            <div class="input-group-append"><button style="min-width: 5px;" class="btn btn-increment btn-spinner" type="button" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"><i class="fa fa-plus"></i></button></div></div>
                                            
                                        </div>
                                    </td>
                                    <td class="total-col">${{$item->subtotal}}</td>
                                    <td class="remove-col"><button class="btn-remove" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="icon-close"></i></button></td>
                                </tr>
                                @endforeach
                                @else
                                <p>No Item in cart</p>
                                @endif
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            

                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>${{Cart::subtotal()}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-subtotal">
                                        <td>Tax:</td>
                                        <td>${{Cart::tax()}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$0.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$10.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                                <label class="custom-control-label" for="express-shipping">Express:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$20.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>${{Cart::total()}}</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="checkout_list.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                        </div><!-- End .summary -->

                        <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->