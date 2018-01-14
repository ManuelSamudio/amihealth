@extends('layouts.amihealth')

@section('content')
    <link href="/css/event.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Lista de medidas de cintura</h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="row">
            <div class="col-xs-12">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                @if(count($waists) >= 1)
                    @foreach ($waists as $waist)
                        <ul class="event-list">
                            <li>
                                <time style="background:{{$waist->rgb}}"datetime="{{$waist->created_at->format('Y-m-d')}}">
                                    <span class="day">{{$waist->created_at->format('d')}}</span>
                                    <span class="month">{{$waist->created_at->format('M')}}</span>
                                    <span class="year">{{$waist->created_at->format('Y')}}</span>
                                </time>
                                <time style="background-color:{{$waist->rgb}};opacity: 0.9">
                                    <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Cintura</label></h3></span>
                                    <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$waist->cintura}}</h1></span>
                                    <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">cm</div>
                                </time>
                                <time style="background-color:{{$waist->rgb}}; opacity: 0.9">
                                    <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>ICA</label></h3></span>
                                    <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$waist->ica}}</h1></span>

                                </time>
                                <div class="info">
                                    <h2 class="title">{{$waist->descrip}}</h2>
                                </div>
                                <div class="social">
                                    <ul>
                                        <li class="facebook" style="width:33%;"><a href="edit-cintura/{{ $waist->id }}"><span class="fa fa-pencil"></span></a></li>
                                        <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal"><span class="fa fa-info"></span></a></li>
                                        <li class="google-plus" style="width:33%;"><a href="delete-cintura/{{ $waist->id }}"><span class="fa fa-trash"></span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="event-details">
                                <div class="info" style="height:auto">
                                    <p class="desc">{{ucwords($waist->created_at->format('l d, F Y, h:i A'))}}</p>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    {{$waists->links()}}

                @else
                    <div class="form-group">
                        <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                            <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                        </div>

                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <a class="btn btn-primary btn-lg btn-block" href="/new-waist">Agregar nueva medida de cintura</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Índice Cintura - Altura (ICA)</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Hombre</th>
                                <th>Mujer</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Extremadamente delgado</th>
                                <th><0.34</th>
                                <th><0.34</th>
                                <th style="background-color: #FFAB00"></th>
                            </tr>
                            <tr>
                                <th>Delgado sano</th>
                                <th>0.35-0.42</th>
                                <th>0.35-0.41</th>
                                <th style="background-color: #558B2F"></th>
                            </tr>
                            <tr>
                                <th>Sano</th>
                                <th>0.43-0.52</th>
                                <th>0.42-0.48</th>
                                <th style="background-color: #33691E"></th>
                            </tr>
                            <tr>
                                <th>Sobrepeso</th>
                                <th>0.53-0.57</th>
                                <th>0.49-0.53</th>
                                <th style="background-color: #FFAB00"></th>
                            </tr>
                            <tr>
                                <th>Sobrepeso elevado</th>
                                <th>0.58-0.62</th>
                                <th>0.54-0.57</th>
                                <th style="background-color: #EF6C00"></th>
                            </tr>
                            <tr>
                                <th>Obesidad mórbida</th>
                                <th>≥0.63</th>
                                <th>≥0.58</th>
                                <th style="background-color: #B71C1C"></th>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.event-details').css('display','none');
                $('.event-details').css('height','auto');
                $('.event-details').css('margin-top','-17px');
                $('.event-details > .info').css('height','auto');
                $('.disabled').prev().css('cursor','default');

                $('.event-list > li').click(function() {
                    if (!$(this).nextAll('.event-details').first().hasClass('disabled')) {
                        //$(this).nextAll('.event-details').first().height('auto');
                        $(this).nextAll('.event-details').first().nextAll('.info').first().height('auto');
                        $(this).nextAll('.event-details').first().slideToggle();
                    }
                });
            })
        </script>
@endsection
