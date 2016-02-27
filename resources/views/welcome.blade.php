@extends('layouts.master')

@section('title', 'Hello World!')

@section('content')




        <div class="text-center">
                <br>
                <h2>Hello World !</h2>
                <br>
                <p class="lead">
                At 28 years old, I became millionaire, <br>
                not as a drug dealer, but as an entrepreneur. <br>
                And believe me, cocaïne is nothing compared to a web startup.
                </p>
                <p class="lead">
                Hopefully, one day my investors understood I was crazy.<br>
                I was forced to quit the company I founded. <br>
                And instead of an Aston Martin to drive, I purchased a van to live in.
                </p>
                <p class="lead">
                Since then, I do not believe in profit-for-some companies. <br>
                I refuse to work just for myself, and will serve the world<br>
                with the ideas I’m lucky enough to get.
                </p>
                <br>
        </div>

<hr>


    <h4 class="text-center">
        <i class="fa fa-instagram"></i> Follow me on <a href="https://www.instagram.com/chartalex/">instagram</a>.
    </h4>
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
                            <a href="https://www.instagram.com/chartalex" target="_blank"><span style="font-size: 13px;"><strong>chartalex</strong></span></a>
                            <span class="text-strong" style="color: #c9c8cd; font-size: 13px;">&#183; {{ substr($insta['date'], 7) }}</span>
                            <br>
                            <a href="{{ $insta['loc_url'] }}" target="_blank" style="font-size: 12px;">{{ $insta['loc_name'] }}</a>
                        </div>
                        <div class="clearfix"></div>
                            <a href="{{ $insta['url'] }}" target="_blank">
                                <img class="img-responsive" src="{{ $insta['pic'] }}" style="margin-top: 8px; margin-bottom: 8px;"/>
                            </a>
                            <span class="text-muted small">{{ str_limit($insta['text'], $limit = 31, $end = '...') }}</span>                
                    </div> <!-- panel-body -->
                    <div class="panel-footer text-muted">
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> {{ $insta['likes'] }}
                    </div>
                </div> <!-- panel -->
            </div>
        @endforeach

    </div>




<br><br>

<hr>

    <h4 class="text-center">
        <i class="fa fa-shopping-basket"></i> Order some good stuff.
    </h4>
    <br>

        <p class="text-center">
            Started in 2008, Monsieur Chat L'Heureux is what I like to call a "recreative project".<br>
            It means that all profits are reinvested in leisure activities and travels.<br>
            Cherry on the cake, all products are made with organic and fairtrade cotton.
        </p>
        <br>


                <div class="row">
                    <div class="col-xs-2 col-xs-offset-1" style="padding:0px !important">
                        <img src="img/mclh/shop/calecon-citron-300-boite.png" class="img-responsive" alt="caleçon citron">
                    </div>
                    <div class="col-xs-2" style="padding:0px !important">
                        <img src="img/mclh/shop/calecon-rose-300-boite.png" class="img-responsive" alt="caleçon citron">
                    </div>
                    <div class="col-xs-2" style="padding:0px !important">
                        <img src="img/mclh/shop/calecon-pomme-300-boite.png" class="img-responsive" alt="caleçon citron">
                    </div>
                    <div class="col-xs-2" style="padding:0px !important">
                        <img src="img/mclh/shop/calecon-turquoise-300-boite.png" class="img-responsive" alt="caleçon citron">
                    </div>
                    <div class="col-xs-2" style="padding:0px !important">
                        <img src="img/mclh/shop/calecon-peche-300-boite.png" class="img-responsive" alt="caleçon citron">
                    </div>
                    
                </div> <!-- row -->

                <p class="lead text-center"><strong>60€</strong> - Men's boxer shorts (x5)</p>


                {!! Form::open(array('url' => 'cart', 'method' => 'get')) !!}
                <div class="row">
                    <div class="col-xs-5 col-xs-offset-1 text-right">
                        <div class="form-group">
                            <select name="add_boxers_pack" class="selectpicker form-control" data-width="auto">
                                <option value="1">Size S</option>
                                <option value="2">Size M</option>
                                <option value="3">Size L</option>
                                <option value="4">Size XL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-5 text-left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-info"><i class="fa fa-sign-out"></i> Order</button>
                    </div>
                </div>
                {!! Form::close() !!}


<br><br><br>



@endsection

@section('script')

<script type="text/javascript">
$('.selectpicker').selectpicker({
    noneSelectedText: 'En rupture'
    });

</script>

<script async defer src="//platform.instagram.com/en_US/embeds.js"></script>

@endsection
