<?php

namespace App\Modules\Candidates\Contracts;

interface ICandidates {
  public function getCandidates();
  public function getJobs();
  public function createCandidate($data);
  public function createJob($data);
  public function createApplyJob($id);
  public function myApplications($id);
  public function detailJob($id);
}