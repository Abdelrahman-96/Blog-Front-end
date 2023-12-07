<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" required id="name" name="name" value="{{$name ?? null}}">
</div>
<div class="form-group">
    <label for="name">Mail</label>
    <input type="email" class="form-control" required id="mail" name="mail" value="{{$mail?? null}}">
</div>
<div class="form-group">
    <label for="name">URL</label>
    <input type="text" class="form-control" required id="url" name="url" value="{{$url?? null}}">
</div>
<div class="form-group">
    <label for="name">Description</label>
    <input type="text" class="form-control" required id="description" name="description" value="{{$description?? null}}">
</div>
<input type="hidden" name="blog_id" value="{{$blog_id}}">
