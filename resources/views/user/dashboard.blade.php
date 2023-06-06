<x-app-layout>
    <div class="pagetitle">
        <h1>Available Products</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p>{{$product->description}}</p>

                            <!-- Slides with fade transition -->
                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <img src="{{asset('images')}}/{{$product->image}}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span style="float: left;">
                                ${{$product->price}}
                            </span>
                            <button type="button" class="btn btn-secondary m-1" style="float: right;" data-bs-toggle="modal" data-bs-target="#bidModal{{$product->id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="bidModal{{$product->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="POST" action="{{route('user-add-bid')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">{{$product->name}} Bidding</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ol class="list-group mb-3">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach (\App\Models\Bid::orderBy('amount', 'desc')->get() as $bid)
                                        @php
                                            $count++;
                                        @endphp
                                        @if ($count == 1)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$count}}) - {{\App\Models\User::find($bid->user_id)->name}}
                                                <span class="badge bg-primary rounded-pill">${{$bid->amount}} <i class="bi bi-award"></i></span>
                                            </li>
                                        @else
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$count}}) -{{\App\Models\User::find($bid->user_id)->name}}
                                                <span class="badge bg-primary rounded-pill">${{$bid->amount}}</span>
                                            </li>
                                        @endif

                                    @endforeach
                                </ol>
                                <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control" required>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="amount" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Place bid</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
