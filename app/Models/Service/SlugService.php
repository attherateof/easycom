<?php

namespace App\Models\Service;
class SlugService
{
    public function generateSlug(array $validated): string
    {
        $title = $validated['title'];
        $slug = $validated['slug'] ?? null;

        if (!$slug && $title) {
            $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($title)));
        }

        return $slug;
    }
}
