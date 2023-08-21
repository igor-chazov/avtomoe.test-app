@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' | ' . __('page.upload'))

@section('content')

    <div class="container mt-5" style="max-width: 650px">
        <h2 class="mb-5">Выберите изображение для загрузки</h2>
        <form action="{{route('resizeImage')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>

                <div class="col-md-12 mb-3">
                    <strong>Загруженное изображение:</strong><br/>
                    <img src="/uploads/{{ Session::get('fileName') }}" width="650px"/>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile"></label>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-danger btn-block mt-4">
                {{ __('form.upload') }}
            </button>
        </form>
    </div>

@endsection
