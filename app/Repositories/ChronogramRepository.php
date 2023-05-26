<?php

namespace App\Repositories;

use App\Http\Resources\V1\ChronogramCollection;
use App\Http\Resources\V1\ChronogramResource;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\ChronogramsGroups;
use App\Traits\UserDataTrait;
use App\Traits\ImageTrait;
use App\Models\Chronogram;
use App\Models\Schedule;

class ChronogramRepository
{

    use ImageTrait, FunctionGeneralTrait, UserDataTrait;

    private $model;
    function __construct()
    {
        $this->model = new Chronogram();
    }

    use FunctionGeneralTrait;

    public function getAll()
    {

        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();

        $query = $this->model->query()->orderBy('id', 'DESC');

        if ($rol_id == config('roles.coordinador_psicosocial') || $rol_id == config('roles.coordinador_regional') || $rol_id == config('roles.coordinador_enlace')|| $rol_id == config('roles.monitor')) {
            $query->whereNotIn('created_by', [1,2])->with(['mes', 'municipio'])
                ->whereHas('creator.roles', function ($query) {
                    $query->where('roles.slug', 'subdirector_tecnico');
                })
                ->whereNotIn('status_id', [config('roles.APR')]);
        }

        $paginate = config('global.paginate');

        // Aplicar filtros adicionales desde la URL
        $query = $this->model->scopeFilterByUrl($query);

        // Calcular número de páginas para paginación
        session()->forget('count_page_chronograms');
        session()->put('count_page_chronograms', ceil($query->get()->count()/$paginate));

        return new ChronogramCollection($query->simplePaginate($paginate));
    }
    public function create($request)
    {
        $request['created_by'] = Auth::id();
        $request['status_id'] = config('status.ENR');
        $cronograms = $this->model->create($request);
        // Guardamos en dataModel
        $this->control_data($cronograms, 'store');

        $schedulesModel = new Schedule();

        $lista = json_decode( $request['groups'] );

        foreach($lista as $group) {
            $groupsModel = new ChronogramsGroups();
            $groupsModel->chronograms_id             = $cronograms->id;
            $groupsModel->group_id                   = $group->group_id;
            $groupsModel->sports_modality            = $group->sports_modality;
            $groupsModel->main_sports_stage_name     = $group->main_sports_stage_name;
            $groupsModel->main_sports_stage_address  = $group->main_sports_stage_address;
            $groupsModel->alt_sports_stage_name      = $group->alt_sports_stage_name;
            $groupsModel->alt_sports_stage_address   = $group->alt_sports_stage_address;
            $groupsModel->save();

            $schedules = [];

            foreach ($group->schedules as $schedule) {
                $schedules[] = [
                    'chronograms_groups_id' => $groupsModel->id,
                    'day'                   => $schedule->day,
                    'start_time'            => $schedule->start_time,
                    'end_time'              => $schedule->end_time,
                ];
            }

            $schedulesModel->insert( $schedules );
        }

        $results = new ChronogramResource($cronograms);
        return $results;
    }

    public function findById($id)
    {
        $cronogram = $this->model->with(['mes', 'municipio', 'groups.schedules'])->findOrFail($id);
        return $cronogram;
    }

    public function update($data)
    {

        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();

        $cronograms = $this->model->findOrFail($data['id']);
        $cronograms->month = $data['month'];
        $cronograms->municipality = $data['municipality'];
        $cronograms->note = $data['note'];
        $cronograms->status_id = config('status.ENR');


        // Actualizar estados
        if ($rol_id == config('roles.coordinador_psicosocial') || $rol_id == config('roles.coordinador_regional') || $rol_id == config('roles.coordinador_enlace') || $rol_id == config('roles.metodologo')) {
            $cronograms->revised_by = $user_id;
            $cronograms->status_id = $data['status_id'];
            $cronograms->rejection_message = $data['rejection_message'];
        }

        $cronograms->save();

        // Guardamos en dataModel
        $this->control_data($cronograms, 'update');

        $groupsModel = new ChronogramsGroups();
        $groupsModel->where('chronograms_id', $data['id'])->delete();

        $schedulesModel = new Schedule();

        $lista = json_decode( $data['groups'] );

        foreach($lista as $group) {
            $groupsModel = new ChronogramsGroups();
            $groupsModel->chronograms_id             = $data['id'];
            $groupsModel->group_id                   = $group->group_id;
            $groupsModel->sports_modality            = $group->sports_modality;
            $groupsModel->main_sports_stage_name     = $group->main_sports_stage_name;
            $groupsModel->main_sports_stage_address  = $group->main_sports_stage_address;
            $groupsModel->alt_sports_stage_name      = $group->alt_sports_stage_name;
            $groupsModel->alt_sports_stage_address   = $group->alt_sports_stage_address;
            $groupsModel->save();

            $schedules = [];

            foreach ($group->schedules as $schedule) {
                $schedules[] = [
                    'chronograms_groups_id' => $groupsModel->id,
                    'day'                   => $schedule->day,
                    'start_time'            => $schedule->start_time,
                    'end_time'              => $schedule->end_time,
                ];
            }

            $schedulesModel->insert( $schedules );
        }

        $result = new ChronogramResource($cronograms);
        return $result;
    }

    public function delete($id)
    {
        $cronograms = $this->model->findOrFail($id);
        $cronograms->delete();
        return response()->json(['items' => 'El Cronograma fue eliminado correctamente.']);
    }

    public function getValidate($data, $method){

        $validate = [
            'month'                     => 'bail|required',
            'municipality'              => 'bail|required',
           // 'note'                      => 'bail|required|string',
            'groups'                    => 'bail|required'
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'max' => ':attribute es muy grande.',
        ];

        $attrs = [
            'month'         => 'Mes',
            'municipality'  => 'Municipio',
           // 'note'          => 'Observación',
            'groups'        => 'Grupos',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

}
