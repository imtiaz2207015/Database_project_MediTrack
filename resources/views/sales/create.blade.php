@extends('layouts.app')
@section('title', 'New Sale')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-cash-register mr-2"></i>New Sale</h3>
    </div>
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer (optional)</label>
                        <select name="customer_id" class="form-control">
                            <option value="">Walk-in Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} — {{ $customer->phone }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Payment Method *</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="mobile_banking">Mobile Banking</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Discount (৳)</label>
                        <input type="number" name="discount" class="form-control"
                               value="0" min="0" step="0.01" id="discount">
                    </div>
                </div>
            </div>

            <hr>
            <h5>Add Medicines</h5>

            <div id="medicine-rows">
                <div class="medicine-row row mb-2">
                    <div class="col-md-5">
                        <select name="medicines[0][id]" class="form-control medicine-select" required>
                            <option value="">-- Select Medicine --</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}" data-price="{{ $med->price }}">
                                    {{ $med->name }} ({{ $med->strength }}) — Stock: {{ $med->stock_quantity }} — ৳{{ $med->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="medicines[0][qty]" class="form-control qty-input"
                               placeholder="Qty" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control subtotal-display" placeholder="Subtotal" readonly>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-block remove-row">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm mt-2" id="add-row">
                <i class="fas fa-plus"></i> Add Another Medicine
            </button>

            <hr>
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <table class="table table-sm">
                        <tr><td>Subtotal:</td><td><strong id="display-subtotal">৳ 0.00</strong></td></tr>
                        <tr><td>Discount:</td><td><strong id="display-discount">৳ 0.00</strong></td></tr>
                        <tr class="table-success">
                            <td><strong>Total:</strong></td>
                            <td><strong id="display-total">৳ 0.00</strong></td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label>Paid Amount (৳) *</label>
                        <input type="number" name="paid_amount" id="paid_amount"
                               class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Complete Sale
            </button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let rowIndex = 1;

function calculateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.medicine-row').forEach(row => {
        const select = row.querySelector('.medicine-select');
        const qty    = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price  = parseFloat(select.options[select.selectedIndex]?.dataset.price) || 0;
        const sub    = price * qty;
        row.querySelector('.subtotal-display').value = '৳ ' + sub.toFixed(2);
        subtotal += sub;
    });
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const total    = subtotal - discount;
    document.getElementById('display-subtotal').textContent = '৳ ' + subtotal.toFixed(2);
    document.getElementById('display-discount').textContent = '৳ ' + discount.toFixed(2);
    document.getElementById('display-total').textContent    = '৳ ' + total.toFixed(2);
    document.getElementById('paid_amount').value            = total.toFixed(2);
}

document.getElementById('add-row').addEventListener('click', function () {
    const template = document.querySelector('.medicine-row').cloneNode(true);
    template.querySelectorAll('select, input').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, '[' + rowIndex + ']');
        if (el.type !== 'button') el.value = el.type === 'number' ? 1 : '';
    });
    document.getElementById('medicine-rows').appendChild(template);
    rowIndex++;
    bindEvents(template);
});

function bindEvents(row) {
    row.querySelector('.medicine-select').addEventListener('change', calculateTotals);
    row.querySelector('.qty-input').addEventListener('input', calculateTotals);
    row.querySelector('.remove-row').addEventListener('click', function () {
        if (document.querySelectorAll('.medicine-row').length > 1) {
            row.remove();
            calculateTotals();
        }
    });
}

document.querySelectorAll('.medicine-row').forEach(bindEvents);
document.getElementById('discount').addEventListener('input', calculateTotals);
</script>
@endpush