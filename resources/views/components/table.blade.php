@props(['headers', 'rows'])

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>