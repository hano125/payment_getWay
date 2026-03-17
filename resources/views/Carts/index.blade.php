<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold display-6 text-primary mb-4">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body">
                        @if(!$cart || $cart->cartEmpty())
                        <div class="alert alert-info text-center mb-0">
                            <i class="bi bi-cart-x fs-3"></i>
                            <p class="mb-0">Your cart is empty.</p>
                        </div>
                        @else
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart->courses as $course)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-light mb-2 rounded">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-book fs-4 text-primary me-3"></i>
                                    <a href="{{ route('courses.show', $course) }}"
                                        class="fw-semibold text-decoration-none text-primary">{{ $course->course_name
                                        }}</a>
                                </div>
                                <span class="badge bg-success fs-6 px-3 py-2">{{ $course->Price() }}</span>
                                <a href="{{route('removeFromCart',$course)}}"
                                    class="btn btn-danger btn-sm d-flex align-items-center" title="Remove">
                                    <i class="bi bi-trash me-1"></i> Remove
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <div class="fw-bold fs-5 text-dark">Total: {{ $cart->Total() }}</div>
                            <a href="{{route('checkoutNoneStripeProduct')}}"
                                class="btn btn-primary btn-lg px-4 shadow-sm">
                                <i class="bi bi-credit-card-2-front me-2"></i> Checkout
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>