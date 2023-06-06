<x-app-layout>
    <div class="pagetitle">
        <h1>{{$product->name}}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">{{$product->name}}</li>
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
                          <h5 class="card-title">Bidding List</h5>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Winner</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                    $winner = false;
                                @endphp
                                @foreach ($bids as $bid)
                                    <tr>
                                        <th scope="row">
                                            @php
                                                $count++;
                                                if($bid->winner == true)
                                                {
                                                    $winner = true;
                                                }
                                                echo $count;
                                            @endphp
                                        </th>
                                        <td>{{\App\Models\User::find($bid->user_id)->name}}</td>
                                        <td>${{$bid->amount}}</td>
                                        <td>
                                            @if ($product->winner)
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-award-fill"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$winner)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptModal{{$bid->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="acceptModal{{$bid->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <form method="POST" action="{{route('seller-accept-bid')}}" enctype="multipart/form-data">
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
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</x-app-layout>
