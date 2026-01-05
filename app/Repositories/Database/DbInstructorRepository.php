<?php

namespace App\Repositories\Database;

use App\Repositories\InstructorRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DbInstructorRepository implements InstructorRepository
{
    public function streamAll(): StreamedResponse
    {
        return Response::stream(function () {
            echo '[';
            $first = true;

            DB::table('instructores')
                ->select('id', 'nombre')
                ->orderBy('id')
                ->chunkById(1000, function ($rows) use (&$first) {
                    foreach ($rows as $row) {
                        if (!$first) {
                            echo ',';
                        } else {
                            $first = false;
                        }

                        echo json_encode([
                            'id' => $row->id,
                            'nombre' => $row->nombre,
                        ]);
                    }
                });

            echo ']';
        }, 200, [
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
        ]);
    }
}

