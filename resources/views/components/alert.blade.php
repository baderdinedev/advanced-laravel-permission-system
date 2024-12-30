@props(['type' => 'success', 'message' => ''])

@if ($type === 'success')
    <div class="alert alert-success flex items-center bg-green-500 text-white p-4 rounded-lg">
        <span class="material-icons mr-2">check_circle</span>
        <span>{{ $message }}</span>
        <span class="ml-auto bg-green-700 text-xs rounded-full px-2 py-1">{{ ucfirst($type) }}</span>
    </div>
@elseif ($type === 'error')
    <div class="alert alert-error flex items-center bg-red-500 text-white p-4 rounded-lg">
        <span class="material-icons mr-2">error</span>
        <span>{{ $message }}</span>
        <span class="ml-auto bg-red-700 text-xs rounded-full px-2 py-1">{{ ucfirst($type) }}</span>
    </div>
@endif
