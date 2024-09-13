@extends('_layouts.master')

@section('page-title', 'Daftar User')

@section('style')
<style>

/* Hide the table initially */
#search-table {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

/* Ensure the table is visible after initialization */
#search-table.visible {
    opacity: 1;
}

    /* Style the container that holds the search field and the create button */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .create-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
    }

    .create-btn:hover {
        background-color: #45a049;
    }
</style>

@endsection

@section('body')
@section('side-right')
<a href="{{ route('users.add') }}">
<x-green-button class="mr-6 mt-4">
    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
    &nbsp; {{ __('Buat Akun') }}
</x-green-button>
</a>
@endsection
<div class="bg-white inline-block min-w-full shadow rounded-lg overflow-hidden p-4 mt-4">
    <table id="search-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Nama
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Email
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Role
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Aktivitas Terakhir
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Aksi
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role_nama }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('user.update', $user->id) }}" class="w-10 h-10 bg-cyan-800 hover:bg-blue-700 flex items-center justify-center rounded-lg">
                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                        </a>
                        <!-- Form for Delete -->

                        @if($user->role_id === 1 && (Auth::user()->created_at > $user->created_at) || $user->id === 1)
                            {{-- Don't display the delete button for older admins --}}
                        @else
                        <button data-user-id="{{ $user->id }}" data-modal-target="popup-modal-{{ $user->id }}" data-modal-toggle="popup-modal-{{ $user->id }}" class="w-10 h-10 flex justify-center block text-white bg-rose-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm items-center" type="button">
                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                            </svg>
                        </button>

                        <x-modal-delete
                            id="popup-modal-{{ $user->id }}"
                            message="Apakah anda yakin menghapus file?"
                            action="{{ route('user.destroy', $user->id) }}" />
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tableElement = document.querySelector("#search-table");
        
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: true,
            columns: [
            { select: [0, 1, 2, 3], sortable: true, searchable: true },
            { select: 4, sortable: false, searchable: false } // Disable search and sort on the action column
        ]
        });

        dataTable.on('datatable.sort', function() {
            // Rebind your buttons or actions to the correct data here
            document.querySelectorAll('.delete-button').forEach(button => {
                button.removeEventListener('click'); // Unbind previous events
                button.addEventListener('click', function(event) {
                    const userId = event.currentTarget.getAttribute('data-user-id');
                    const modal = document.querySelector(`#popup-modal-${userId}`);
                    // Trigger the modal or delete action here using the correct file ID
                });
            });
        });

        // document.querySelector("#search-table").classList.add("visible");
        tableElement.classList.add("visible");

        setTimeout(function() {
        tableElement.style.opacity = 1;
        }, 100);
    });
</script>
@endsection