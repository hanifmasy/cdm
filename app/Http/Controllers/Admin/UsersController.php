<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Regional;
use App\Models\Role;
use App\Models\User;
use App\Models\Witel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        dd(bcrypt('Telkom234'));
        if ($request->ajax()) {
            $query = User::with(['roles', 'regional', 'witel'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });

            $table->editColumn('approved', function ($row) {
                return '<div class="form-check form-check-info">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" disabled '. ($row->approved ? 'checked' : null) .'>
                <i class="input-helper"></i></label>
              </div>';
            });
            $table->editColumn('verified', function ($row) {
                return '<div class="form-check form-check-info">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" disabled '. ($row->verified ? 'checked' : null) .'>
                <i class="input-helper"></i></label>
              </div>';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });
            $table->addColumn('regional_nama_regional', function ($row) {
                return $row->regional ? $row->regional->nama_regional : '';
            });

            $table->addColumn('witel_nama_witel', function ($row) {
                return $row->witel ? $row->witel->nama_witel : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'approved', 'verified', 'roles', 'regional', 'witel']);

            return $table->make(true);
        }

        $roles     = Role::get();
        $regionals = Regional::get();
        $witels    = Witel::get();

        return view('admin.users.index', compact('roles', 'regionals', 'witels'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $regionals = Regional::all()->pluck('nama_regional', 'id')->prepend(trans('global.pleaseSelect'), '');

        $witels = Witel::all()->pluck('nama_witel', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('roles', 'regionals', 'witels'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $regionals = Regional::all()->pluck('nama_regional', 'id')->prepend(trans('global.pleaseSelect'), '');

        $witels = Witel::all()->pluck('nama_witel', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'regional', 'witel');

        return view('admin.users.edit', compact('roles', 'regionals', 'witels', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'regional', 'witel', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
