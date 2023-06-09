<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//repositorio de reportes por visita
use App\Repositories\ReportVisitsRepository;


class ReportVisitsController extends Controller
{
    private $reportVisitsRepository;

    public function __construct(ReportVisitsRepository $reportVisitsRepository)
    {
        $this->reportVisitsRepository = $reportVisitsRepository;
    }

    public function exportMethodologistVisit(Request $request)
    {
        try {
            $response = $this->reportVisitsRepository->generateDoc($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function exportBeneficiariesMethodologistVisit(Request $request)
    {
        try {
            $response = $this->reportVisitsRepository->GenerateBenefisiaries($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function exportPsychologistVisit(Request $request)
    {
        try {
            $response = $this->reportVisitsRepository->GenerateDocReportVisitsRepository($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function exportPsychologistcustomVisit(Request $request){
        try {
            $response = $this->reportVisitsRepository->GenerateDocPsychologistcustomVisit($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function exportPsychologisttransversalActivity(Request $request){
        try {
            $response = $this->reportVisitsRepository->GeneratedocPsychologisttransversalActivity($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    Public function exportvisitSubDirector(Request $request){
        try{
            $response = $this->reportVisitsRepository->GenerateDocvisitSubDirector($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }

}

    public function exportVisitDirector(Request $request){
        
    //     try{
    //         $response = $this->reportVisitsRepository->GenerateDocVisitDirector($request->id);
    //         if ($response instanceof \Exception) {
    //             return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
    //         } else {
    //             if (!$request->type) {
    //                 return $response;
    //             }
    //             return response()->json(['count' => $response]);
    //         }
    //     } catch (\Exception $ex) {
    //         return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
    // }

    }

    public function ExportCoordinadorRegional(Request $request){
        try{
            $response = $this->reportVisitsRepository->GenerateDocVisitCoordinador($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
         }
    }

    public function ExportBenefisiariesReport(Request $request){
        try{
            $response = $this->reportVisitsRepository->GenerateDocVisitCoordinador($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
         }
    }

    public function ExportChronogram(Request $request){
        try{
            $response = $this->reportVisitsRepository->GenerateChronogram($request->id);
            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
         }
    }

}