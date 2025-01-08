<div class="mb-2">
    <form action="{{route('query_builders.users.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>