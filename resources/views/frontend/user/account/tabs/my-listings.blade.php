    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th style="width: 200px;">Category</th>
                            <th style="width: 200px;">Make</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mylisting as $list)
                        <tr>
                            <td>{{ $list->title }}</td>
                            <td>{{ $list->category->name }}</td>
                            <td>{{ $list->make->name }}</td>
                            <td>Action</td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><!--col-->
    </div><!--row-->

   