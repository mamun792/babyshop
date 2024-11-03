@extends('web.dashboard.app', ['page' => 'Comment'])

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    
                   Comment Table
                    <a href="{{ route('dashboard.comments.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add Comment
                    </a>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> <!-- This will automatically display the current index -->
                                    <td>{{ $comment->name }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $comment->status }}</span> 
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="editComment({{ $comment->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" onclick="toggleCommentStatus({{ $comment->id }}, '{{ $comment->status }}')">
                                            <i class="fa {{ $comment->status === 'active' ? 'fa-eye' : 'fa-check' }}"></i>
                                        </button>
            
                                        <button class="btn btn-danger btn-sm" onclick="deleteComment({{ $comment->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Pagination (optional) --}}
            <div class="mt-3">
                {{ $comments->links() }} <!-- Assuming you are using Laravel's pagination -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    function editComment(id) {
        window.location.href = `{{ url('dashboard/comments') }}/${id}/edit`;
    }



    function toggleCommentStatus(id, currentStatus) {
    const action = currentStatus === 'active' ? 'deactivate' : 'activate';
    const confirmationMessage = `Are you sure? You won't ${action} this!`;

    Swal.fire({
        title: confirmationMessage,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!',
          width: '800px',
    }).then((result) => {
        if (result.isConfirmed) {
            const url = `/dashboard/comments/${id}/toggle-status`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: action })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', `Comment ${action}d successfully.`, 'success');
                    location.reload();
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'There was an error processing your request.', 'error');
            });
        }
    });
}


function deleteComment(id) {
    // SweetAlert confirmation
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = `{{ url('dashboard/comments') }}/${id}/delete`; // Adjust URL to include the ID
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

            // Send DELETE request
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Deleted!',
                        'Your comment has been deleted.',
                        'success'
                    );
                    // Optionally, reload the page or update the UI
                    location.reload(); // Reloads the page to see the changes
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'There was an error processing your request.', 'error');
            });
        }
    });
}


</script>

