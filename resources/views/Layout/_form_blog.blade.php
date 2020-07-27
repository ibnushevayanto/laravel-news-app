{{-- ? How To Show An Error  --}}

@if ($errors->any())
@foreach ($errors->all() as $error)

<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>

@endforeach
@endif

{{-- ! End --}}

<div class="form-group">
    <label for="titleInput">Title</label>
    <input type="text" class="form-control" id="titleInput" name="title" placeholder="Title"
        value="{{ old('title', $blogpost->title ?? NULL) }}">
</div>
<div class="form-group">
    <label for="contentInput">Content</label>
    <textarea class="form-control" id="contentInput" rows="5" name="content"
        placeholder="Content">{{ old('content', $blogpost->content ?? NULL) }}</textarea>
</div>
<div class="form-group">
    <label for="coverInput">Cover</label>
    <input type="file" class="form-control-file" name="cover" id="coverInput">
</div>
<div class="text-right">
    <button class="btn btn-primary btn-block" type="submit">Simpan</button>
</div>