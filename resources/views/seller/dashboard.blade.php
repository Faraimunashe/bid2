<x-app-layout>
    <div class="pagetitle">
        <h1>My Products</h1>
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
            <div class="col-12">
                <button class="btn btn-primary" type="button" style="float: right;" data-bs-toggle="modal" data-bs-target="#basicModal">Add Product</button>
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
                            <button type="button" class="btn btn-danger m-1" style="float: right;" data-bs-toggle="modal" data-bs-target="#deleteModal{{$product->id}}">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button type="button" class="btn btn-secondary m-1" style="float: right;" data-bs-toggle="modal" data-bs-target="#updateModal{{$product->id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="{{route('seller-bid', $product->id)}}" class="btn btn-dark m-1" style="float: right;" >
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="updateModal{{$product->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="POST" action="{{route('seller-update-product')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Update {{$product->name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control" required>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{$product->name}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="description" value="{{$product->description}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" value="{{$product->price}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Ending</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="bid_end" value="{{$product->bid_end}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="POST" action="{{route('seller-delete-product')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Delete {{$product->name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control" required>
                                Are you sure you want to delete {{$product->name}} from products.?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Yes delete</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{route('seller-add-product')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Ending</label>
                        <div class="col-sm-10">
                            <input type="date" name="bid_end" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</x-app-layout>
