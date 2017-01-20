@extends('master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}">
@stop

@section('content')
    <div class="container-fluid">
        {{--navbar--}}
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Stock market</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="https://github.com/qwerty1917" target="_blank">by Hyeongmin park</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        {!! $errors->first('price', '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Validation!</strong> Price should be an integer.
        </div>') !!}
        {!! $errors->first('share', '<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Validation!</strong> Share should be an integer.
        </div>') !!}

        {{--contents--}}
        <div id="main_contents_box" class="col-md-12 col-lg-12">

            <div class="main_half left col-md-6 col-lg-6">
                <h1>Sell</h1>

                <form method="POST" action="/deal/post">
                    {!! csrf_field() !!}

                    <input type="hidden" name="_type" value="s">

                    <div class="input-group price">
                        <span class="input-group-addon" id="basic-addon1">Sell price</span>
                        <input type="text" name="price" class="form-control" placeholder="Input integer ($)" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group share">
                        <span class="input-group-addon" id="basic-addon1">Sell share</span>
                        <input type="text" name="share"  class="form-control" placeholder="Input integer (share)" aria-describedby="basic-addon1">
                    </div>

                    <button type="submit" class="btn btn-default upload">Submit</button>
                    <div class="reset-float"></div>
                </form>

                <table class="table deal">
                    <tr>
                        <th>IP</th>
                        <th>Price ($)</th>
                        <th>Share</th>
                        <th>Updated</th>
                    </tr>

                    @if( count($holding_items_sell) > 0)
                        @foreach($holding_items_sell as $item)
                            <tr>
                                <td> {{ $item['ip'] }} </td>
                                <td> {{ $item['price'] }} </td>
                                <td> {{ $item['share'] }} </td>
                                <td> {{ $item['created_at'] }} </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                There is no item!
                            </td>
                        </tr>
                    @endif

                </table>
            </div>

            <div class="main_half right col-md-6 col-lg-6">
                <h1>Buy</h1>

                <form method="POST" action="/deal/post">
                    {!! csrf_field() !!}

                    <input type="hidden" name="_type" value="b">

                    <div class="input-group price">
                        <span class="input-group-addon" id="basic-addon1">Buy price</span>
                        <input type="text" name="price"  class="form-control" placeholder="Input integer ($)" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group share">
                        <span class="input-group-addon" id="basic-addon1">Buy share</span>
                        <input type="text" name="share"  class="form-control" placeholder="Input integer (share)" aria-describedby="basic-addon1">
                    </div>

                    <button type="submit" class="btn btn-default upload">Submit</button>
                    <div class="reset-float"></div>
                </form>

                <table class="table deal">
                    <tr>
                        <th>IP</th>
                        <th>Price ($)</th>
                        <th>Share</th>
                        <th>Updated</th>
                    </tr>

                    @if( count($holding_items_buy) > 0)
                        @foreach($holding_items_buy as $item)
                            <tr>
                                <td> {{ $item['ip'] }} </td>
                                <td> {{ $item['price'] }} </td>
                                <td> {{ $item['share'] }} </td>
                                <td> {{ $item['created_at'] }} </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                There is no item!
                            </td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>
    </div>
@stop

@section('script')
@stop