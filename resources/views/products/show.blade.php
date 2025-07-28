<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-900 text-white">
        <div class="max-w-6xl mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <section>
                    <div class = "p-4 bg-white/5 rounded-xl flex flex-col text-center">
                        <div class ="self-start text-sm">{{ $product->name }}</div>
                        <div class="py-8 font-bold">
                            @if($product->media)
                                <img src="{{ asset('storage/' . $product->media->file_path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-40 object-cover rounded mb-3">
                            @endif
                            <p>description : {{ $product->description }}</p>
                            <p>Available : {{ $product->quantity }}</p>
                            <p>Price : ${{ $product->price }}</p>
                            <p>Created By : {{ $product->creator->name }}</p>
                            <p>Added At : {{ $product->created_at }}</p>
                            @foreach($product->categories as $category)
                                    <a href="/categories/{{ $category->id }}"
                                       class="bg-gray-700 hover:bg-gray-600 px-2 py-1 rounded-full text-xs transition">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                        </div>
                        <a href ="{{url()->previous()}}" class ="bg-white/10 px-2 hover:bg-white/25 py-1 rounded-xl text-xl transition-colors duration-300" >Back</a>

                    </div>
            </section>


        </div>
    </div>
</x-app-layout>
