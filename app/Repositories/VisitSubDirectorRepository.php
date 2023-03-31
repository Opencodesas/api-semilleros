<?php

namespace App\Repositories;

use App\Http\Resources\V1\VisitSubDirectorCollection;
use App\Http\Resources\V1\VisitSubDirectorResource;
use App\Traits\FunctionGeneralTrait;
use App\Models\VisitSubDirector;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;

class VisitSubDirectorRepository
{
    use ImageTrait, FunctionGeneralTrait, UserDataTrait;

    private $model;

    function __construct()
    {
        $this->model = new VisitSubDirector();
    }

    public function getAll()
    {
        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();

        $query = $this->model->query()->orderBy('id', 'DESC');

        if ($rol_id == config('roles.subdirector_tecnico')) {
            $query->where('created_by', $user_id);
        }

        if ($rol_id == config('roles.director_tecnico')) {
            $query->whereNotIn('created_by', [1,2]);
        }

        $paginate = config('global.paginate');

        // Aplicar filtros adicionales desde la URL
        $query = $this->model->scopeFilterByUrl($query);

        // Calcular número de páginas para paginación
        session()->forget('count_page_visitSubDirectors');
        session()->put('count_page_visitSubDirectors', ceil($query->get()->count()/$paginate));

        return new VisitSubDirectorCollection($query->simplePaginate($paginate));
    }
    public function create($request)
    {
        $user_id = $this->getIdUserAuth();

        $visitSubDirector = $this->model;
        $visitSubDirector->date_visit = $request['date_visit'];
        $visitSubDirector->hour_visit = $request['hour_visit'];
        $visitSubDirector->sports_scene = $request['sports_scene'];
        $visitSubDirector->beneficiary_coverage = $request['beneficiary_coverage'];
        /* CHAR CAMPOS */
        $visitSubDirector->technical = $request['technical'];
        $visitSubDirector->event_support = $request['event_support'];
        /* OTROS CAMPOS */
        $visitSubDirector->description = $request['description'];
        $visitSubDirector->observations = $request['observations'];
        $visitSubDirector->transversal_activity = $request['transversal_activity'];
        /* RELACIONES CAMPOS */
        $visitSubDirector->municipality_id = $request['municipality_id'];
        // $visitSubDirector->sidewalk_id = $request['sidewalk'];
        $visitSubDirector->discipline_id = $request['discipline_id'];
        $visitSubDirector->monitor_id = $request['monitor_id'];
        $visitSubDirector->created_by = $user_id;
        // $visitSubDirector->reviewed_by = $request['reviewed_by'];
        $visitSubDirector->status_id = config('status.ENR');
        $visitSubDirector->reject_message = $request['rejection_message'];
        $save = $visitSubDirector->save();

        /* SUBIMOS EL ARCHIVO */
        if ($save) {
            $handle_1 = $this->send_file($request, 'file', 'subdirector_visit', $visitSubDirector->id);
            $visitSubDirector->update(['file' => $handle_1['response']['payload']]);
            $save &= $handle_1['response']['success'];
        }

        /* GUARDAMOS EN DATAMODEL */
        $this->control_data($visitSubDirector, 'store');
        $results = new VisitSubDirectorResource($visitSubDirector);
        return $results;
    }

    public function findById($id)
    {
        $visitSubDirector = $this->model->findOrFail($id);
        return $visitSubDirector;
        $result = new VisitSubDirectorResource($visitSubDirector);
        return $result;
    }

