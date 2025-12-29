<?php

namespace App\Repositories;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface InstructorRepository
{
    public function streamAll(): StreamedResponse;
}
