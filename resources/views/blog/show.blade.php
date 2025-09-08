<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title ?? 'Blog Post' }} - NGO Development</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">{{ $blog->title ?? 'Sample Blog Title' }}</h1>
                        <p class="text-muted">Published on {{ $blog->created_at ? $blog->created_at->format('F j, Y') : 'Today' }}</p>
                        <hr>
                        <div class="content">
                            {!! nl2br(e($blog->content ?? 'Sample blog content goes here...')) !!}
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blog.index') }}" class="btn btn-secondary">Back to Blog</a>
                            <div>
                                <a href="{{ route('blog.edit', $blog->id ?? 1) }}" class="btn btn-warning">Edit</a>
                                <form method="POST" action="{{ route('blog.destroy', $blog->id ?? 1) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
