@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.projects.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.project.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($project) ? $project->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.project.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.project.fields.description') }}*</label>
                <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($project) ? $project->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.project.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('objectives') ? 'has-error' : '' }}">
                <label for="objectives">{{ trans('cruds.project.fields.objectives') }}</label>
                <textarea id="objectives" name="objectives" class="form-control ckeditor">{{ old('objectives', isset($project) ? $project->objectives : '') }}</textarea>
                @if($errors->has('objectives'))
                    <em class="invalid-feedback">
                        {{ $errors->first('objectives') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.project.fields.objectives_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('visibility') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.project.fields.visibility') }}*</label>
                @foreach(App\Project::VISIBILITY_RADIO as $key => $label)
                    <div>
                        <input id="visibility_{{ $key }}" name="visibility" type="radio" value="{{ $key }}" {{ old('visibility', null) === (string)$key ? 'checked' : '' }} required>
                        <label for="visibility_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('visibility'))
                    <em class="invalid-feedback">
                        {{ $errors->first('visibility') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection