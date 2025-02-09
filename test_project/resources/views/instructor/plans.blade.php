@extends('layouts.app')

@section('title', 'Manage Plans')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Plans</h2>

    <div class="card p-4 mb-4">
        <h4>Add New Plan</h4>
        <form id="add-plan-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Plan Name</label>
                <input type="text" name="name" id="plan-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="plan-price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Plan</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Plans</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Plan Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="plans-list">
                @foreach($plans as $plan)
                <tr id="plan-{{ $plan->id }}">
                    <td><input type="text" class="form-control" value="{{ $plan->name }}" id="name-{{ $plan->id }}"></td>
                    <td><input type="number" class="form-control" value="{{ $plan->price }}" id="price-{{ $plan->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updatePlan({{ $plan->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deletePlan({{ $plan->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-plan-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("plans.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Plan added successfully!'); location.reload(); });
    });

    function updatePlan(id) {
        let name = document.getElementById('name-' + id).value;
        let price = document.getElementById('price-' + id).value;

        fetch(`/plans/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, price })
        }).then(response => response.json()).then(() => alert('Plan updated successfully!'));
    }

    function deletePlan(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/plans/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('plan-' + id).remove(); alert('Plan deleted successfully!'); });
    }
</script>

@endsection
