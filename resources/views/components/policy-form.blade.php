

<div class="container my-5 form-container">
   
    <form action="{{ $route }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        <div class="mb-3">
            <label for="summernoteMetaDescription" class="form-label">Meta Description</label>
            <textarea id="summernoteMetaDescription" class="form-control" name="meta_description">
                @foreach($policies as $policy)
                    {!! $policy->content !!}
                @endforeach
            </textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>