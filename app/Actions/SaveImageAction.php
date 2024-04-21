<?php

namespace App\Actions;
use Illuminate\Support\Facades\Storage;

class SaveImageAction
{
    public function __invoke($request): string
    {
        if ($request->hasFile('avatar')) {
          $file = $request->file('avatar');
          $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

          $file->move(public_path('avatars'), $fileName);

          $path = asset('avatars/' . $fileName);

          return $path;
        };

        return null;
    }
}