<?php

namespace App\Modules\Candidates\Controllers;
use App\Http\Controllers\Controller;

use App\Modules\Candidates\Requests\CandidatesRequest;
use App\Modules\Candidates\Requests\CreateCandidateRequest;
use App\Modules\Shared\Traits\Responses;
use App\Modules\Candidates\Contracts\ICandidates;
use App\Modules\Candidates\Requests\CreateJobRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CandidatesController extends Controller {

  protected $ICandidates;
  use Responses;

  public function __construct(ICandidates $ICandidates)
  {
      $this->ICandidates = $ICandidates;
  }



  public function getCandidates(CandidatesRequest $request)
  {
        try {
          $result = $this->ICandidates->getCandidates();

          if ($result ||  count($result) == 0) {
              return $this->success('', 200, $result);
          } else {
              return $this->failure("No se pudo listar candidatos", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api get candidatos", json_encode($request), $th->getMessage(), "No se pudo listar Candidatos, Hable con el administrador");
      }
  }

  public function getJobs(CandidatesRequest $request)
  {
        try {
          $result = $this->ICandidates->getJobs();

          if ($result ||  count($result) == 0) {
              return $this->success('tdo', 200, $result);
          } else {
              return $this->failure("No se pudo listar Trabajos", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api get Trabajos", json_encode($request), $th->getMessage(), "No se pudo listar Trabajos, Hable con el administrador");
      }
  }

  public function createApply(Request $request)
  {
        try {
          $result = $this->ICandidates->createApplyJob($request);

          if ($result ||  count($result) == 0) {
              return $this->success('', 200, $result);
          } else {
              return $this->failure("No se pudo postular", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api postular", json_encode($request), $th->getMessage(), "No se pudo postular al Trabajos, Hable con el administrador");
      }
  }

  public function myApplications(Request $request)
  {
        try {
          $result = $this->ICandidates->myApplications($request);

          if ($result ||  count($result) == 0) {
              return $this->success('', 200, $result);
          } else {
              return $this->failure("No se pudo listar", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api Listar aplicaciones", json_encode($request), $th->getMessage(), "No se pudo listar las Aplicaciones, Hable con el administrador");
      }
  }

  public function createCandidate(CreateCandidateRequest $request)
  {

      try {

        $result = $this->ICandidates->createCandidate($request);

        if ($result) {
            return $this->success("Se creó Candidato correctamente", 200, $result);
        } else {
            return $this->failure("No se pudo crear Candidato", 404, $request);
        }
      
        } catch (\Throwable $th) {
          return $this->exception("Error Api create Candidato", json_encode($request), $th->getMessage(), "No se pudo crear Candidato, Hable con el administrador");
      }
  }

  public function createJob( CreateJobRequest $request)
  {

      try {

          $result = $this->ICandidates->createJob($request);

          if ($result) {
              return $this->success("Se creo Job correctamente", 200);
          } else {
              return $this->failure("No se pudo crear Job", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api create Job", json_encode($request), $th->getMessage(), "No se pudo crear Job, Hable con el administrador");
      }
  }

  public function detailJob(Request $request)
  {
      try {
          $result = $this->ICandidates->detailJob($request);

          if ($result) {
              return $this->success("", 200, $result);
          } else {
              return $this->failure("No se pudo ver detalle del trabajo", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api detailJob", json_encode($request), $th->getMessage(), "No se pudo ver detalle del trabajo, Hable con el administrador");
      }
  }


}
