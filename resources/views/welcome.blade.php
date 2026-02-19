<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="h3 fw-semibold text-dark mb-1">Courses</h2>
            <p class="text-muted mb-0">Choose a course and start learning today.</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container">
            {{-- <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5"> --}}
                    <div class="row g-4">
                        @foreach ($courses as $course)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card h-100 border rounded-4 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <a href="{{ route('courses.show', $course->slug) }}"
                                        class="h5 fw-semibold text-decoration-none text-dark mb-2">
                                        {{ $course->course_name }}
                                    </a>
                                    <p class="text-muted small mb-4">{{ $course->description }}</p>

                                    <div class="mt-auto d-flex align-items-center justify-content-between">
                                        <p class="fw-bold fs-5 mb-0">${{ $course->price }}</p>
                                        <a href="#" class="btn btn-primary btn-sm px-3">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{--
            </div>
        </div> --}}
    </div>
</x-app-layout>