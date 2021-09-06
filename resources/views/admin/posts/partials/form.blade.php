<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de Post']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'slug', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoria') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        {{-- como quiero que seleccione mas de un checkbox se pone en el name un array (tags[]) --}}
        <label class="mr-2">{!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>

    @endforeach


    @error('tags')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label class="mr-2">
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>
    {{-- a uno le pase true y al otro no, es porque se quiere que este activo por defecto el estado borrador --}}
    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>


    @error('status')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2021/06/20/08/35/ginkgo-6350293_960_720.jpg">
            @endisset

        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen a mostrar') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptas porro tenetur
            doloribus saepe ipsam laborum veniam quibusdam, atque ut, dolore nisi quo sit. Maiores fugit
            mollitia blanditiis nesciunt harum!</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}


    @error('extract')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del Post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}


    @error('body')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
