<?php

namespace App\Modules\Candidates\Repositories;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\User;
use App\Modules\Candidates\Contracts\ICandidates;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class RepoCandidates implements ICandidates
{
   //  use Signature;

    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getCandidates()
    {
        $result = Candidate::all();
 
         return $result;

    }

    public function getJobs()
    {
        $result = Job::all();
 
        return $result;
    }


    public function createCandidate($data)
    {
        $user = User::create([
            'name' => $data->name,
            
            'email' => $data->email,
            'last_name' => $data->last_name,
            'birthday' => $data->birthday,
            'role' => $data->role,
            'password' => Hash::make($data->password),
        ]);
        $candidate = Candidate::create([
            'user_id' => $user->id,
            'aplicant_number'=>$data->aplicant_number,
            'document_number'=>$data->document_number,
            'document_type'=>$data->document_type,
        ]);
        

        return ["user" =>$user, "candidate" => $candidate];

    }

    public function createJob($data)
    {

        $job = Job::create([
            'title' => $data->title,
            'description' => $data->description,
            'salary' => $data->salary,
            'cv' => $data->cv,
        ]);

        return $job;
    }

    public function createApplyJob($data)
    {
        $job = Job::find($data->job_id);
        
        $job->candidates()->attach($data->candidate_id, [
            'cv' => $data->cv,
            'msg' => $data->msg,
        ]);

        return $job;
    }

    public function myApplications($data)
    {
       
        $jobs = Candidate::find($data->candidate_id)
        ->jobs()
        ->withPivot('cv', 'msg', 'created_at')
        ->get();

        return $jobs;
    }

    public function detailJob($data)
    {
        // $job = Job::find($data->job_id)
        // ->candidates()
        // ->get();

        // return $job;

        $job = Job::with(['candidates.user'])->find($data->job_id);

        // Obtén la cantidad total de postulantes
        $totalPostulantes = $job->candidates()->count();

        // Agrega la cantidad total al modelo del trabajo
        $job->setAttribute('total_postulantes', $totalPostulantes);

        return $job;
    }

}