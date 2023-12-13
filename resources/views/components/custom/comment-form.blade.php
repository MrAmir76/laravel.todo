<form class="px-2" method="post" action="{{route('saveComment',['id'=>$id])}}">@csrf
    <div class="form-group row">
        <label for="input6" class="col-sm-2 col-form-label text-black-50 mr-2"> نظر جدید:</label>
        <div class="col-sm-11 m-auto">
            <textarea class="form-control" id="input6" name="contentComment" required></textarea>
            @error('contentComment')
            <x-error-form :message="$message"/>
            @enderror
        </div>
    </div>
    <input type="submit" value="ارسال" class="btn btn-info ml-2" style="float: left">
</form>
