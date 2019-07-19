<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Project::query()->select('*');

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'project_show';
                $editGate      = 'project_edit';
                $deleteGate    = 'project_delete';
                $crudRoutePart = 'projects';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->title : "";
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.projects.index');
    }

    public function create()
    {
        abort_unless(\Gate::allows('project_create'), 403);

        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        abort_unless(\Gate::allows('project_create'), 403);
        $request['created_by'] = Auth::id();
        $project = Project::create($request->all());

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        abort_unless(\Gate::allows('project_edit'), 403);

        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        abort_unless(\Gate::allows('project_edit'), 403);

        $project->update($request->all());

        return redirect()->route('admin.projects.index');
    }

    public function show(Project $project)
    {
        abort_unless(\Gate::allows('project_show'), 403);

        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        abort_unless(\Gate::allows('project_delete'), 403);

        $project->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectRequest $request)
    {
        Project::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
