<div class="card m-auto" style="width: 95%" id="comment">
    @include('include.alert')
    <div class="card-header">
        <h5>گفتوگوی های پیرامون این وظیفه</h5>
    </div>
    <x-comment-form :id="$id"/>
    @if($comments)
        @foreach($comments as $comment)
            <div class="card-body">
                <div class="text-black-50" style="
        border: 1px solid rgba(0,0,0,.1);padding: 15px;border-radius: 4px;text-align: justify">
                    <small class="badge badge-info writer_comment">نویسنده:
                        <span>{{\App\Models\User::findOrFail($comment->user_id)->name}}</span>
                    </small>
                    @can('isAdmin',auth()->user())
                        <livewire:DeleteComment :commentId="$comment->id" :todoID="$id"/>
                    @endcan
                    <p class="mt-3">{{$comment->content}}</p>
                    <p class="pb-1">
                        <small style="float: left">
                            نوشته شده در:
                            {{\App\helper\Jalali::convert($comment->created_at)}}
                        </small>
                    </p>
                </div>
            </div>
        @endforeach
        <div class="m-auto">
            {{$comments->links()}}
        </div>
    @endif
</div>
