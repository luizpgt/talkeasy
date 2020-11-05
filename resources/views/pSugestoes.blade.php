@extends('master.layout')

@section('content')

    <section class="jumbotron text-center pb-5 pt-5 card text-white bg-info mb-5 mt-4">
        <div class="container pt-4">
            <h1 class="jumbotron-heading">Sugestões</h1>
            <p class="jumbotron-heading">Faça seu <a href="{{ route('usuario.login') }}" class="text-danger">CADASTRO</a> para deixar uma sugestão!</p>
        </div>
    </section>

    <section id="sugestao" class="pb-5">
        <div class="container">
            <div class="row justify-content-center ">
                <!-- ADICIONAR UMA SUGESTAO -->
                <div class=" col-sm-10">
                    @if (!Auth::guest())
                    <div class="image-flip card border-info mb-3 ontouchstart="this.classList.toggle('hover'); >
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="card-header text-center">
                                            Sugestões
                                        </div>
                                        <form method="POST" action="{{ route('sugestao.do') }}">
                                            @csrf
                                            <div class="card-body">
                                                <p class="text-center">Deixe aqui uma sugestão de melhoria, palavra ou gesto a ser acrescentado:</p>

                                                @if ($errors->all())
                                                    @foreach ($errors->all() as $error)
                                                        <div class=" border border-info alert alert-warning text-info" role="alert">
                                                            {{$error}}
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <input type="hidden" id="usuario_id" name="usuario_id" value="{{Auth::id()}}">

                                                <div class="form-group">

                                                <input type="text" name="sugestao" class="form-control" id="sugestao" maxlength="255">
                                                </div>
                                                <button class="btn btn-info" type="submit">Enviar sugestão</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /ADICIONAR UMA SUGESTAO -->
                    @endif
                    <form action="{{ action('SugestaoController@search')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Buscar</span>
                            </div>
                            <input type="text" name="sugestao" class="form-control" placeholder="Busque por alguma sugestão já adicionada!" aria-label="Busque por alguma sugestão já adicionada!" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-info">Buscar</button>
                        </div>
                    </form>

                    <!--LISTAGEM DAS SUGESTOES-->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Responsável</th>
                                    <th scope="col">Sugestão</th>
                                    @if (!Auth::guest())
                                    <th scope="col">Avaliar</th>
                                    @endif
                                    @if (Auth::id() === 1)
                                    <th scope="col">Remover</th>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($sugestao as $item)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td scope="row">{{$item->users->name}}</td>
                                        <td scope="row">{{$item->sugestao}}</td>
                                        @if (!Auth::guest())
                                        <th scope="row">
                                            <form action="{{action('LikeController@store')}} " method="POST">
                                                @csrf
                                                <input type="hidden" name="usuario_id" id="usuario_id" value="{{Auth::id()}}">
                                                <input type="hidden" name="sugestao_id" id="sugestao_id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-success">
                                                    <i class=" fa fa-thumbs-up"></i>
                                                </button>
                                            </form>
                                        </th>
                                        @endif
                                        @if (Auth::id() === 1)
                                        <td><a class="text-danger" href="{{action('SugestaoController@remove', $item->id)}}" onclick="return confirm('Tem certeza que deseja remover {{$item->sugestao}}?');"><i class="far fa-minus-square"></i></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!--/LISTAGEM DAS SUGESTOES-->
                    {{$sugestao->links()}}
                </div>
            </div>
        </div>
    </section>

@endsection
