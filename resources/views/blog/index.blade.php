<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - NGO Development</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog.index') }}">NGO Development</a>
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link" href="{{ route('blog.create') }}">Create Post</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link border-0">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Blog Posts</h2>
            <a href="{{ route('blog.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
        
        <div class="row">
            @forelse($blogs ?? [] as $blog)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title ?? 'Sample Blog Title' }}</h5>
                            <p class="card-text">{{ Str::limit($blog->content ?? 'Sample blog content...', 150) }}</p>
                            <p class="text-muted small">By {{ $blog->user->name ?? 'Author' }} - {{ $blog->created_at ? $blog->created_at->format('M j, Y') : 'Today' }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('blog.show', $blog->id ?? 1) }}" class="btn btn-outline-primary">Read More</a>
                                <div>
                                    <a href="{{ route('blog.edit', $blog->id ?? 1) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form method="POST" action="{{ route('blog.destroy', $blog->id ?? 1) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <h4>No blog posts found</h4>
                        <p>Start by creating your first blog post!</p>
                        <a href="{{ route('blog.create') }}" class="btn btn-primary">Create First Post</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
