<style>
    .fbcontent{
        background: snow;
        background: snow;
    }
    .panel {
        margin: 15px 25px;
    }
    .panel-footer p {
        color: orange;
    }
</style>
<div class="col-xs-9 fbcontent">
    @forelse($feedbacks as $feedback)
        <div class="panel panel-primary">
            <div class="panel-heading">
                {{$feedback->user_id}}
            </div>
            <div class="panel-body">
                {{$feedback->feedback}}
            </div>
            <div class="panel-footer">
                <p>Ответ администратора:</p>
                {{$feedback->adminAnswer}}
            </div>
        </div>
    @empty
        <p> Нажаль відгуків поки, що немає! </p>
    @endforelse
</div>