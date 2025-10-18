@extends('user.layouts') {{-- Sử dụng layout user.blade.php --}}

@section('content')
<div class="container mt-4"> {{-- Added mt-4 for top margin --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert"> {{-- Added shadow-sm for alert --}}
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert"> {{-- Added shadow-sm for alert --}}
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> {{-- Using responsive cols and g-4 for gutter --}}
        @foreach ($foods as $food)
        <div class="col">
            <div class="card h-100 shadow-sm"> {{-- Added h-100 for equal height cards, shadow-sm for card --}}
                <div class="card-img-container" style="height: 220px; overflow: hidden;"> {{-- Container for image to control height --}}
                    @if ($food->food_image)
                        <img src="{{ $food->food_image }}" class="card-img-top img-fluid" alt="{{ $food->food_name }}" style="object-fit: cover; height: 100%;"> {{-- img-fluid and object-fit:cover --}}
                    @else
                        <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top img-fluid" alt="No Image" style="object-fit: cover; height: 100%;"> {{-- Placeholder img-fluid --}}
                    @endif
                </div>
                <div class="card-body d-flex flex-column"> {{-- d-flex flex-column for button to bottom --}}
                    <h5 class="card-title fw-bold">{{ $food->food_name }}</h5> {{-- fw-bold for title --}}
                    <p class="card-text flex-grow-1">{{ $food->food_description }}</p> {{-- flex-grow-1 to push text up --}}
                    <p class="card-text mb-0"><strong>Giá: <span class="text-primary">{{ number_format($food->food_price) }} VNĐ</span></strong></p> {{-- Highlighted price with text-primary --}}
                    <div class="d-grid mt-3"> {{-- d-grid for button to fill width --}}
                        <form action="{{ route('user.add', $food->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm" type="submit"> {{-- btn-sm for smaller button --}}
                                <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection