<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function show($code)
    {
        $certificate = Certificate::where('certificate_code', $code)
            ->with(['user', 'course.instructor'])
            ->firstOrFail();

        return view('certificates.show', compact('certificate'));
    }
}
