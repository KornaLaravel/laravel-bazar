<?php

namespace Cone\Bazar\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response as ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DownloadController extends Controller
{
    /**
     * Download the file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function __invoke(Request $request): Response
    {
        try {
            $url = Crypt::decryptString($request->input('url'));

            return ResponseFactory::streamDownload(static function () use ($url): void {
                echo file_get_contents(
                    $url, false, stream_context_create(['ssl' => ['verify_peer' => false]])
                );
            }, basename($url));
        } catch (DecryptException $exception) {
            throw new NotFoundHttpException(__('Not found.'));
        }
    }
}
