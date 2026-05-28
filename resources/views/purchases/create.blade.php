@extends('layouts.app')
@section('title', 'New Purchase')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>New Purchase</h3>
    </div>
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Supplier *</label>
                        <select name="supplier_id" class="form-control" required>
                            <option value="">-- Select Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Purchase Date *</label>
                        <input type="date" name="purchase_date" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="received">Received</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <h5>Add Medicines</h5>

            <div id="purchase-rows">
                <div class="purchase-row row mb-2">
                    <div class="col-md-4">
                        <select name="medicines[0][id]" class="form-control" required>
                            <option value="">-- Select Medicine --</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}">{{ $med->name }} ({{ $med->strength }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="medicines[0][qty]" class="form-control qty-input"
                               placeholder="Qty" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="medicines[0][price]" class="form-control price-input"
                               placeholder="Unit Price (৳)" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-block remove-row">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm mt-2" id="add-row">
                <i class="fas fa-plus"></i> Add Medicine
            </button>

            <hr>
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <h5>Grand Total: <strong id="grand-total">৳ 0.00</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Save Purchase
            </button>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let rowIndex = 1;

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.purchase-row').forEach(row => {
        const qty   = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const sub   = qty * price;
        row.querySelector('.subtotal-display').value = '৳ ' + sub.toFixed(2);
        total += sub;
    });
    document.getElementById('grand-total').textContent = '৳ ' + total.toFixed(2);
}

document.getElementById('add-row').addEventListener('click', function () {
    const template = document.querySelector('.purchase-row').cloneNode(true);
    template.querySelectorAll('select, input').forEach(el => {
        el.name = el.name ? el.name.replace(/\[\d+\]/, '[' + rowIndex + ']') : el.name;
        if (el.classList.contains('subtotal-display')) el.value = '';
        else if (el.type === 'number') el.value = el.classList.contains('qty-input') ? 1 : '';
        else if (el.tagName === 'SELECT') el.selectedIndex = 0;
    });
    document.getElementById('purchase-rows').appendChild(template);
    rowIndex++;
    bindEvents(template);
});

function bindEvents(row) {
    row.querySelector('.qty-input').addEventListener('input', calculateTotal);
    row.querySelector('.price-input').addEventListener('input', calculateTotal);
    row.querySelector('.remove-row').addEventListener('click', function () {
        if (document.querySelectorAll('.purchase-row').length > 1) {
            row.remove();
            calculateTotal();
        }
    });
}

document.querySelectorAll('.purchase-row').forEach(bindEvents);
</script>
@endpush