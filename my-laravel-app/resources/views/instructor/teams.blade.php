@extends('layouts.app')

@section('title', 'Manage Teams')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Manage Teams</h2>

    <div class="card p-4 mb-4">
        <h4>Add New Team</h4>
        <form id="add-team-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Team Name</label>
                <input type="text" name="name" id="team-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="leader_id" class="form-label">Leader ID</label>
                <input type="text" name="leader_id" id="team-leader-id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Team</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Existing Teams</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Leader ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="teams-list">
                @foreach($teams as $team)
                <tr id="team-{{ $team->id }}">
                    <td><input type="text" class="form-control" value="{{ $team->name }}" id="name-{{ $team->id }}"></td>
                    <td><input type="text" class="form-control" value="{{ $team->leader_id }}" id="leader-{{ $team->id }}"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="updateTeam({{ $team->id }})">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTeam({{ $team->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-team-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('{{ route("teams.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        }).then(response => response.json()).then(() => { alert('Team added successfully!'); location.reload(); });
    });

    function updateTeam(id) {
        let name = document.getElementById('name-' + id).value;
        let leader_id = document.getElementById('leader-' + id).value;

        fetch(`/teams/update/${id}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, leader_id })
        }).then(response => response.json()).then(() => alert('Team updated successfully!'));
    }

    function deleteTeam(id) {
        if (!confirm('Are you sure?')) return;

        fetch(`/teams/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => { document.getElementById('team-' + id).remove(); alert('Team deleted successfully!'); });
    }
</script>

@endsection
