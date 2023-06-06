<x-app-layout>
    <div class="pagetitle">
        <h1>My Bids</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Bids</li>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Products Won</h5>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Original Amount</th>
                            <th scope="col">My Bid</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($bids as $bid)
                                <tr>
                                    <th scope="row">
                                        @php
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </th>
                                    <td>{{\App\Models\Product::find($bid->product_id)->name}}</td>
                                    <td>${{\App\Models\Product::find($bid->product_id)->price}}</td>
                                    <td>${{$bid->amount}}</td>
                                    <td>
                                        @if($bid->winner)
                                            <span class="badge bg-success">won</span>
                                        @else
                                            <span class="badge bg-secondary">pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$bid->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal{{$bid->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('user-delete-bid')}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Bid</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="bid_id" value="{{$bid->id}}" required>
                                                    <p style="color: red">Are you sure you want to delete this bid from your bidded products?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
