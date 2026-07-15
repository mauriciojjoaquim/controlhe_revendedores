<div class="card bg-light p-4 m-2">
    <h5 class="text-secondary">{{ $itemTitle }}</h5>
    <div
        class="table-responsive"
    >
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <tbody class="table-group-divider">
                @foreach ($collections as $collection)
                <tr class="table-primary">
                    <td scope="row">{{ $collection['department'] }}</td>
                    <td class="text-end">{{ $collection['total'] }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>