    public function update($request, $id)
    {
        $user_id = $this->getIdUserAuth();
        $rol_id = $this->getIdRolUserAuth();

        $visitSubDirector = $this->model->findOrFail($id);
        $visitSubDirector->date_visit = $request['date_visit'];
        $visitSubDirector->hour_visit = $request['hour_visit'];
        $visitSubDirector->sports_scene = $request['sports_scene'];
        $visitSubDirector->beneficiary_coverage = $request['beneficiary_coverage'];
        /* CHAR CAMPOS */
        $visitSubDirector->technical = $request['technical'];
        $visitSubDirector->event_support = $request['event_support'];
        /* OTROS CAMPOS */
        $visitSubDirector->description = $request['description'];
        $visitSubDirector->observations = $request['observations'];
        $visitSubDirector->transversal_activity = $request['transversal_activity'];
        /* RELACIONES CAMPOS */
        $visitSubDirector->municipality_id = $request['municipality_id'];
        // $visitSubDirector->sidewalk_id = $request['sidewalk'];
        $visitSubDirector->discipline_id = $request['discipline_id'];
        $visitSubDirector->monitor_id = $request['monitor_id'];

        if ($rol_id == config('roles.director_tecnico')) {
            $visitSubDirector->reviewed_by = $user_id;
            $visitSubDirector->status_id = $request['status_id'];
            $visitSubDirector->reject_message = $request['reject_message'];
        }

        /* ACTUALIZAMOS EL ARCHIVO */
        if ($request->hasFile('file')) {
            $handle_1 = $this->update_file($request, 'file', 'subdirector_visit', $visitSubDirector->id, $visitSubDirector->file);
            $visitSubDirector->update(['file' => $handle_1['response']['payload']]);
        }
        /* CAMBIAMOS EL ESTADO */
        if ($request['status'] == config('status.REC')) {
            $visitSubDirector->status_id = config('status.ENREV');
            $visitSubDirector->reject_message = $request['reject_message'];
        }
        $visitSubDirector->save();
        /* GUARDAMOS EN DATAMODEL */
        $this->control_data($visitSubDirector, 'update');
        $results = new VisitSubDirectorResource($visitSubDirector);
        return $results;
    }

    public function delete($id)
    {
        $visitSubDirector = $this->model->findOrFail($id);
        $visitSubDirector->delete();
        return response()->json(['items' => 'La visita de subdirector fue eliminada correctamente.']);
    }

    public function getValidate($data, $method){

        $validate = [
            'date_visit' => 'bail|required',
            'hour_visit' => 'bail|required',
            'sports_scene' => 'bail|required',
            'beneficiary_coverage' => 'bail|required',
            'technical' => 'bail|required',
            'event_support' => 'bail|required',
            'description' => 'bail|required',
            'observations' => 'bail|required',
            'file' => $method != 'update' ? 'bail|required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
            'municipality_id' => 'bail|required',
            // 'sidewalk_id' => 'bail|required',
            'transversal_activity' => 'bail|required',
            'discipline_id' => 'bail|required',
            'monitor_id' => 'bail|required',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'max' => ':attribute es muy grande.',
        ];

        $attrs = [
            'date_visit' => 'Fecha',
            'hour_visit' => 'Hora',
            'sports_scene' => 'Escenario deportivo',
            'beneficiary_coverage' => 'Cobertura de benificiario',
            'technical' => 'Cumple con el desarrollo tecnico del mes',
            'event_support' => 'Apoyo a eventos',
            'description' => 'Descripcion',
            'observations' => 'Observaciones',
            'file' => 'Archivo',
            'municipality_id' => 'Municipio',
            // 'sidewalk_id' => 'Corregimiento/Vereda',
            'transversal_activity' => 'Actividad transversal',
            'discipline_id' => 'Disciplinas',
            'monitor_id' => 'Monitor',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

    /* SUBIR DOCUMENTOS A TRAVES DEL DROPZONE */
    public function uploadAll($request) {
        $files = $request->file('files');
        foreach ($files as $file) {
            // Validar cada archivo
            $request->validate([
                'file' => 'bail|required|mimes:jpeg,png,gif,pdf|max:2048',
            ]);
            // Procesar y almacenar cada archivo
            $this->send_file($request, 'file', 'methodologist_visits', 1); // El 1 está quemado de momento
            // $file->store('public');
        }
        return response()->json(['items' => 'Los archivos se han subido correctamente.']);
    }

}
