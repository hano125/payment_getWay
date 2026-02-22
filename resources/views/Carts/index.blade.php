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
                        @if($cart && $cart->cartEmpty())
                        <div class="alert alert-info text-center mb-0">
                            <i class="bi bi-cart-x fs-3"></i>
                            <p class="mb-0">Your cart is empty.</p>
                        </div>
                        @else
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart->courses as $course)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('courses.show', $course->slug) }}"
                                        class="fw-semibold text-decoration-none text-primary">{{ $course->course_name
                                        }}</a>
                                </div>
                                <span class="badge bg-success fs-6">${{ $course->price }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>