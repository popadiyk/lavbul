<style>

</style>

<div class="col-xs-3 ls">
    @if (Auth::check())
        <label style="margin: 15px;" for="usr">Ваш відгук:</label>
        <textarea class="form-control" rows="6" id="comment" style="margin: 15px;"></textarea>
        <button type="button" class="btn btn-info" style="margin: 15px;">Залишити відгук</button>
    @else
        <div class="panel panel-danger">
            <div class="panel-heading">
                Зверніть увагу!
            </div>
            <div class="panel-body">
                <p>
                    Для того, щоб залишити відгук, потрібно
                    <a href="{{ url('/login') }}">залогінитись</a>
                    або
                    <a href="{{ url('/register') }}">зареєструватись</a>
                </p>

            </div>
        </div>
    @endif
</div>