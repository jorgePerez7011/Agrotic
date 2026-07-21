@extends('layouts.app')

@section('title', 'Add loan')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, #D9F99D, #F0FDF4);
    }

    .card {
        border-radius: 1rem;
        box-shadow: 0 10px 20px rgba(0, 128, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(to right, #2E7D32, #4CAF50, #AEEA00);
        color: white !important;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #4CAF50;
        border-color: #2E7D32;
    }

    .btn-primary:hover {
        background-color: #388E3C;
    }

    .form-control,
    .select2-container--default .select2-selection--single {
        border: 1px solid #A5D6A7;
        background-color: #F1F8E9;
    }

    .form-control:focus,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }

    label.control-label {
        color: #2E7D32;
        font-weight: bold;
    }

    .table {
        background-color: #F5FFF8;
    }

    .table th {
        background-color: #A5D6A7;
        color: #1B5E20;
    }

    #stock-warning {
        color: #F57F17;
    }

    .btn-danger {
        background-color: #F9A825;
        border-color: #F57F17;
    }

    .btn-danger:hover {
        background-color: #F57F17;
    }
</style>

<div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="background-color: #f5fff8; border: 1px solid #cce3d2;">
                        <div class="card-header">
                            <h3 class="card-title">@yield('title')</h3>
                        </div>
                        <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body" id="form-fields">
                                <div class="form-group">
                                    <label for="client" class="control-label">User <strong style="color:red;">(*)</strong></label>
                                    <select id="client" class="form-control select2" name="client" value="{{ old('client') }}">
                                        <option value="-1">Select a User</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->document }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <input type="hidden" class="form-control" name="status" value="1">
                                <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">

                                <div class="row mt-4">
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <label for="product" class="form-label">Product</label>
                                        <select id="product" class="form-control select2">
                                            <option value="-">Select a product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" 
                                                    data-price="{{ $product->price }}" 
                                                    data-name="{{ $product->name }}"
                                                    data-stock="{{ $product->quantity }}">
                                                    {{ $product->name }} (Stock: {{ $product->quantity }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-3 mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" id="quantity" class="form-control" name="quantity" min="1">
                                        <small class="text-danger" id="stock-warning" style="display: none;">Insufficient stock</small>
                                    </div>
                                    <div class="col-lg-2 col-md-3 mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" id="price" class="form-control" name="price" readonly>
                                    </div>
                                    <div class="col-lg-2 col-md-3 mb-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" id="subtotal" class="form-control" name="subtotal" readonly>
                                    </div>
                                    <div class="col-lg-2 col-md-3 d-flex align-items-end">
                                        <button class="btn btn-primary w-100" id="add-btn">Add</button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list-products">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 text-center mb-3">
                                        <h4>Total: $<span id="total-text">0</span></h4>
                                        <input name="total" type="hidden">
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <button type="submit" class="btn btn-primary w-100">Register</button>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <a href="{{ route('clients.index') }}" class="btn btn-danger w-100">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .select2-container .select2-selection--single {
        height: calc(1.5em + .75rem + 2px);
    }
</style>

@endsection

@push('scripts')
<script>
    class Order {
        constructor(id, name, quantity, price, stock) {
            this.id = id;
            this.name = name;
            this.price = price;
            this.quantity = quantity;
            this.stock = stock;
        }

        get subtotal() {
            return this.price * this.quantity;
        }

        generateHTML() {
            return `
            <tr>
                <td>${this.name}</td>
                <td>${this.quantity}</td>
                <td>$${this.price.toFixed(2)}</td>
                <td>$${this.subtotal.toFixed(2)}</td>
                <input type="hidden" name="product_id[]" value="${this.id}">
                <input type="hidden" name="quantity[]" value="${this.quantity}">
            </tr>
            `;
        }
    }

    // Nodes (DOM).
    const nodeInputPrice = document.querySelector('[name="price"]');
    const nodeInputQuantity = document.querySelector('[name="quantity"]');
    const nodeInputSubtotal = document.querySelector('[name="subtotal"]');
    const nodeInputTotal = document.querySelector('[name="total"]');
    const nodeListProducts = document.querySelector('#list-products');

    function clearInputFields() {
        nodeInputPrice.value = '';
        nodeInputQuantity.value = '';
        nodeInputSubtotal.value = '';
    }

    const orders = [];

    function pushOrder(order) {
        orders.push(Object.assign(Object.create(Object.getPrototypeOf(order)), order));

        let total = orders.reduce((sum, order) => sum + order.subtotal, 0);

        document.querySelector('#total-text').innerText = total.toFixed(2);
        nodeInputTotal.value = total;

        nodeListProducts.innerHTML += order.generateHTML();
    }

    let currentOrder = new Order("", "", 0, 0);

    function updateCurrentOrder() {
        // Don't allow quantity to exceed stock
        if (currentOrder.quantity > currentOrder.stock) {
            currentOrder.quantity = currentOrder.stock;
            nodeInputQuantity.value = currentOrder.stock;
            document.getElementById('stock-warning').style.display = 'block';
        } else {
            document.getElementById('stock-warning').style.display = 'none';
        }

        nodeInputPrice.value = currentOrder.price.toFixed(2);
        nodeInputQuantity.value = currentOrder.quantity;
        nodeInputSubtotal.value = currentOrder.subtotal.toFixed(2);
    }

    $(document).ready(function() {
        $('.select2').select2();

        let productSelect = $('#product');
        productSelect.select2();

        $('#add-btn').on("click", (e) => {
            e.preventDefault();

            if (!currentOrder.id || !currentOrder.quantity) {
                alert('Please select a product and enter a quantity.');
                return;
            }

            if (currentOrder.quantity > currentOrder.stock) {
                alert('Cannot order more than available stock.');
                return;
            }

            // Check if we already have this product in the order
            const existingOrder = orders.find(order => order.id === currentOrder.id);
            if (existingOrder) {
                const totalQuantity = existingOrder.quantity + currentOrder.quantity;
                if (totalQuantity > currentOrder.stock) {
                    alert('Cannot order more than available stock.');
                    return;
                }
            }

            pushOrder(currentOrder);
            clearInputFields();
            productSelect.val('-').trigger('change');
        });

        productSelect.on('select2:select', function(e) {
            const selected = productSelect.find(':selected');
            currentOrder.id = parseInt(selected.val());
            currentOrder.name = selected.data('name');
            currentOrder.price = parseFloat(selected.data('price'));
            currentOrder.stock = parseInt(selected.data('stock'));
            currentOrder.quantity = 0;

            // Set max quantity to available stock
            nodeInputQuantity.max = currentOrder.stock;

            updateCurrentOrder();
        });
    });

    nodeInputQuantity.addEventListener('input', () => {
        currentOrder.quantity = parseInt(nodeInputQuantity.value) || 0;
        updateCurrentOrder();
    });
</script>
@endpush
