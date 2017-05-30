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
<!-- це залишаємо -->
<!-- <div class="col-xs-9 fbcontent">
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
</div> -->

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-7"><div><hr class="line"></div>
            </div>
            <div class="col-md-5">
                <span><img src="img/testimonial32.png"></span>
                <span class="userName">John</span>
                <span class="date">24 травня 2017</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="col-md-11">
                <span><img src="img/cite.png" class="blockquote_opened">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<img src="img/cite.png" class="blockquote_closed"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="col-md-4 col-md-offset-1">
                <div class="pfblock-line"></div>
            </div>
        </div>
    </div>
    
    <!-- second tamplate -->
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-7"><div><hr class="line"></div>
            </div>
            <div class="col-md-5">
                <span><img src="img/testimonial32.png"></span>
                <span class="userName">Костянтин</span>
                <span class="date">24 травня 2017</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="col-md-11">
                <span><img src="img/cite.png" class="blockquote_opened">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<img src="img/cite.png" class="blockquote_closed"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="col-md-4 col-md-offset-1">
                <div class="pfblock-line"></div>
            </div>
        </div>
    </div>
     <!-- second tamplate -->
</div>

