@extends('layouts.master')

@section('title', 'Hello World!')

@section('content')




        <div>
                <br>
                <h2>< Hello World ! ></h2>
                <br>  
                <p>
                At 28 years old, <a href="/posts/how-i-became-millionaire">I became a millionaire</a>, <br>
                not as a drug dealer, but as an entrepreneur. <br>
                And believe me, cocaïne is nothing compared to a web startup.
                </p>
                <p>
                Hopefully, I've always been more attracted by freedom than money.<br>
                So <s>I quit</s> <a href="/posts/how-i-was-fired">my shareholders fired me from my own startup</a>.<br>
                And instead of a Porsche to drive, <a href="/posts/i-purchased-a-van-to-live">I purchased a van to live</a>.<br>
                </p>
                <p>
                Since {{ $onk_quit_date }} days, I ride all over Europe and work remotely.<br>
                My new office got 4 wheels, a solar power plant on the roof,<br>
                and a computer connected to the world.<br>
                </p>
                <p>
                I still can't tell you exactly what I am working on.<br>
                But it's gonna be big.<br>
                A real bomb.
                </p>
                <p class="text-right" style="margin-right: 120px;">
                    Alexandre Chartier
                </p>
                <br>
        </div>


<hr>

    <h3>
        <i class="fa fa-graduation-cap"></i> Meet my Curriculum Vitae</a>.
    </h3>
    <br>

    <div class="row" style="font-size:15px;">
        <div class="col-sm-4">
           <h4> Entrepreneurship</h4>
            3 companies founded <br>
            Front page of The NY Times<br>
            15 awards<br>
            <a href="https://www.youtube.com/watch?v=LA7GZVUiOdk" target="_blank">1 Ted talk</a><br>
        </div>
        <div class="col-sm-4">
            <h4> World discovery</h4>
            32 countries visited<br>
            15 months backpacking<br>
            <a href="https://vimeo.com/41796222" target="_blank">Hitchhike Paris->Istanbul</a><br>
            Self sufficient hike in Iceland<br>
        </div>
        <div class="col-sm-4">
            <h4> Current hobbies</h4>
            Kitesurf intensive practice<br>
            Preparing a plane license<br>
            Playing Harmonica<br>
            Learning portuguese<br>
        </div>
    </div>

    <br>


<br><br>
{{--
<hr>

    <h3>
        <i class="fa fa-shopping-basket"></i> Order some good stuff.
    </h3>
    <br>

        <p class="">
            Started in 2008, Monsieur Chat L'Heureux is what I like to call a "recreative side-project".<br>
            It means that all profits are reinvested in leisure activities and travels.<br>
            Cherry on the cake, all products are made with organic and fairtrade cotton.
        </p>
        <br>

            <div class="row">
                @foreach ($groups as $group)
                    <div class="col-xs-12 col-sm-6 col-md-4">

                            <form method="POST" action="{{url('/mclh/cart')}}">
                                
                                <a href="#">
                                    <img class="product-img img-rounded img-responsive" alt="{{ $group->name }}" src="img/mclh/shop/{{ $group->prefix }}-300-boite.png" style="margin:auto">
                                </a>

                                    <div class="row">
                                        <div class="col-xs-10 col-xs-offset-1 text-left">
                                            <p class="lead">{{ $group->name }}</p>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-5 col-xs-offset-1 text-left">
                                            <div class="form-group">
                                                <select name="product_id" class="selectpicker form-control" data-width="auto">
                                                   @foreach ($products as $product)
                                                        @if ( $product->group_id === $group->id &&  $product->stock > 0)
                                                            <option value="{{ $product->id }}">Size {{ $product->size }}</option>
                                                        @endif
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-5 text-right">
                                            <p class="lead">{{ $group->price }} €</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-10 col-xs-offset-1">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-block btn-info add-to-cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                        </div>
                                    </div>
                            </form>

                    </div>
                @endforeach
            </div>

            <a href="{{url('/mclh')}}" class="pull-right">See all products ></a>
            <br>

--}}


<hr>


    <h3>
        <i class="fa fa-instagram"></i> Follow me on <a href="https://www.instagram.com/chartalex/">instagram</a>.
    </h3>
    <br>


    <div class="row">

        @foreach ($instas as $insta)
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <a href="https://www.instagram.com/chartalex" target="_blank"><img class="img-circle" src="img/insta/instagram_profile_pic.jpg" style="height: 36px; width: 36px; margin-right: 4px;"/></a>
                        </div>
                        <div class="pull-left">
                            <a href="https://www.instagram.com/chartalex" target="_blank" style="text-decoration: none;"><span style="font-size: 13px; color: #125688;"><strong>chartalex</strong></span></a>
                            <span class="text-strong" style="color: #c9c8cd; font-size: 13px;">&#183; {{ substr($insta['date'], 0) }}</span>
                            <br>
                            <a href="{{ $insta['loc_url'] }}" target="_blank" style="font-size: 12px; color: #4090db; text-decoration:none;">{{ str_limit($insta['loc_name'], $limit = 22, $end = '...') }}</a>
                        </div>
                        <div class="clearfix"></div>
                            <a href="{{ $insta['url'] }}" target="_blank">
                                <img class="img-responsive" src="{{ $insta['pic'] }}" style="margin-top: 8px; margin-bottom: 8px;"/>
                            </a>
                            <span class="text-muted" style="font-size:14px;">{{ str_limit($insta['text'], $limit = 24, $end = '...') }}</span><br><br>               
                            <a href="{{ $insta['url'] }}" target="_blank" style="color: #333333; text-decoration:none; font-size:14px;">
                                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> {{ $insta['likes'] }}
                            </a>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div>
        @endforeach

    </div>


<br><br><br>

<p class="text-muted small">
    Homemade with <i class="fa fa-heart"></i> and <a href="https://laravel.com/" target="_blank">Laravel</a> under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">Creative Commons Licence</a>.
</p>

@endsection

@section('script')

<script type="text/javascript">
$('.selectpicker').selectpicker({
    noneSelectedText: 'En rupture'
    });

</script>

<script async defer src="//platform.instagram.com/en_US/embeds.js"></script>

@endsection
