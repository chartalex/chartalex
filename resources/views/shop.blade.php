@extends('layouts.master')

@section('title', 'Shop')

@section('content')

            <h1>Monsieur Chat l'Heureux</h1><br><br>


            <div class="row">
                @foreach ($groups as $group)
                    <div class="col-xs-12 col-sm-6 col-md-4">

                            <form method="POST" action="{{url('cart')}}">
                                
                                <a href="#">
                                    <img class="product-img img-rounded img-responsive" alt="{{ $group->name }}" src="img/mclh/shop/{{ $group->prefix }}-300-boite.png" style="margin:auto">
                                </a>

                                    <div class="row">
                                        <div class="col-xs-7 col-xs-offset-1 text-left">
                                            <p class="lead">{{ $group->name }}</p>
                                        </div>
                                        <div class="col-xs-3 text-right">
                                            <p class="lead">{{ $group->price }} €</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-xs-offset-1 text-left">
                                            <div class="form-group">
                                                <select name="product_id" class="selectpicker form-control" data-width="auto">
                                                   @foreach ($products as $product)
                                                        @if ( $product->group_id === $group->id &&  $product->stock > 0)
                                                            <option value="{{ $product->id }}">Taille {{ $product->size }}</option>
                                                        @endif
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-block btn-info add-to-cart"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
                                        </div>
                                    </div>
                            </form>

                            <br/><br/><br/><br/><br/>
                    </div>
                @endforeach
            </div>



@endsection

@section('script')

<script type="text/javascript">
$('.selectpicker').selectpicker({
    noneSelectedText: 'En rupture'
    });

</script>

@endsection
