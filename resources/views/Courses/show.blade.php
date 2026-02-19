<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->course_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-center items-stretch gap-6 flex-wrap">
                        <div
                            class="flex-1 min-w-[300px] max-w-[350px] border rounded-lg p-4 shadow flex flex-col justify-between mb-4 mx-3">
                            <h3 class="text-lg font-semibold">{{ $course->course_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $course->description }}</p>
                            <p class="text-sm font-bold">${{ $course->price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>