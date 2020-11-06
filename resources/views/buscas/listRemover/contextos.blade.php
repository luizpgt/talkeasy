@extends('master.layout')

@section('content')

    <section class="jumbotron text-center pb-5 pt-5 card text-white bg-info mb-5 mt-4">
        <div class="container pt-4">
            <h1 class="jumbotron-heading">PAINEL DE ADMINISTRAÇÃO</h1>
            <p class="jumbotron-heading">Remover um Contexto</p>
        </div>
    </section>

    <section id="sugestao" class="pb-5">
        <div class="container">
            @if (Auth::id() === 1)
                <a href="{{ route('cpanel.index') }}"><i class="fas fa-long-arrow-alt-left"> VOLTAR PARA O PAINEL DE ADMINISTRAÇÃO</i></a><br>
                <a href="{{ route('cpanel.contexto.list') }}"><i class="fas fa-long-arrow-alt-left"> VOLTAR PARA AS LISTA DE CONTEXTOS</i></a><br>
            @endif
                    <br><br>
                    <form action="{{ action('ContextoController@search')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Buscar</span>
                            </div>
                            <input type="text" name="contexto" class="form-control" placeholder="Busque por alguma sugestão já adicionada!" aria-label="Busque por alguma sugestão já adicionada!" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-info">Buscar</button>
                        </div>
                    </form>
                    <!--LISTAGEM DAS SUGESTOES-->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Contexto</th>
                                    @if (Auth::id() === 1)
                                        <th scope="col">Editar</th>
                                        <th scope="col">Remover</th>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($contextos as $item)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td scope="row">{{$item->contexto}}</td>
                                        @if (Auth::id() === 1)
                                        <td><a class="text-danger" href="{{action('ContextoController@remove', $item->id)}}" onclick="return confirm('Tem certeza que deseja remover {{$item->contexto}}?');"><i class="far fa-minus-square"></i></a></td>
                                            <td><a class="text-danger" href="{{action('ContextoController@remove', $item->id)}}" onclick="return confirm('Tem certeza que deseja remover {{$item->contexto}}?');"><i class="far fa-minus-square"></i></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!--/LISTAGEM DAS SUGESTOES-->
                    {{$contextos->links()}}
                </div>
            </div>
        </div>
    </section>

@endsection
