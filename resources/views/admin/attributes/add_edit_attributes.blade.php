@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">Attributes</h4> 
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Attributes</h4>
                            {{-- Error and Success Messages --}}
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Form to Add Attributes --}}
                            <form class="forms-sample" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    &nbsp; {{ $product['product_name'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code:</label>
                                    &nbsp; {{ $product['product_code'] }}
                                </div>
                                
                                <div class="form-group">
                                    <label for="product_price">Product Price:</label>
                                    &nbsp; {{ $product['product_price'] }}
                                </div>
                                <div class="form-group">
                                    {{-- Product Image --}}
                                    @if (!empty($product['product_image']))
                                        <img style="width: 120px" src="{{ url('front/images/product_images/small/' . $product['product_image']) }}">
                                    @else
                                        <img style="width: 120px" src="{{ url('front/images/product_images/small/no-image.png') }}">
                                    @endif
                                </div>

                                {{-- Add Attribute Fields --}}
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div>
                                            <select name="size[]" style="width:175px"  required>
                                                <option value="" disabled selected >Select Chicken Type</option> <!-- Placeholder option -->
                                                <option value="Hen">Hen</option>
                                                <option value="Rooster">Rooster</option>
                                            </select>
                                            <input type="number" name="price[]" placeholder="Price" style="width:100px" required min="{{ $product['product_price'] }}">
                                            <input type="number" name="stock[]" placeholder="Stock (Quantity)" style="width:150px" required
                                                @if (empty($product['rsbsaNumber'])) max="10" @endif>
                                            @if (empty($product['rsbsaNumber']))
                                                <small class="text-muted">* Maximum of 10 Stocks only for Non-Member.</small>
                                            @endif
                                            <!-- <a href="javascript:void(0);" class="add_button" title="Add Attributes">Add</a> -->
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            </form>

                            <br><br>

                            {{-- Existing Product Attributes --}}
                            <h4 class="card-title">Product Attributes</h4>

                            <form method="post" action="{{ url('admin/edit-attributes/' . $product['id']) }}">
                                @csrf

                                <table id="products" class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Chicken Type</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product['attributes'] as $attribute)
                                            <input style="display: none" type="text" name="attributeId[]" value="{{ $attribute['id'] }}">
                                            <tr>
                                                <td>{{ $attribute['id'] }}</td>
                                                <td>{{ $attribute['size'] }}</td>
                                                <td>
                                                    <input type="number" name="price[]" value="{{ $attribute['price'] }}" required style="width: 60px">
                                                </td>
                                                <td>
                                                    <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required style="width: 60px"
                                                        @if (empty($product['rsbsaNumber'])) max="10" @endif>
                                                </td>
                                                <td>
                                                    @if ($attribute['status'] == 1)
                                                        <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                        </a>
                                                    @else
                                                        <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Update Attributes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
@endsection
